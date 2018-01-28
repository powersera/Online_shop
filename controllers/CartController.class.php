<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 27.01.2018
 * Time: 9:32
 */

class CartController
{

    public function actionAdd($id){

        // add product to the cart

        Cart::addProduct($id);

        // return user to homepage

        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");

    }

    public function actionAddAjax($id){

        // add products into cart
        echo Cart::addProduct($id);

        return true;


    }

    public function actionDelete($productId){

       $delete = Cart::deleteProductById($productId);
       header("Location: /cart/");

       return true;

    }

    public function actionIndex(){

        $categories = array();
        $categories = Category::getCategoriesList();

        $productsInCart = false;

        //receiving data from cart
        $productsInCart = Cart::getProducts();

        if($productsInCart){
            $productsIds = array_keys($productsInCart);
            $products = Cart::getProductsByIds($productsIds);

            $totalPrice = Cart::getTotalPrice($products);
        }

        require_once ROOT.'/Views/cart/index.php';
        return true;
    }

    public function actionCheckOut(){

        $categories = array();
        $categories = Category::getCategoriesList();
        $productsInCart = Cart::getProducts();

        // check if form was sent
        if(isset($_POST['submit'])){
            // YES - form was sent
            $userName = trim(htmlspecialchars($_POST['name']));
            $userPhone = trim(htmlspecialchars($_POST['phone']));
            $userComment = trim(htmlspecialchars($_POST['comment']));

            // Validation
            $errors = false;
            if(!USER::checkName($userName)){
                $errors[] = 'Wrong Name';
            }
            if(!USER::checkPhone($userPhone)){
                $errors[] = 'Wrong Number';

            }

            // if form filled correctly
            if($errors == false){
                // YES! Form filled correctly
                // get order data

                $productsInCart = Cart::getProducts();
                if(USER::isGuest()){
                    $userId = false;
                }else{
                    $userId = User::checkLogged();
                }

                // Save order in DB table 'order'
                $result = Order::saveOrder($userName,$userPhone,$userComment,$userId,$productsInCart);

                if($result){
                    Cart::ClearCart();

                }
            } else{
                // FORM got some errors
                $productsInCart = Cart::getProducts();
                $products = Cart::getProductsByIds($productsInCart);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();


            }



        }else{

            // Form was sent? - NO

            // Check if cart is empty
            $productsInCart = Cart::getProducts();
            if($productsInCart == false){
                // Cart is empty - send to main page
                header("location: / ");
            }

            // cart isnt empty -  show products

            $productsIds =array_keys($productsInCart);
            $products = Cart::getProductsByIds($productsIds);
            $totalPrice = Cart::getTotalPrice($products);
            $totalQuantity = Cart::countItems();

            if(USER::isGuest()){
                // NO! User wasnt authorized
                // Fields are empty

            }else{
                // YES! User is authorized
                // get data from BD

                $userId = USER::checkLogged();
                $user = USER::getUserById($userId);

                // fill the form
                $username = $user['name'];


            }



        }



        return true;

    }

}