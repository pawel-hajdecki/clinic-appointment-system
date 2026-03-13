<?php
namespace app\forms;
use app\transfer\User;
use core\Utils;

class ReservationForm {
	public $patientId;
	public $appointmentId;
	public $visitReasonId;
	public $customVisitReason;
	public $customVisitReasonEnable;
} 