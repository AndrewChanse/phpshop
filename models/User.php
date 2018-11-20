<?php

class User 
{
    public static function register($name, $email, $password) {
        $dbPDO = DbConnector::getConnect();
        $sql = 'INSERT INTO user (name, email, password)'
                . 'VALUES(:name, :email, :password)';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
    }
    
    public static function checkName($name) {
        if(strlen($name) >= 2) {
            return true;
        }
        return false;
    }
    
    public static function checkEmail($email) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    
    public static function checkEmailExist($email) {
        $dbPDO = DbConnector::getConnect();
        $sql = 'SELECT COUNT(*) FROM user WHERE email= :email';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        if ($result->fetchColumn()){
            return true;
        }
        return false;
    }
    
    public static function checkPass($password) {
        if(strlen($password) >= 6) {
            return true;
        }
        return false;
    }
    
    public static function checkLoginData($email, $password) {
        $dbPDO = DbConnector::getConnect();
        $sql = 'SELECT id FROM user WHERE email= :email AND password= :password';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $user = $result->fetch();
        if($user) {
            return $user['id'];
        }
        return false;
    }
    
    public static function auth($userID) {
        $_SESSION['user'] = $userID;
    }
    
    public static function checkLogged() {
        if(isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header("Location: /user/login");
    }
    
    public static function getUserById($id) {
        $id = intval($id);
        $dbPDO = DbConnector::getConnect();
        $sql = 'SELECT * FROM user WHERE id= :id';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $user = $result->fetch();
        return $user;
    }
    
    public static function isGuest() {
        if(isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }
}
