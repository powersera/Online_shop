<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 14.01.2018
 * Time: 10:37
 */



Class News {


   public static function getNewsItemById($id){


       $id = intval($id);
       if ($id){

            $db = Db::getConnection();

           $sql = "Select user_name From guestbook.user Where id = $id ";
           $result =$db->query($sql) ;
           $result->setFetchMode(PDO::FETCH_ASSOC);
           $newsItem = $result->fetch();

           return $newsItem;



       }


        //запрос к БД
    }


    public static function getNewsList(){

        $db = Db::getConnection();

       $newsList = array();

       $result = $db->query('Select title, comment,id 
              from guestbook.post
              Limit 10');
            $i=0;
       while($row = ($result->fetch())){
        $newsList[$i]['title'] = $row['title'];
        $newsList[$i]['comment'] = $row['comment'];
        $newsList[$i]['id'] = $row['id'];
        $i++;
       }
       return $newsList;
       //запрос к БД

    }

}