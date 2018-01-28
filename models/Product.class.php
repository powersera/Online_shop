<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 17.01.2018
 * Time: 2:50
 */
include_once ROOT.'/components/Db.class.php';

/**
 * Class Product returns array products
 */

class Product{
    const SHOW_BY_DEFAULT = 6;

    /**
     * @param int $count
     * @return array of latest products
     */

    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT){

        $count = intval($count);

        $db = DB::getConnection();

        $productList = array();
        $sql = "Select id,name,price,image,is_new From mvc_site.product 
                Where status = 1
                ORDER BY id DESC
                LIMIT ".$count;
        $result = $db->query($sql);

        $i=0;
        while ($row = $result->fetch()){
            $productList[$i]['id'] = $row['id'];
            $productList[$i]['name'] = $row['name'];
            $productList[$i]['price'] = $row['price'];
            $productList[$i]['image'] = $row['image'];
            $productList[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $productList;
    }

    /**
     * @param bool $categoryId
     * @return array
     */
    public static function getProductsListByCategory($categoryId = false,$page = 1){

        if ($categoryId){

            $page = intval($page);
            $offset = ($page - 1)* self::SHOW_BY_DEFAULT;

            $db = DB::getConnection();
            $products = array();
            $sql = "Select id,name,price,image,is_new From mvc_site.product
                    Where status = 1 AND category_id = $categoryId"
                . " ORDER BY id DESC
                LIMIT ".self::SHOW_BY_DEFAULT
                ." OFFSET $offset";
               
            $result = $db->query($sql);
            $i = 0;
            while($row = $result->fetch()){
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['image'] = $row['image'];
                $products[$i]['is_new'] = $row['is_new'];
                $i++;
            }
        return $products;

        }

    }


    /**
     *
     * @param $ProductId
     * @return array of 1 Product
     */
    public static function getProductById($ProductId){

    intval($ProductId);

    if ($ProductId){

        $db = DB::getConnection();

        $sql = "SELECT * FROM mvc_site.product WHERE id = $ProductId";

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        return $result->fetch();

    }


    }


    public static function getTotalProductsInCategory($id){

        $id = intval($id);

        $db = DB::getConnection();

        $result = array();
        $sql = "SELECT count(id) as count FROM mvc_site.product WHERE category_id = $id and status = 1";

        $result = $db->query($sql);

        $result->setFetchMode(PDO::FETCH_ASSOC);

        $row = $result->fetch();


        return $row['count'];





    }





}