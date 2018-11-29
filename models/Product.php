<?php

class Product 
{
    const SHOW_DEFAULT = 9;
    //const SHOW_CATALOG = 9;


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
    
    public static function getCatalogProducts($page = 1, $limit = self::SHOW_DEFAULT) {
        $page = intval($page);
        $offset = ($page - 1) * $limit;
        $dbPDO = DbConnector::getConnect();
        $result = $dbPDO->query("SELECT * FROM product WHERE status=1 ORDER BY id ASC LIMIT $limit OFFSET $offset");
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
    
    public static function getCategoryProducts($categoryId, $page = 1, $limit = self::SHOW_DEFAULT) {
        $page = intval($page);
        $offset = ($page - 1) * $limit;
        $dbPDO = DbConnector::getConnect();
        $sql = "SELECT * FROM product WHERE status=1 "
                . "AND category_id= :categoryId "
                . "ORDER BY id ASC LIMIT :limit OFFSET :offset";
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->execute();
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
    
    public static function getTotalPages() {
        $dbPDO = DbConnector::getConnect();
        $result = $dbPDO->query('SELECT COUNT(id) AS count FROM product WHERE status=1');
        $row = $result->fetch();
        return $row['count'];
    }
    
    public static function getTotalPagesInCategory($id) {
        $dbPDO = DbConnector::getConnect();
        $sql = 'SELECT COUNT(id) AS count FROM product WHERE status=1 AND category_id= :id';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $row = $result->fetch();
        return $row['count'];
    }
}
