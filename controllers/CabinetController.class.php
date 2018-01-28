<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 24.01.2018
 * Time: 9:46
 */

class CabinetController
{

    public function actionIndex(){

        // receiving id of user from session
        $userId = USER::checkLogged();

        // receiving user data from DB
        $user = USER::getUserById($userId);


        require_once ROOT.'/Views/cabinet/index.php';
        return true;

    }

    public static function actionEdit(){
        // receiving id of user from session
        $userId = USER::checkLogged();

        // receiving user data from DB
        $user = USER::getUserById($userId);

        $name = $user['name'];

        $password = $user['password'];

        $result = false;

        if(isset($_POST['submit'])){
            $name = trim(htmlspecialchars($_POST['name']));
            $password = trim(htmlspecialchars($_POST['password']));

            $errors = false;


            if(!USER::checkName($name)){
                $errors[] = "Wrong name. Must be  at least 2 char";
            }
            if(!USER::checkPassword($password)){
                $errors[] = "Wrong password. Must be  at least6 char";


            }
            if($errors == false){
                $result = USER::edit($userId,$name,$password);

            }


        }



        require_once ROOT.'/Views/cabinet/edit.php';

        return true;
    }

}