<?php

namespace app\transfer;

class User{
	public $id;
	public $login;
	public $name;
	public $surname;
	public $pesel;
	public $status;
	
	public function __construct($user_tb){
		if(!$user_tb) return;
		$this->id = $user_tb['id'] ?? null;
		$this->login = $user_tb['login'] ?? null;
		$this->name = $user_tb['name'] ?? null;
		$this->surname = $user_tb['surname'] ?? null;
		$this->pesel = $user_tb['pesel'] ?? null;
		$this->status = $user_tb['status'] ?? null;	
	}	
}