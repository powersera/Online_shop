<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 12.01.2018
 * Time: 17:44
 */

include_once ROOT.'/models/News.php';

class NewsController
{
    public function actionIndex(){

        $NewsList = array();
        $NewsList = News::getNewsList();


        require_once ROOT.'/Views/news/index.php';
        return true;

    }

    public function actionView($id){

        if ($id){
            $newsItem = News::getNewsItemById($id);

            var_dump($newsItem);

        }
        return true;
    }


}