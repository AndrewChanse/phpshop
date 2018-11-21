<?php

abstract class AdminBase 
{
    public function __construct() {
        $userID = User::checkLogged();
        $user = User::getUserById($userID);
        
        if($user['role'] == 'admin') {
            return true;
        }
        die('Access Denied!');
    }
}
