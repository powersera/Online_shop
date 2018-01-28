<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 12.01.2018
 * Time: 14:42
 */

class Router
{
private $routes;

public function __construct()
{

    $routesPath = ROOT.'/config/routes.php';
    $this->routes = include($routesPath);
}
/*
 * Returns request string
 */
private function GetStringQuery(){
    if (!empty($_SERVER['REQUEST_URI'])){
        return trim($_SERVER['REQUEST_URI'],'/');
    }

    }

/*
 * Takes control from Front Controller
 */
public function run(){
    // Receive query string
    $uri = $this->GetStringQuery();
    //var_dump($uri);



    // Check query in routes.php

    foreach ( $this->routes as $uriPattern => $path) {


    // Compare $UriPattern and $uri
    if (preg_match("~$uriPattern~", $uri)) {

/*        echo '<br>Где ищем(запрос который набрал ползователь):'.$uri;
        echo '<br>Что ищем(Совпадение из правила):'.$uriPattern;
        echo '<br>Где ищем(запрос который набрал ползователь):'.$path."<br>";*/


        // if there some coinsedence  - define controller and action

        $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
       // var_dump($internalRoute);

        $segments = explode('/', $internalRoute);
        $controllerName = ucfirst(array_shift($segments).'Controller');


        $actionName = 'action'.ucfirst(array_shift($segments));

        $parameters = $segments;


        // connect  file which contains controller class

        $controllerFile = ROOT.'/controllers/'.$controllerName.'.class.php';
        //var_dump($controllerFile);
        if (file_exists($controllerFile)){
            include_once ($controllerFile);
        }

        $contrObject = new $controllerName;

        $result = call_user_func_array(array($contrObject,$actionName),$parameters);

            if($result != null){
                break;

            }

        // create object and call method (action)
    }
    }
}

}