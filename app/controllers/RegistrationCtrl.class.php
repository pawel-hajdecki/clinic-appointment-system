<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use app\forms\RegistrationForm;
use core\Validator;
use app\services\DatabaseUtils;
use core\RoleUtils;
use Smarty\Data;

class RegistrationCtrl{
	private $form;
	private $userId;
	
	public function __construct(){
		//stworzenie potrzebnego obiektu
		$this->form = new RegistrationForm();
		$this->userId = null;
	}
	
	private function getURLParams(){
		$v = new Validator();
		$this->userId = Utils::idValidateFromCleanURL($v, 1);
	}
	
	private function loadUser(){
		if(!$this->userId){
			return;
		}
		try{
			$db_user = App::getDB()->get('system_user', [
				'iduser(id)',
				'nameuser(name)',
				'surname',
				'login',
				'pesel'
			], [
				'iduser' => $this->userId
			]);
			
			if($db_user){
				$this->form->user_data = new \app\transfer\User($db_user);
			}
		} catch (\PDOException $e){
			Utils::addErrorMessage("Wystąpił błąd podczas wczytywania danych użytkownika.");
		}
	}
	
	 //Funkcja pobierająca parametry formularza
	public function getParams(){
		$v = new Validator();
		$isAdmin = RoleUtils::inRole('admin');

		$this->form->isTemporaryUser = ParamUtils::getFromRequest('isTemporaryUser') ? true : false;

		// Hasło: min 8 znaków, co najmniej 1 wielka litera i 1 cyfra
		$this->form->password = Utils::passwordValidateFromRequest($v, 'password', !$this->userId);

		// Potwierdzenie hasła
		$this->form->password_confirm = ParamUtils::getFromRequest('confirm_password');
		if (!$this->form->isTemporaryUser && $this->form->password !== $this->form->password_confirm && !$this->userId) {
			Utils::addErrorMessage('Hasła się nie zgadzają.');
		}

		// Imię i nazwisko: tylko litery, pierwsza wielka litera
		$this->form->user_data->name = Utils::nameValidateFromRequest($v, 'name', true);
		$this->form->user_data->surname = Utils::surnameValidateFromRequest($v, 'surname', true);

		// PESEL: 11 cyfr
		if ($isAdmin) {
			$this->form->user_data->login = Utils::stringValidateFromRequest(
				$v,
				'login',
				true,
				'Login wymagany.',
				'Login może zawierać litery, cyfry oraz znaki . _ - (3-50 znaków).',
				'/^[A-Za-z0-9._-]{3,50}$/'
			);
			$this->form->user_data->pesel = null;
		} else {
			$this->form->user_data->pesel = Utils::stringValidateFromRequest(
				$v,
				'pesel',
				true,
				'PESEL wymagany.',
				'PESEL musi składać się z 11 cyfr.',
				'/^\d{11}$/'
			);
			$this->form->user_data->login = $this->form->user_data->pesel;
		}

	}
	
	//Funkcja walidująca parametry formularza. True -> gdy brak błędów, false -> wystąpiły błędy.
	public function validate() {
	    if (App::getMessages()->isError())
            return false;

		$isAdmin = RoleUtils::inRole('admin');
		if($this->userId && !$isAdmin){
			Utils::addErrorMessage('Tylko administrator może edytować dane recepcjonisty.');
			return false;
		}

		// Unikalność tylko gdy brak wcześniejszych błędów walidacji
		try{
			if ($isAdmin) {
				$existing_user = App::getDB()->has('system_user', [
					'login' => $this->form->user_data->login
				]);
				if($existing_user){
					Utils::addErrorMessage('Użytkownik z podanym loginem już istnieje.', 'login');
				}
			} else {
				$existing_user = App::getDB()->has('system_user', [
					'pesel' => $this->form->user_data->pesel
				]);
				if($existing_user){
					Utils::addErrorMessage('Użytkownik z podanym PESEL już istnieje.', 'pesel');
				}
			}
		} catch (\PDOException $e){
			Utils::addErrorMessage("Wystąpił błąd podczas sprawdzania unikalności użytkownika.");
		}

        return ! App::getMessages()->isError();
	} 


	private function updateUser(){
		try{
			App::getDB()->update('system_user', [
				'nameuser' => $this->form->user_data->name,
				'surname' => $this->form->user_data->surname,
				'pesel' => $this->form->user_data->pesel,
				'login' => $this->form->user_data->login,
			], [
				'iduser' => $this->userId
			]);
			Utils::addInfoMessage('Dane użytkownika zostały zaktualizowane.');
		} catch (\PDOException $e){
			Utils::addErrorMessage("Wystąpił błąd podczas aktualizacji danych użytkownika.");
		}
	}
	
	#region Obsługa akcji

	public function action_register(){
		$this->getURLParams();
		$this->getParams();
		$isAdmin = RoleUtils::inRole('admin');

		if($this->validate()){
			if($this->userId){
				//Edycja
				$this->updateUser();
			} else {
				// Nowy użytkownik
				try {
					$password_hash = $this->form->password ? password_hash($this->form->password, PASSWORD_DEFAULT) : " ";
					$roleName = $isAdmin ? 'receptionist' : 'patient';
					$role_id = DatabaseUtils::getRoleIdByName($roleName);

					$statuses = array_column(App::getDB()->select('useraccountstatus', '*'), 'idstatus', 'namestatus');
					App::getDB()->insert('system_user', [
						'nameuser' => $this->form->user_data->name,
						'surname' => $this->form->user_data->surname,
						'pesel' => $this->form->user_data->pesel,
						'login' => $this->form->user_data->login,
						'password' => $password_hash,
						'idstatus' => RoleUtils::inRole('receptionist') || $isAdmin ?  $statuses['active'] : $statuses['unverified']
					]);

					// Przypisanie roli pacjenta lub recepcjonisty
					App::getDB()->insert('role_user', [
						'iduser' => App::getDB()->id(), // Ostatnio dodany użytkownik id
						'idrole' => $role_id
					]);

					Utils::addInfoMessage('Rejestracja zakończona sukcesem.');
				} catch (\PDOException $e) {
					Utils::addErrorMessage("Wystąpił błąd podczas rejestracji użytkownika.");
				}
			}
		}

		$this->generateView();
		
	}
	
	public function action_showRegistrationForm(){
		$this->generateView(); 
	}

	public function action_editRegistrationData(){
		$this->getURLParams();
		$this->loadUser();
		$this->generateView(); 
	}
	#endregion

	//Funkcja generująca widok
	public function generateView(){
		$isAdmin = RoleUtils::inRole('admin');
		App::getSmarty()->assign('page_title', $isAdmin ? 'Nowy recepcjonista' : 'Rejestracja');
		App::getSmarty()->assign('page_description', $isAdmin ? 'Dodaj konto recepcjonisty' : 'Stwórz konto pacjenta');
		App::getSmarty()->assign('page_header', $isAdmin ? 'Dodaj recepcjonistę' : 'Zarejestruj się');
		App::getSmarty()->assign('form',$this->form);
		App::getSmarty()->assign('userId', $this->userId);
		App::getSmarty()->display('RegistrationView.tpl');		
	}
}