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
use app\services\DatabaseUtils;

class DoctorsGridCtrl{
	private $doctors;
	
	public function __construct(){
		$this->doctors = [];
	}

	private function getDoctorsFromDB() {
        $this->doctors = DatabaseUtils::getDoctors(false, true);
	}
	

	#region Obsługa akcji

	public function action_showDoctorsGrid(){
		$this->getDoctorsFromDB();
		$this->generateView();
	}
	#endregion

	//Funkcja generująca widok
	private function generateView(){
		App::getSmarty()->assign('doctors', $this->doctors);
		App::getSmarty()->assign('page_title','Lekarze');
        App::getSmarty()->assign('page_description','Lista dostępnych lekarzy');
        App::getSmarty()->assign('page_header','Dostępni lekarze');
		App::getSmarty()->display('DoctorsGridView.tpl');	
	}
}