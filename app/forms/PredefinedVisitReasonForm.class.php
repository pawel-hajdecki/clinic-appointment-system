<?php
namespace app\forms;
use app\transfer\User;
use core\Utils;

class PredefinedVisitReasonForm {
	public $name;
	public $isEnable;
	 
	public function __construct() {
	}

	public function preload($visitReason_tb) {
		if(!$visitReason_tb) return;
		$this->name = $visitReason_tb['name'];
		$this->isEnable = $visitReason_tb['isEnable'];
		
	}
} 