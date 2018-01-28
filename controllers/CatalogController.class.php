<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 18.01.2018
 * Time: 13:23
 */



class CatalogController {


    public function actionIndex(){

    $categories = array();

    $categories = Category::getCategoriesList();

    $latestProduct = array();

    $latestProduct = Product::getLatestProducts(6);
    include_once ROOT.'/Views/catalog/index.php';
    return true;

    }

    public function actionCategory($categoryId,$page = 1){

        $categories = array();
        $categories = Category::getCategoriesList();

        $categoryProducts = array();

        $categoryProducts = Product::getProductsListByCategory($categoryId,$page);

        $total = Product::getTotalProductsInCategory($categoryId);

        $pagination = new Pagination($total, $page,Product::SHOW_BY_DEFAULT,'page-');


        include_once ROOT.'/Views/catalog/category.php';
        return true;

    }
}