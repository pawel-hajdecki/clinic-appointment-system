<?php

namespace app\controllers;

use app\forms\AppointmentForm;
use core\App;
use core\Message;
use core\SessionUtils;
use core\Utils;
use app\transfer\Doctor;
use app\transfer\Office;
use DateTime;
use app\transfer\VisitReason;
use app\transfer\Appointment;
use core\ParamUtils;
use core\Validator;
use app\forms\LoginForm;
use app\services\DatabaseUtils;
use app\transfer\User;
use core\RoleUtils;

class EditAppointmentCtrl{
	private $appointmentId;
	private $appointment;
	private $offices;
	private $visitReasons;
	private $doctors;
	public function __construct(){	
		$this->appointment = new AppointmentForm();
	}

	private function getURLParams(){
		$v = new Validator();
		$this->appointmentId = Utils::idValidateFromCleanURL($v, 1);
	}

	private function getFormParams(){
		$v = new Validator();

		$this->appointment->doctorId = Utils::intValidateFromRequest($v, 'doctorId', "Wybierz lekarza z listy.");
		$date = $v->validateFromRequest('date', [
			'date_format' => 'd/m/Y',
			'required' => true,
			'required_message' => 'Podaj datę wizyty.',
			'validator_message' => 'Podaj poprawną datę wizyty - dd/mm/yyyy.',
			'default' => null
		]);
		if($date && $v->isLastOK())
			$this->appointment->date = $date->format('d/m/Y');

		$startTime= $v->validateFromRequest('startTime', [
			'date_format' => 'H:i',
			'required' => true,
			'required_message' => 'Podaj godzinę rozpoczęcia wizyty.',
			'validator_message' => 'Podaj poprawną godzinę rozpoczęcia wizyty - HH:MM.',
			'default' => null
		]);
		if($v->isLastOK() && $startTime)
			$this->appointment->startTime = $startTime->format('H:i');

		$endTime = $v->validateFromRequest('endTime', [
			'date_format' => 'H:i',
			'required' => true,
			'required_message' => 'Podaj godzinę zakończenia wizyty.',
			'validator_message' => 'Podaj poprawną godzinę zakończenia wizyty - HH:MM.',
			'default' => null
		]);
		if($endTime && $v->isLastOK())
			$this->appointment->endTime = $endTime->format('H:i');

		$this->appointment->officeId = Utils::intValidateFromRequest($v, 'officeId', "Wybierz gabinet z listy.");
	}

	private function loadAppointment(){
		if(!$this->appointmentId){
			return;
		}
		try {
			$db_appointment = App::getDB()->get('appointment', [
				'startdatetime(startDateTime)',
				'enddatetime(endDateTime)', 
				'isavailable',
				'iddoctor(doctorId)',
				'idoffice(officeId)',
				'idvisitreason(visitReasonId)',
				'customvisitreason(customVisitReason)'

			], [
				'idappointment' => $this->appointmentId
			]);
			if($db_appointment){
				$this->appointment->preload($db_appointment);
			}
		} catch (\Exception $e) {
			Utils::addErrorMessage('Błąd podczas pobierania danych wizyty.');
		}
		
	}

	private function loadOffices(){
		try {
			$this->offices = array_map(
			function($office) { return new Office($office); },
			App::getDB()->select('office', [
				'office.idoffice(officeId)',
				'office.nameoffice(officeName)'
			], [
				'ORDER' => ['office.nameoffice' => 'ASC']
			]));
		} catch (\Exception $e) {
			Utils::addErrorMessage('Błąd podczas pobierania listy gabinetów.');
			$this->offices = [];
		}
	}


	private function loadDoctors(){
		$this->doctors = DatabaseUtils::getDoctors();
		
	}

	private function validate(): bool{
		return !App::getMessages()->isError();
	}

	private function process(){

		$startDateTime = DateTime::createFromFormat('d/m/Y H:i', $this->appointment->date . ' ' . $this->appointment->startTime);
		$endDateTime = DateTime::createFromFormat('d/m/Y H:i', $this->appointment->date . ' ' . $this->appointment->endTime);
		$clinicStartHour = DateTime::createFromFormat('d/m/Y H:i', $this->appointment->date . ' 7:00');
		$clinicEndHour = DateTime::createFromFormat('d/m/Y H:i', $this->appointment->date . ' 20:00');

		if($startDateTime < new DateTime('now')){
			Utils::addErrorMessage('Data i godzina wizyty musi być w przyszłości.');
		}elseif($startDateTime >= $endDateTime){
			Utils::addErrorMessage('Godzina zakończenia wizyty musi być późniejsza niż godzina rozpoczęcia wizyty.');
		}else if($startDateTime > $clinicEndHour || $endDateTime < $clinicStartHour){
			Utils::addErrorMessage('Wizyty mogą być umawiane tylko w godzinach pracy kliniki (7:00 - 20:00).');
		}
		else{
			$diff = $startDateTime->diff($endDateTime);
			if(($diff->h * 60 + $diff->i)< 5){ 
				Utils::addErrorMessage('Wizyta musi trwać co najmniej 5 minut.');
			}elseif(($diff->h * 60 + $diff->i) > 240){
				Utils::addErrorMessage('Wizyta nie może trwać dłużej niż 4 godzin.');
			}
		}

		if(!App::getMessages()->isError()){
			try {
				if($this->appointmentId)
				{
					App::getDB()->update('appointment', [
						'startdatetime' => DatabaseUtils::DB_DateTimeToString($startDateTime),
						'enddatetime' => DatabaseUtils::DB_DateTimeToString($endDateTime),
						'iddoctor' => $this->appointment->doctorId,
						'idoffice' => $this->appointment->officeId,
						'isavailable' => true
					], [
						'idappointment' => $this->appointmentId
					]);
				}else{
					App::getDB()->insert('appointment', [
						'startdatetime' => DatabaseUtils::DB_DateTimeToString($startDateTime),
						'enddatetime' => DatabaseUtils::DB_DateTimeToString($endDateTime),
						'iddoctor' => $this->appointment->doctorId,
						'idoffice' => $this->appointment->officeId,
						'isavailable' => true
					]);
				}
				Utils::addInfoMessage('Pomyślnie zapisano wizytę.');
			} catch (\Exception $e) {
				Utils::addErrorMessage('Błąd podczas zapisywania wizyty.');
			}
		}

	}
	#region Obsługa akcji

	public function action_showNewAppointmentForm(){
		$this->loadDoctors();
		$this->loadOffices();
		$this->generateView();
	}

	public function action_editAppointment(){
		$this->getURLParams();
		$this->loadAppointment();
		$this->loadDoctors();
		$this->loadOffices();
		$this->generateView();
	}

	public function action_saveAppointment(){
		$this->getFormParams();
		if($this->validate()){
			$this->process();
		}	
		$this->loadDoctors();
		$this->loadOffices();
		$this->generateView();
	}

	#endregion

	//Funkcja generująca widok
	private function generateView(){
		App::getSmarty()->assign('appointment', $this->appointment);
		App::getSmarty()->assign('appointmentId', $this->appointmentId);
		App::getSmarty()->assign('doctors', $this->doctors);
		App::getSmarty()->assign('offices', $this->offices);
		App::getSmarty()->assign('page_title','Edycja wizyty');
        App::getSmarty()->assign('page_description','Edytuj wizytę w systemie rezerwacji kliniki');
        App::getSmarty()->assign('page_header','Wizyta');
		App::getSmarty()->display('EditAppointmentView.tpl');	
	}
}