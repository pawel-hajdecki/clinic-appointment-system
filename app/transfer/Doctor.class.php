<?php

namespace app\transfer;

class Doctor{
	public $id;
	public $name;
	public $surname;
	public $photoUrl;
	public $description;
	public $specializations;
	public function __construct($doctor_tb=null){
		if(!$doctor_tb) return;
		$this->id = $doctor_tb['id'];
		$this->name = $doctor_tb['name'];
		$this->surname = $doctor_tb['surname'];
		$this->photoUrl = $doctor_tb['photourl'] ?? null;
		$this->description = $doctor_tb['description'] ?? null;
		$this->specializations = $doctor_tb['specializations'] ?? '';
	}	
}