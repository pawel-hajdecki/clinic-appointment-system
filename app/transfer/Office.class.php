<?php

namespace app\transfer;

class Office{
	public $id;
    public $name;   
	
	public function __construct($office_tb){
		if(!$office_tb) return;
		$this->id = $office_tb['officeId'];
		$this->name = $office_tb['officeName'];
	}	
}