<?php

class Product 
{
    const SHOW_DEFAULT = 9;


    public static function getLatestProducts($limit = self::SHOW_DEFAULT) {
        $dbPDO = DbConnector::getConnect();
        $result = $dbPDO->query("SELECT * FROM product WHERE status=1 ORDER BY id ASC LIMIT $limit");
        $products = [];
        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['is_new'] = $row['is_new'];
            $products[$i]['image'] = $row['image'];
            $i++;
        }
        return $products;
    }
    
    public static function getProductById($id) {
        $id = intval($id);
        if($id) {
        $dbPDO = DbConnector::getConnect();
        $sql = 'SELECT * FROM product WHERE id= :id';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetch();
        }
    }
}
