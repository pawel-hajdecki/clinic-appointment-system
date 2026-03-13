<?php

namespace app\controllers;

use core\App;
use core\Message;
use core\Utils;

class MainPageCtrl {
    
    public function action_showMainPage(){
        App::getSmarty()->display("MainPageView.tpl");
        
    }
    
}
