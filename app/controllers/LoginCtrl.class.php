<?php

namespace app\controllers;

use core\App;
use core\Message;
use core\SessionUtils;
use core\Utils;
use core\ParamUtils;
use app\forms\LoginForm;
use app\transfer\User;
use core\RoleUtils;

class LoginCtrl{
	private $form;
	
	public function __construct(){
		//stworzenie potrzebnego obiektu
		$this->form = new LoginForm();
	}
	
	 //Funkcja pobierająca parametry formularza
	public function getParams(){
		$this->form->login = ParamUtils::getFromRequest('login');
		$this->form->password = ParamUtils::getFromRequest('password');
	}
	
	//Funkcja walidująca parametry formularza. True -> gdy brak błędów, false -> wystąpiły błędy.
	public function validate() {
		// sprawdzenie, czy parametry zostały przekazane
		if (! (isset( $this->form->login ) && isset ( $this->form->password ))) {
			// brak parametrów -> pierwsze wejście formularza lub niepoprawne wywołanie kontrolera - nie reagujemy błędem
			return false;
		}
		//sprawdzenie, czy parametry wartości zostały przekazane
		if ($this->form->login == "") {
			Utils::addErrorMessage('Nie podano loginu.');
		}
		if ($this->form->password == "") {
			Utils::addErrorMessage('Nie podano hasła.');
		}	

		if ( !App::getMessages()->isError()) { //sprawdzenie czy są parametry
		
            $db_user =  App::getDB()->get('system_user', [
                '[>]useraccountstatus(status)' => ['idstatus' => 'idstatus'],
            ], [
                'iduser(id)',
                'nameuser(name)',
                'surname',
                'status.namestatus(status)',
                'pesel',
                'login',
                'password'
            ], [
                'login' => $this->form->login
            ]);

			if(!$db_user) {
				Utils::addErrorMessage('Nie ma takiego użytkownika.');
				return false;
			}

            if(password_verify($this->form->password, $db_user['password']) ) {

                $roles = App::getDB()->select('role_user', [
                    '[><]role' => ['idrole' => 'idrole']
                ], [
                    'namerole(role_name)'
                ], [
                    'iduser' => $db_user['id']
                ]);

                $user = new User($db_user);

                SessionUtils::storeObject('user', $user);
                foreach($roles as $role){
                    RoleUtils::addRole($role['role_name']);
                }

            } else {

                Utils::addErrorMessage('Niepoprawny login lub hasło.');

            }
		}
		
		return ! App::getMessages()->isError();
	}
	
	#region Obsługa akcji

	//Logowanie użytkownika
	public function action_login(){

		$this->getParams();
		
		if ($this->validate()){
			//zalogowany => przekieruj na stronę główną, gdzie uruchomiona zostanie domyślna akcja
			App::getRouter()->redirectTo("showMainPage");
		} else {
			//niezalogowany => wyświetl stronę logowania
			http_response_code(401); //"Unauthorized"
			$this->generateView(); 
		}
		
	}
	
	//Wylogowanie użytkownika
	public function action_logout(){
		//unieważnij sesję
    	session_destroy();

    	// i przekieruj do wybranej akcji (tej domyślnej po wylogowaniu)
    	App::getRouter()->redirectTo("showMainPage");	 
	}
	#endregion

	//Funkcja generująca widok
	public function generateView(){
		App::getSmarty()->assign('page_title','Logowanie');
        App::getSmarty()->assign('page_description','Zaloguj się do swoje konta pacjenta');
        App::getSmarty()->assign('page_header','Zaloguj się');
		App::getSmarty()->assign('form',$this->form);
		App::getSmarty()->display('LoginView.tpl');		
	}
}