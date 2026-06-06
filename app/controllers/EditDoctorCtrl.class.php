<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\Validator;
use app\forms\DoctorForm;

class EditDoctorCtrl{
    private $doctorId;
    private $doctorForm;
    public function __construct(){    
        $this->doctorForm = new DoctorForm();
    }
    private function getURLParams(){
        $v= new Validator();
        $this->doctorId = Utils::idValidateFromCleanURL($v, 1);
    }

    private function getFormParams(){
        $v = new Validator();
        $this->doctorForm->name = Utils::nameValidateFromRequest($v,'name',true);
        $this->doctorForm->surname = Utils::surnameValidateFromRequest($v,'surname',true);
        $this->doctorForm->description = Utils::stringValidateFromRequest($v,'description',false,null,null,null,0,300);
        $this->doctorForm->photoUrl = Utils::stringValidateFromRequest($v,'photoUrl',false,null,'Zdjęcie musi mieć rozszerzenie .jpg, .png lub .webp i długość do 110 znaków','/^.{2,100}\.(jpg|png|webp)$/i');
        $specializations = ParamUtils::getFromRequest('specializations');
        if (is_array($specializations)) {
            $this->doctorForm->specializations = array_map('intval', $specializations); // konwersja na int
        } else {
            $this->doctorForm->specializations = [];
        }
        $customSpecEnable = ParamUtils::getFromRequest('customSpecEnable') ? true : false;
        $customSpecRaw = Utils::stringValidateFromRequest($v,
        'customSpecializations',false,null,
        'Specjalizacje mogą zawierać tylko litery i spacje, rozdzielone przecinkami',
        '/^[\p{L}\s]+(,\s*[\p{L}\s]+)*$/u'); // nazwy (litery i spacje) rozdzielone przecinkami - min 1 nazwa
        $this->doctorForm->newSpecializationsRaw = $customSpecEnable && $customSpecRaw ? $customSpecRaw : '';
        if ($customSpecEnable && !Utils::isEmptyString($customSpecRaw)) {
            $parts = array_map('trim', explode(',', $customSpecRaw));
            $parts = array_filter($parts, function($v){ return $v !== ''; });
            $this->doctorForm->newSpecializations = array_values($parts);
        } else {
            $this->doctorForm->newSpecializations = [];
        }
    }

    private function loadDoctor(){
        if(!$this->doctorId){
            return;
        }
        $db_doctor = App::getDB()->get('system_user', [
            '[>]doctor_info' => ['id_user' => 'id_user']
        ], [
            'system_user.nameuser(name)',
            'system_user.surname',
            'system_user.photo_url(photourl)',
            'doctor_info.description(description)'
        ], [
            'system_user.id_user' => $this->doctorId
        ]);

        if($db_doctor){
            $this->doctorForm->preload($db_doctor);
        }
        // load specializations ids
        $specs = App::getDB()->select('doctor_specialization', ['idspecialization'], ['id_doctor' => $this->doctorId]);
        if ($specs) {
            if (isset($specs[0]) && is_array($specs[0])) {
                $ids = array_column($specs, 'idspecialization');
            } else {
                $ids = $specs;
            }
            $this->doctorForm->specializations = array_map('intval', $ids);
        } else {
            $this->doctorForm->specializations = [];
        }
        $this->doctorForm->newSpecializations = [];
        $this->doctorForm->newSpecializationsRaw = '';
        
    }

    private function validate(): bool{
        return !App::getMessages()->isError();
    }

    private function process(){
        if(Utils::isEmptyString($this->doctorForm->photoUrl)){
            $this->doctorForm->photoUrl = null;
        }

        $allSpecIds = $this->doctorForm->specializations;
        foreach ($this->doctorForm->newSpecializations as $specNameRaw) {
            $specName = Utils::capitalize(trim($specNameRaw));
            if (strlen($specName) > 50) {
                Utils::addErrorMessage("Nazwa specjalizacji '{$specName}' jest zbyt długa (max 50 znaków).");
                return;
            }
            $existingId = App::getDB()->get('specialization','id_specialization',[ 'name_specialization' => $specName ]);
            if ($existingId) {
                $allSpecIds[] = (int)$existingId;
            } else {
                App::getDB()->insert('specialization',[ 'name_specialization' => $specName ]);
                $newId = App::getDB()->id();
                if ($newId) {
                    $allSpecIds[] = (int)$newId;
                }
            }
        }

        $allSpecIds = array_values(array_unique(array_map('intval', $allSpecIds)));
        if($this->doctorId)
        {
            App::getDB()->update('system_user', [
                'name_user' => $this->doctorForm->name,
                'surname' => $this->doctorForm->surname,
                'photo_url' => $this->doctorForm->photoUrl
            ], [
                'id_user' => $this->doctorId
            ]);
            App::getDB()->update('doctor_info', [
                'description' => $this->doctorForm->description
            ], [
                'id_user' => $this->doctorId
            ]);

            App::getDB()->delete('doctor_specialization', ['id_doctor' => $this->doctorId]);
            foreach ($allSpecIds as $specId) {
                App::getDB()->insert('doctor_specialization', [
                    'id_doctor' => $this->doctorId,
                    'id_specialization' => (int)$specId
                ]);
            }
        }else{

            App::getDB()->insert('system_user', [
                'name_user' => $this->doctorForm->name,
                'surname' => $this->doctorForm->surname,
                'photo_url' => $this->doctorForm->photoUrl
            ]);
            $newId = App::getDB()->id();
            if($newId){
                App::getDB()->insert('role_user', [
                    'id_role' => 5, // doctor
                    'id_user' => $newId
                ]);
                App::getDB()->insert('doctor_info', [
                    'description' => $this->doctorForm->description,
                    'id_user' => $newId
                ]);

                foreach ($allSpecIds as $specId) {
                    App::getDB()->insert('doctor_specialization', [
                        'id_doctor' => $newId,
                        'id_specialization' => (int)$specId
                    ]);
                }
            }
        }
        Utils::addInfoMessage('Pomyślnie zapisano.');
    }
    #region Obsługa akcji

    public function action_showDoctorForm(){
        $this->getURLParams();
        $this->loadDoctor();
        $this->generateView();
    }

    public function action_saveDoctor(){
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
        App::getSmarty()->assign('doctor', $this->doctorForm);
        App::getSmarty()->assign('doctorId', $this->doctorId);
        // load all specializations for the multi-select
        $allSpecs = App::getDB()->select('specialization', ['id_specialization(id)', 'name_specialization(name)'], ['ORDER' => ['name_specialization' => 'ASC']]);
        App::getSmarty()->assign('allSpecializations', $allSpecs);
        App::getSmarty()->assign('page_title','Edycja lekarza');
        App::getSmarty()->assign('page_description','Edycja danych lekarza');
        App::getSmarty()->assign('page_header','Lekarz');
        App::getSmarty()->display('EditDoctorView.tpl');    
    }
}
