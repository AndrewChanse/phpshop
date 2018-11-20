<?php

class CabinetController 
{
    public function actionIndex() {
        $userID = User::checkLogged();
        $user = User::getUserById($userID);
        //print_r($user); die();
        
        require_once ROOT.'/views/cabinet/index.php';
        return true;
    }
    
    public function actionEdit() {
        $userID = User::checkLogged();
        $user = User::getUserById($userID);
        //print_r($user); die();
        
        $name = $user['name'];
        $password = $user['password'];
        $result = false;
        
        require_once ROOT.'/views/cabinet/edit.php';
        return true;
    }
}
