<?php

class DbConnector 
{
    public static function getConnect() {
        $paramPath = ROOT.'/config/db_params.php';
        $con = include $paramPath;
        
        $dns = "mysql:host={$con['host']}; dbname={$con['dbname']}; charset={$con['charset']}";
        $dbPDO = new PDO($dns, $con['user'], $con['password']);
        return $dbPDO;
    }
}
