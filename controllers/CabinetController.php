<?php

class CabinetController 
{
    public function actionIndex() {
        $userID = User::checkLogged();
        $user = User::getUserById($userID);
        
        
        require_once ROOT.'/views/cabinet/index.php';
        return true;
    }
}
