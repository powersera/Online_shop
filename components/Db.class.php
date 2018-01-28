<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 15.01.2018
 * Time: 11:10
 */

class Db
{

public static function getConnection(){

    $paramPath = ROOT.'/config/DB_config.php';
    $params = include $paramPath;

    $db = new PDO("mysql:host = {$params['host']}; dbname = {$params['dbName']}",$params['login'],$params['password']);

    return $db;

}



}