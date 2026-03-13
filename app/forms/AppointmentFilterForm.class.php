<?php

namespace app\forms;

class AppointmentFilterForm {
	public $dateTimeFrom;
	public $dateTimeTo;
	public $name;
	public $appointmentStatus;

	public function __construct() {
		$this->dateTimeFrom = null;
		$this->dateTimeTo = null;
		$this->name = null;
		$this->appointmentStatus = null;
	}
}
