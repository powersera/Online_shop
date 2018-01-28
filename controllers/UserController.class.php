<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 23.01.2018
 * Time: 9:05
 */

class userController
{

    public function actionRegister(){

        $name = '';
        $email = '';
        $password = '';
        $result = false;

        if(isset($_POST['submit'])){
            $name = trim(htmlspecialchars($_POST['name']));
            $email = trim(htmlspecialchars($_POST['email']));
            $password = trim(htmlspecialchars($_POST['password']));

        }

        $errors = false;

        if(!User::checkName($name)){
            $errors[] = "Name should not be less then 2 characters";
        }
        if(!User::checkEmail($email)){
            $errors[] = "Wrong Email";
        }
        if (!User::checkPassword($password)) {
            $errors[] = "password should be more then 6 characters";

        }

        if(USER::checkEmailExists($email)){
            $errors[] = "Email you have provided is already taken";
        }


        if($errors == false){
            $result = USER::register($name,$email,$password);


        }



        require_once ROOT.'/Views/user/register.php';
        return true;

}
    public function actionLogin(){

        $email = '';
        $password = '';
        $result = false;

        if(isset($_POST['submit'])){
            $email = trim(htmlspecialchars($_POST['email']));
            $password = trim(htmlspecialchars($_POST['password']));

        }

        $errors = false;

        if(!User::checkEmail($email)){
            $errors[] = "Wrong Email";
        }
        if (!User::checkPassword($password)) {
            $errors[] = "password should be more then 6 characters";

        }


        // Check if user exists

        $userId = USER::checkUserData($email,$password);

        if(!$userId){
            // id provided data wrong - add message to error
            $errors[] = 'There is not such a user';

        }else{
            // if data ok - remember user
            User::auth($userId);

            // head user to cabinet
            header('Location: /cabinet/');


        }





        require_once ROOT.'/Views/user/login.php';
        return true;
    }

    public static function actionLogout(){


        unset($_SESSION['user']);

        header("Location: /");


    }



}