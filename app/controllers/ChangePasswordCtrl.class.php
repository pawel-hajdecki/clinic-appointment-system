<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\Validator;
use core\SessionUtils;
use app\forms\ChangePasswordForm;

class ChangePasswordCtrl {
    private $form;
    private $userId;

    public function __construct(){
        $this->form = new ChangePasswordForm();
        $this->userId = null;
    }

    private function getURLParams(){
        $v = new Validator();
        $this->userId = Utils::idValidateFromCleanURL($v, 1);
    }

    private function getParams(){
        $v = new Validator();
        $this->form->new_password = Utils::passwordValidateFromRequest($v, 'new_password', true);
        $this->form->confirm_password = ParamUtils::getFromRequest('confirm_password');
        if ($this->form->new_password !== $this->form->confirm_password) {
            Utils::addErrorMessage('Hasła się nie zgadzają.');
        }
    }

    private function validate(){
        if(App::getMessages()->isError()) return false;
        if(!$this->userId){
            Utils::addErrorMessage('Brak ID użytkownika.');
            return false;
        }
        return !App::getMessages()->isError();
    }

    private function process(){
        try {
            $newHash = password_hash($this->form->new_password, PASSWORD_DEFAULT);
            App::getDB()->update('system_user', ['password' => $newHash], ['iduser' => $this->userId]);
            Utils::addInfoMessage('Hasło zostało zmienione.');
            SessionUtils::remove('change_password_user_id');
        } catch (\Exception $e) {
            Utils::addErrorMessage('Błąd podczas zmiany hasła.');
        }
    }

    #region Actions

    public function action_showChangePasswordForm(){
        $this->getURLParams();
        if($this->userId){
            SessionUtils::store('change_password_user_id', $this->userId);
        }
        $this->generateView();
    }

    public function action_changePassword(){
        $this->userId = SessionUtils::load('change_password_user_id', true);
        $this->getParams();
        if($this->validate()){
            $this->process();
        }
        $this->generateView();
    }

    #endregion

    private function generateView(){
        App::getSmarty()->assign('page_title','Zmiana hasła');
        App::getSmarty()->assign('page_description','Zmień swoje hasło');
        App::getSmarty()->assign('page_header','Zmiana hasła');
        App::getSmarty()->assign('form',$this->form);
        App::getSmarty()->display('ChangePasswordView.tpl');
    }
}
