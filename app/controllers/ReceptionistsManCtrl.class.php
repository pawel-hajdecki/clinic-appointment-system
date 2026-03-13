<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\Validator;
use app\services\DatabaseUtils;

class ReceptionistsManCtrl{
    private $selectedReceptionist;
    private $receptionists;

    public function __construct(){
        $this->receptionists = [];
    }

    private function getURLParams(){
        $v = new Validator();
        $this->selectedReceptionist = Utils::idValidateFromCleanURL($v, 1);
    }

    private function loadReceptionists(){
        $this->receptionists = DatabaseUtils::getReceptionists();
    }
    
    #region Obsługa akcji

    public function action_showReceptionistsMan(){
        $this->loadReceptionists();
        $this->generateView();
    }

    public function action_deleteReceptionist(){
        $this->getURLParams();
        if($this->selectedReceptionist){
            try {
                App::getDB()->delete('role_user',['iduser'=>$this->selectedReceptionist]);
                App::getDB()->delete('system_user',['iduser'=>$this->selectedReceptionist]);
                Utils::addInfoMessage('Recepcjonista został usunięty.');
            } catch (\Exception $e) {
                Utils::addErrorMessage('Błąd podczas usuwania recepcjonisty.');
            }
        }
        App::getRouter()->redirectTo("showReceptionistsMan");
    }

    #endregion

    //Funkcja generująca widok
    private function generateView(){
        App::getSmarty()->assign('receptionists', $this->receptionists);
        App::getSmarty()->assign('page_title','Zarządzanie recepcjonistami');
        App::getSmarty()->assign('page_description','Lista recepcjonistów');
        App::getSmarty()->assign('page_header','Recepcjoniści');
        App::getSmarty()->display('ReceptionistsManView.tpl');    
    }
}
