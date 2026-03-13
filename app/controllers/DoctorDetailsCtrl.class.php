<?php

namespace app\controllers;

use core\App;
use core\Message;
use core\SessionUtils;
use core\Utils;
use app\transfer\Doctor;
use core\ParamUtils;
use app\forms\LoginForm;
use app\transfer\User;
use core\RoleUtils;

class DoctorDetailsCtrl{
	private $doctor;
	public function __construct(){	
		$this->doctor = new Doctor();
	}

	private function getParams(){
		try {
			$tmp = App::getDB()->get('system_user', [
				'[>]doctorinfo' => ['iduser' => 'iduser'],
				'[>]doctor_specialization' => ['iduser' => 'iddoctor'],
				'[>]specialization'        => ['doctor_specialization.idspecialization' => 'idspecialization'],

			], [
				'system_user.iduser(id)',
				'system_user.nameuser(name)',
				'system_user.surname',
				'system_user.photourl',
				'doctorinfo.description',
				'specializations' => App::getDB()->raw('GROUP_CONCAT(DISTINCT specialization.namespecialization ORDER BY specialization.namespecialization SEPARATOR \', \')')
			], [
				'system_user.iduser' => ParamUtils::getFromCleanURL(1)
			]);
			$this->doctor = new Doctor($tmp);
		} catch (\Exception $e) {
			Utils::addErrorMessage('Błąd podczas pobierania danych lekarza.');
		}
	}
	

	#region Obsługa akcji

	public function action_showDoctorDetails(){
		$this->getParams();
		$this->generateView();
	}
	#endregion

	//Funkcja generująca widok
	private function generateView(){
		App::getSmarty()->assign('doctor', $this->doctor);
		$blockReservation = false;
		$user = SessionUtils::loadObject('user', true);
			if($user && $user->status !== 'active'){
				$blockReservation = true;
			}
		App::getSmarty()->assign('blockReservation', $blockReservation);
		App::getSmarty()->assign('page_title','Szczegóły lekarza');
        App::getSmarty()->assign('page_description','Szczegóły wybranego lekarza');
        App::getSmarty()->assign('page_header','Szczegóły lekarza');
		App::getSmarty()->display('DoctorDetailsView.tpl');	
	}
}