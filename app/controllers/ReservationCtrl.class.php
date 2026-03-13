<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\Validator;
use app\forms\ReservationForm;
use app\services\DatabaseUtils;
use core\RoleUtils;
use core\SessionUtils;

class ReservationCtrl{
	private $reservation;
	private $visitReasons;
	private $patients;
	public function __construct(){	
		$this->visitReasons = [];
		$this->patients = [];
		$this->reservation = new ReservationForm();
	}
	private function getURLParams(){
		
	}

	private function getFormParams(){
		$v = new Validator();

		$this->reservation->customVisitReasonEnable = ParamUtils::getFromRequest('customVisitReasonEnable') ? true : false;

		if($this->reservation->customVisitReasonEnable)
			$this->reservation->customVisitReason = Utils::stringValidateFromRequest($v,'customVisitReason',true,"Wpisz przyczynę wizyty.","Zaznaczyłeś Inną przyczynę wizyty - wpisz ją (5-100 znaków).",null,5,100);
		else
			$this->reservation->visitReasonId = Utils::intValidateFromRequest($v,'visitReasonId',"Wybierz przyczynę wizyty.");

		if(!RoleUtils::inRole('patient'))
			$this->reservation->patientId = Utils::intValidateFromRequest($v,'patientId',"Wybierz pacjenta");  
	}

	private function loadVisitReasons(){
		$this->visitReasons = DatabaseUtils::getVisitReasons(true);
	}
	
	private function loadPatients(){
		$this->patients =  DatabaseUtils::getPatients(true);
	}


	private function loadReservationAppointmentId(){
		$sesion_reservation = SessionUtils::loadObject('reservation', true);
		if($sesion_reservation && $sesion_reservation->appointmentId)
			$this->reservation->appointmentId = $sesion_reservation->appointmentId;
		else
			Utils::addErrorMessage("Błąd wewnętrzny - wróć na stronę wyboru wizyty!");
	}

	private function cleanReservationFromSession(){
		SessionUtils::loadObject('reservation', false);
	}

	private function validate(): bool{
		return !App::getMessages()->isError();
	}

	private function process(){
		$currentUser = SessionUtils::loadObject('user',true);
		try{
			App::getDB()->update('appointment', [
				'patientiduser' => $this->reservation->patientId ?? $currentUser->id,
				'reservedbyiduser' => $currentUser->id,
				'idvisitreason' => $this->reservation->visitReasonId,
				'customvisitreason' => $this->reservation->customVisitReason,
				'reservationdatetime' => DatabaseUtils::DB_DateTimeToString(new \DateTime('now')),
				'isavailable' => (int)false
			], [
				'idappointment' => $this->reservation->appointmentId
			]);
			Utils::addInfoMessage('Pomyślnie zapisano rezerwację.');
			$this->cleanReservationFromSession();
		} catch (\PDOException $e){
			Utils::addErrorMessage("Wystąpił błąd podczas zapisywania rezerwacji.");
		}
	}
	#region Obsługa akcji

	public function action_showReservationForm(){
		$this->loadVisitReasons();
		if(!RoleUtils::inRole('patient'))
			$this->loadPatients();
		$this->generateView();
	}

	public function action_saveReservation(){
		$this->getFormParams();
		$this->loadReservationAppointmentId();
		if($this->validate()){
			$this->process();
		}
		$this->action_showReservationForm();
	}

	#endregion

	//Funkcja generująca widok
	private function generateView(){
		App::getSmarty()->assign('patients', $this->patients);
		App::getSmarty()->assign('visitReasons', $this->visitReasons);
		App::getSmarty()->assign('reservation', $this->reservation);
		App::getSmarty()->assign('page_title','Wybierz przyczynę i umów wizytę');
        App::getSmarty()->assign('page_description','Wybierz przyczynę i umów wizytę');
        App::getSmarty()->assign('page_header','Wybierz przyczynę i umów wizytę');
		App::getSmarty()->display('ReservationView.tpl');	
	}
}