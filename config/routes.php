<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 12.01.2018
 * Time: 14:52
 */

return [
    'product/([0-9]+)' => 'product/view/$1',
    'catalog' => 'catalog/index', //actionIndex in CatalogController
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2',  //actionCategory in CatalogController
    'category/([0-9]+)' => 'catalog/category/$1', // actionCategory in CatalogController
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1',
    'cart/add/([0-9]+)' => 'cart/add/$1',
    'cart/checkout' => 'cart/checkout',
    'cart/delete' =>'cart/delete',
    'cart' => 'cart/index',
    'user/register' => 'user/register',  // actionRegister in UserController
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'contacts' => 'contacts/index',

    '' => 'site/index'
/*   'news/([0-9]+)' => 'news/view/$1',
   'news' => 'news/index' */// actionIndex in NewsController

    /*'products' => 'product/list' // actionList in ProductsController*/
];