<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 16.01.2018
 * Time: 15:28
 */


class SiteController
{


    public static function actionIndex(){


        $categories = array();
        $categories = Category::getCategoriesList();

        $latestProduct = array();

        $latestProduct = Product::getLatestProducts(6);
        require_once ROOT.'/Views/Site/Site.php';
        return true;
    }



}