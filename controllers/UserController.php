<?php

class UserController 
{
    public function actionRegister() {
        $name = false;
        $email = false;
        $password = false;
        $result = false;
        
        if(isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $errors = false;
            
            if(!User::checkName($name)) {
                $errors[] = 'UserName must be 2 or more symbols!';
            }
            if(!User::checkEmail($email)) {
                $errors[] = 'Incorrect E-mail!';
            }
            if(User::checkEmailExist($email)) {
                $errors[] = 'E-mail already Exists!';
            }
            if(!User::checkPassword($password)) {
                $errors[] = 'Password less than 6 symbols!';
            }
            
            if($errors == false) {
                $result = User::registerUser($name, $email, $password);
            }
        }
        require_once ROOT.'/views/user/register.php';
        return true;
    }
    
    public function actionLogin() {
        $email = false;
        $password = false;
        $result = false;
        
        if(isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $errors = false;
            
            if(!User::checkEmail($email)) {
                $errors[] = 'Incorrect E-mail!';
            }

            if(!User::checkPassword($password)) {
                $errors[] = 'Password less than 6 symbols!';
            }
            
            $userID = User::checkLoginData($email, $password);
            //print_r($userID); die();
            if($userID == false) {
                $errors[] = 'Incorrect Login Data!';
            }
            if($errors == false) {
                User::auth($userID);
                header("Location: /cabinet");
            }
        }
        require_once ROOT.'/views/user/login.php';
        return true;
    }
    
    public function actionLogout() {
        unset($_SESSION['user']);
        header("Location: /");
    }
}
