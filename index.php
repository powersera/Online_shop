<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 12.01.2018
 * Time: 14:37
 */


$string = 12-01-2018;

$regular = '/([0-9]{2})-([0-9]{2})-([0-9]{4})/';


// Front Controller
// 1.Global settings

ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();

// 2. Including system files

define('ROOT', __DIR__);
require_once ROOT.'/components/autoload.php';


// 3. Connecting to DB

// 4. Calling Router
$router = new Router();
$router->run();


