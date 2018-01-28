<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 23.01.2018
 * Time: 9:04
 */

class User
{


    public static function checkName($name){

        if(strlen($name)>= 2){

            return true;
        }
        return false;
    }


    public static function checkPassword($password){

        if(strlen($password) >=6){
            return true;
        }
        return false;
    }
    public static function checkPhone($phone){

        $pattern = "~^\+\d{2}\s\d{3}\s\d{3}\s\d{3}$~";

       if(preg_match($pattern,$phone)){
           return true;
       }
       return false;


    }




    public static function checkEmail($email){

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){

            return true;
        }
        return false;

    }

    /** Checks if email exists
     * @param $email
     * @return bool
     */
    public static function checkEmailExists($email){

        $db = DB::getConnection();

        $sql = "SELECT email FROM mvc_site.user WHERE email = :email";

        $result = $db->prepare($sql);

        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if($result->fetchColumn()){
            return true;
        }
        return false;
    }

    /**
     * registration of new user
     * @param $name
     * @param $email
     * @param $password
     * @return bool
     */
    public static function register($name,$email,$password){

        $db = DB::getConnection();

        $sql = "INSERT INTO mvc_site.user(name,email,password) VALUES(:name, :email, :password)";

        $result = $db->prepare($sql);

        $result->bindParam(':name',$name,PDO::PARAM_STR);
        $result->bindParam(':email',$email,PDO::PARAM_STR);
        $result->bindParam(':password',$password,PDO::PARAM_STR);

        return $result->execute();


    }


    /**
     * Check if user exists with provided email and password
     * @param $email
     * @param $password
     * @return bool
     */
    public static function checkUserData($email,$password){

        $db = DB::getConnection();

        $sql = "SELECT * FROM mvc_site.user WHERE email = :email AND password = :password";

        $result = $db->prepare($sql);
        $result->bindParam('email',$email,PDO::PARAM_STR);
        $result->bindParam('password',$password,PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        if($user){
            return $user['id'];
        }
        return false;



    }

    public static function auth($userId){


        $_SESSION['user'] = $userId;

    }

    public static function checkLogged(){



        // if there is such a session return id user
        if(isset($_SESSION['user'])){
            return $_SESSION['user'];

        }

        header('Location: /user/login');

    }


    public static function isGuest(){

        if(isset($_SESSION['user'])){
            return false;
        }
        return true;
    }

    public static function getUserById($id){

        $db = DB::getConnection();

        $sql = "SELECT *FROM mvc_site.user WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id',$id,PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();

    }

    public static function edit($id,$name,$password){

        $db = DB::getConnection();

        $sql = "UPDATE mvc_site.user SET name = :name, password = :password WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':name',$name,PDO::PARAM_STR);
        $result->bindParam(':password',$password,PDO::PARAM_STR);
        $result->bindParam(':id',$id,PDO::PARAM_INT);

        return $result->execute();


    }












}