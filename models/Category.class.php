<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 17.01.2018
 * Time: 1:08
 */
include_once ROOT.'/components/Db.class.php';

/**
 * Class Category returns array of Categories
 */
class Category{



    public static function getCategoriesList(){

        $db = DB::getConnection();

        $categoryList = array();

        $sql = "Select id,name From MVC_site.category ORDER BY sort_order ASC";
        $result = $db->query($sql);

        $i = 0;

        while ($res = $result->fetch()){
            $categoryList[$i]['id'] = $res['id'];
            $categoryList[$i]['name'] = $res['name'];
            $i++;
        }
        return $categoryList;
    }


}