<?php

namespace app\controllers;

use core\App;
use core\SessionUtils;
use core\RoleUtils;
use app\transfer\User;
use Lng;

class MyAccountCtrl{
    private $user;

    public function __construct(){
        $this->user = null;
    }

    private function loadUser(){
        $this->user = SessionUtils::loadObject('user', true);
    }

    public function action_showMyAccount(){
        $this->loadUser();
        $this->generateView();
    }

    private function generateView(){
        App::getSmarty()->assign('user', $this->user);
        App::getSmarty()->assign('page_title','Moje konto');
        App::getSmarty()->assign('page_description','Dane konta');
        App::getSmarty()->assign('page_header','Moje konto');
        App::getSmarty()->display('MyAccountView.tpl');
    }
}
