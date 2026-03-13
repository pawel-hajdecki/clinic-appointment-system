<?php

namespace app\controllers;

use core\App;
use app\transfer\User;
use core\Utils;
use core\Validator;
use core\RoleUtils;
use app\services\DatabaseUtils;

class PatientsManCtrl{
    private $selectedPatient;
    private $patients;

    public function __construct(){
        $this->patients = [];
    }

    private function getURLParams(){
        $v = new Validator();

        $this->selectedPatient = $v->validateFromCleanURL(1,[
            'int'=>true,
            'is_numeric' => true,
            'default' => null
        ]);
    }

    private function loadPatients(){
        $this->patients = DatabaseUtils::getPatients();
    }
    
    #region Obsługa akcji

    public function action_showPatientsMan(){
        $this->loadPatients();
        $this->generateView();
    }

    public function action_confirmDeclaration(){
        $this->getURLParams();
        if($this->selectedPatient){

            $statusId = App::getDB()->get('useraccountstatus', 'idstatus', ['namestatus' => 'active']);
            if($statusId){
                App::getDB()->update('system_user', [
                    'idstatus' => $statusId
                ], [
                    'iduser' => $this->selectedPatient
                ]);
                Utils::addInfoMessage('Deklaracja pacjenta została potwierdzona.');
            }
        }
        App::getRouter()->redirectTo("showPatientsMan");
    }

    public function action_deletePatient(){
        $this->getURLParams();
        if($this->selectedPatient){
            
            App::getDB()->update('appointment', [
                'patientiduser' => null,
                'idvisitreason' => null,
                'reservedbyiduser' => null,
                'customvisitreason' => null,
                'reservationdatetime' => null, 
                'isavailable' => true
            ], [
                'patientiduser' => $this->selectedPatient,
            ]);
            
            App::getDB()->delete('role_user',['iduser'=>$this->selectedPatient]);
            App::getDB()->delete('system_user',['iduser'=>$this->selectedPatient]);
            Utils::addInfoMessage('Pacjent został usunięty.');
        }
        App::getRouter()->redirectTo("showPatientsMan");
    }

    #endregion

    //Funkcja generująca widok
    private function generateView(){
        App::getSmarty()->assign('patients', $this->patients);
        App::getSmarty()->assign('isReceptionist', RoleUtils::inRole('receptionist'));
        App::getSmarty()->assign('isAdmin', RoleUtils::inRole('admin'));
        App::getSmarty()->assign('page_title','Zarządzanie pacjentami');
        App::getSmarty()->assign('page_description','Lista pacjentów');
        App::getSmarty()->assign('page_header','Pacjenci');
        App::getSmarty()->display('PatientsManView.tpl');    
    }
}
