<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 12.01.2018
 * Time: 17:45
 */



class ProductController
{
    public function actionView($id){

    $categories = array();
    $categories = Category::getCategoriesList();

    $product = array();
    $product = Product::getProductById($id);
        require_once ROOT.'/Views/products/View.php';
        return true;

    }



}