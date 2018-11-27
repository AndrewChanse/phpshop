<?php

class DbConnector 
{
    public static function getConnect() {
        $paramPath = ROOT.'/config/db_params.php';
        $con = include $paramPath;
        
        $dsn = "mysql:host={$con['host']}; dbname={$con['dbname']}; charset={$con['charset']}";
        $dbPDO = new PDO($dsn, $con['user'], $con['password']);
        return $dbPDO;
    }
}
