<?php
namespace app\forms;

use app\services\DatabaseUtils;
use app\transfer\User;
use core\Utils;

class AppointmentForm {
	public $patientId;
	public $doctorId;
	public $reservationDatetime;
	public $date;
	public $startTime;
	public $endTime;
	public $officeId;
	public $visitReasonId;
	public $customVisitReason;
	 
	public function __construct() {
	}

	public function preload($appointment_tb) {
		if(!$appointment_tb) return;
		//$this->patientId = $appointment_tb['patientId'];
		$this->doctorId = $appointment_tb['doctorId'];
		//$this->reservationDatetime = $appointment_tb['reservationDatetime'];
		$startDateTime = DatabaseUtils::DB_toDateTime($appointment_tb['startDateTime']);
		$endDateTime = DatabaseUtils::DB_toDateTime($appointment_tb['endDateTime']);
		$this->date= $startDateTime->format('d/m/Y');
		$this->startTime = $startDateTime->format('H:i');
		$this->endTime = $endDateTime->format('H:i');
		$this->officeId = $appointment_tb['officeId'];
		$this->visitReasonId = $appointment_tb['visitReasonId'];
		$this->customVisitReason = $appointment_tb['customVisitReason'];
	}
} 