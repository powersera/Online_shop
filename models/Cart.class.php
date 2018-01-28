<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 27.01.2018
 * Time: 9:40
 */

class Cart
{

    /**
     * @param $id
     * @return int
     */
    public static function addProduct($id){

        // empty array for products in cart
        $productInCart = array();


        // If session got some products, then :

        if(isset($_SESSION['products'])){
            $productInCart = $_SESSION['products'];

        }

        // if product was added before - increase amount
        if(array_key_exists($id,$productInCart)){

            $productInCart[$id]++;
        }else{
            // add new product in cart
            $productInCart[$id] = 1;

        }

        $_SESSION['products'] = $productInCart;


        return self::countItems();




    }

    /**
     * @return int
     */
    public static function countItems(){

        if(isset($_SESSION['products'])){
            $count = 0;

            foreach ($_SESSION['products'] as $id => $quantity){
                $count = $count + $quantity;

            }
            return $count;
        }else{
            return 0;
        }

    }

    /**
     * @return bool if empty and array ['ID' => 'QUANTITY'] if full
     */
    public static function getProducts(){
            if(isset($_SESSION['products'])){
                return $_SESSION['products'];

            }
            return false;


    }

    public static function getProductsByIds($IdsArray){

        $products = array();

        $db = DB::getConnection();
        $stringIds = implode(',',$IdsArray);
        $sql = "SELECT * FROM mvc_site.product WHERE status = 1 AND id IN ($stringIds)";

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        while($row = $result->fetch()){
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }
        return $products;


    }

    public static function getTotalPrice($products){

        $productsInCart = self::getProducts();

        if($productsInCart){
            $totalPrice = 0;
            foreach ($products as $item){
                $totalPrice += $item['price'] * $productsInCart[$item['id']];
        }
        return $totalPrice;


        }





    }

    public static function ClearCart(){

        if(isset($_SESSION['products'])){
            unset($_SESSION['products']);
        }

    }

    public static function deleteProductById($productId){

       unset($_SESSION['products'][$productId]);




    }




}

