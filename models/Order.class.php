<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 28.01.2018
 * Time: 15:26
 */

class Order
{

    public static function saveOrder($userName, $userPhone,$userComment,$userId,$productsInCart){


        $products = json_encode($productsInCart);
        $db = DB::getConnection();
        $sql = "INSERT INTO mvc_site.product_order (user_name,user_phone,user_comment,userId,products) 
                VALUES (:userName,:userPhone,:usercomment,:userId,:products)";

        $result = $db->prepare($sql);
        $result->bindParam(':user_name',$userame,PDO::PARAM_STR);
        $result->bindParam(':user_phone',$userPhone,PDO::PARAM_INT);
        $result->bindParam(':user_comment',$userComment,PDO::PARAM_STR);
        $result->bindParam(':userId',$userId,PDO::PARAM_INT);
        $result->bindParam(':products',$products,PDO::PARAM_STR);

        return $result->execute();
    }



}