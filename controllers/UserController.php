<?php

class UserController 
{
    public function actionRegister() {
        $result = false;
        
        if(isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $errors = false;
            
            if(!User::checkName($name)) {
                $errors[] = 'Wrong Name';
            }
            if(!User::checkEmail($email)) {
                $errors[] = 'Wrong email';
            }
            if(User::checkEmailExist($email)) {
                $errors[] = 'Email exist!';
            }
            if(!User::checkPass($password)) {
                $errors[] = 'Wrong password';
            }
            
            if($errors == false) {
                $result = User::register($name, $email, $password);
            }
        }
        require_once ROOT.'/views/user/register.php';
        return true;
    }
    
    public function actionLogin() {
        if(isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $errors = false;
            
            if(!User::checkEmail($email)) {
                $errors[] = 'Wrong email';
            }
            if(!User::checkPass($password)) {
                $errors[] = 'Wrong password';
            }
            
            $userID = User::checkLoginData($email, $password);
            if($userID == false) {
                $errors[] = 'Wrong Login Data!';
            } else {
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
