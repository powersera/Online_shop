<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 23.01.2018
 * Time: 8:48
 */

function __autoload($class_name){

# List of all class directories

    $array_path = array(
        '/models/',
        '/components/'

    );

    foreach ($array_path as $path){

        $way = ROOT.$path.$class_name.'.class.php';

        if(is_file($way)){
            include_once ($way);

        }



    }

}