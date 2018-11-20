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
                header("Location: /cabinet");
            }
        }
        require_once ROOT.'/views/user/register.php';
        return true;
    }
    
    public function actionLogin() {
        
        
        require_once ROOT.'/views/user/login.php';
        return true;
    }
}
