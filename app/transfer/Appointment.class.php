<?php

namespace app\transfer;

use app\services\DatabaseUtils;
use core\Utils;

class Appointment{
	public $patientName;
	public $patientSurname;
	public $patientPesel;
	public $doctor;
	public $officeName;
	public $isAvailable;
	public $date;
	public $id;
	public $selfReserved;
	public $startTime;
	public $endTime;
	public $visitReason;
	
	public function __construct($appointment_tb){
		if(!$appointment_tb) return;
		$this->id = $appointment_tb['id'];
		$this->patientName = $appointment_tb['name'] ?? null;
		$this->patientSurname = $appointment_tb['surname'] ?? null;
		$this->patientPesel = $appointment_tb['pesel'] ?? null;
		$this->doctor = new Doctor();
		$this->doctor->id = $appointment_tb['doctorId'] ?? null;
		$this->doctor->name = $appointment_tb['doctorName'] ?? null;
		$this->doctor->surname = $appointment_tb['doctorSurname'] ?? null;
		$this->visitReason = $appointment_tb['visitReason'] ?? null;
		$this->officeName = $appointment_tb['officeName'] ?? null;
		$this->isAvailable = $appointment_tb['isavailable'] ?? null;
		$this->selfReserved = $appointment_tb['selfReserved'] ?? null;
		$startDatetime = DatabaseUtils::DB_toDateTime($appointment_tb['startDatetime']);
		$endDatetime = DatabaseUtils::DB_toDateTime($appointment_tb['endDatetime']);
		$this->date = $startDatetime->format('d/m/Y');
		$this->startTime = $startDatetime->format('H:i');
		$this->endTime = $endDatetime->format('H:i');
	}	
}