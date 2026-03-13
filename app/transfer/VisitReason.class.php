<?php

namespace app\transfer;

class VisitReason{
	public $id;
    public $name;  
	public $isEnable;
	
	public function __construct($visitReason_tb){
		if(!$visitReason_tb) return;
		$this->id = $visitReason_tb['visitReasonId'];
		$this->name = $visitReason_tb['visitReasonName'];
		$this->isEnable = $visitReason_tb['isEnable'];
	}	
}