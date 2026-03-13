<?php

namespace app\controllers;


use core\App;
use core\SessionUtils;
use core\Utils;
use core\Validator;
use app\forms\ReservationForm;
use app\services\DatabaseUtils;

class SelectAppointmentCtrl{
	private $selectedAppointmentId;
	private $appointments;
	private $doctorId;

	public function __construct(){	
		$this->appointments = [];
	}

	private function getURLParam(&$dest){
		$v = new Validator();
		$dest = Utils::idValidateFromCleanURL($v, 1, true);
	}
	
	private function loadAppointments(){
		$this->appointments = DatabaseUtils::getDoctorsAvailableAppointments($this->doctorId);
		
	}

	private function validate(): bool{
		return !App::getMessages()->isError();
	}

	#region Obsługa akcji

	public function action_showSelectAppointment(){
		$this->getURLParam($this->doctorId);
		if($this->validate())
			$this->loadAppointments();
		$this->generateView();
	}

	public function action_selectAppointment(){
		$this->getURLParam($this->selectedAppointmentId);
		if($this->validate())
		{
			$reservation = new ReservationForm();
			$reservation->appointmentId = $this->selectedAppointmentId;
			SessionUtils::storeObject('reservation',$reservation);
		}
		App::getRouter()->redirectTo("showReservationForm");		
	}

	#endregion

	//Funkcja generująca widok
	private function generateView(){
		App::getSmarty()->assign('appointments', $this->appointments);
		App::getSmarty()->assign('page_title','Wybierz wizytę');
        App::getSmarty()->assign('page_description','Wibierz dogodny termin wizyty.');
        App::getSmarty()->assign('page_header','Wybierz wizytę');
		App::getSmarty()->display('SelectAppointmentView.tpl');	
	}
}