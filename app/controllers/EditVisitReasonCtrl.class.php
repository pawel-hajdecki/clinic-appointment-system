<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\Validator;
use app\forms\PredefinedVisitReasonForm;

class EditVisitReasonCtrl{
	private $visitReasonId;
	private $visitReason;
	public function __construct(){	
		$this->visitReason = new PredefinedVisitReasonForm();
	}
	private function getURLParams(){
		$v= new Validator();
		$this->visitReasonId = Utils::idValidateFromCleanURL($v, 1);
	}

	private function getFormParams(){
		$v = new Validator();
		
		$this->visitReason->name = Utils::stringValidateFromRequest($v,'name',true,"Nazwa jest wymagana.","Nazwa powinna mieścić się pomiędzy 2 i 50 znakami.",null,2,50);

		$this->visitReason->isEnable = ParamUtils::getFromRequest('isEnable') ?? false;
	}

	private function loadVisitReason(){
		if(!$this->visitReasonId){
			return;
		}
		$db_visitReason = App::getDB()->get('visitreason', [
			'namevisitreason(name)',
			'isenable(isEnable)'
		], [
			'idvisitreason' => $this->visitReasonId
		]);

		if($db_visitReason){
			$this->visitReason->preload($db_visitReason);
		}
		
	}

	private function validate(): bool{
		return !App::getMessages()->isError();
	}

	private function process(){ //zwraca true jeśli przetwarzanie się powiodło

		$this->visitReason->name = Utils::capitalize($this->visitReason->name);

		if($this->visitReasonId)
		{
			App::getDB()->update('visitreason', [
				'namevisitreason' => $this->visitReason->name,
				'isenable' => (int)$this->visitReason->isEnable	
			], [
				'idvisitreason' => $this->visitReasonId
			]);	
		}else{

			$db_duplicates = App::getDB()->count('visitreason', [
    			'namevisitreason' => $this->visitReason->name
			]);

			if($db_duplicates > 0)
			{
				Utils::addErrorMessage("Predefiniowana przyczyna o tej nazwie już istnieje.");
				return;
			}
			
			App::getDB()->insert('visitreason', [
				'namevisitreason' => $this->visitReason->name,
				'isenable' => (int)$this->visitReason->isEnable
			]);		
		}
		Utils::addInfoMessage('Pomyślnie zapisano.');
	}
	#region Obsługa akcji

	public function action_showVisitReasonForm(){
		$this->getURLParams();
		$this->loadVisitReason();
		$this->generateView();
	}

	public function action_saveVisitReason(){
		$this->getURLParams();
		$this->getFormParams();
		if($this->validate()){
			$this->process();
		}
		$this->generateView();
	}

	#endregion

	//Funkcja generująca widok
	private function generateView(){
		App::getSmarty()->assign('visitReason', $this->visitReason);
		App::getSmarty()->assign('visitReasonId', $this->visitReasonId);
		App::getSmarty()->assign('page_title','Edycja predefiniowanej przyczyny wizyty');
        App::getSmarty()->assign('page_description','Edycja predefiniowanej przyczyny wizyty');
        App::getSmarty()->assign('page_header','Predefiniowana przyczyna wizyty');
		App::getSmarty()->display('EditVisitReasonView.tpl');	
	}
}