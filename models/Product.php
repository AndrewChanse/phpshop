<?php

class Product 
{
    const SHOW_BY_DEFAULT_INDEX = 6;
    const SHOW_BY_DEFAULT_CATALOG = 9;
    const SHOW_BY_DEFAULT_CATEGORY = 3;

        public static function getLatestProducts() {
        $limit = self::SHOW_BY_DEFAULT_INDEX;
        $dbPDO = DbConnector::getConnect();
        $result = $dbPDO->query("SELECT * FROM product WHERE status=1 ORDER BY id ASC LIMIT $limit");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $products = [];
        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $products;
    }
    
    public static function getCatalogProducts($page, $limit = self::SHOW_BY_DEFAULT_CATALOG) {
        $page = intval($page);
        $offset = ($page - 1) * $limit;
        $dbPDO = DbConnector::getConnect();
        $sql = "SELECT * FROM product WHERE status=1 ORDER BY id ASC LIMIT $limit OFFSET $offset";
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $products = [];
        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $products;
    }
    
    public static function getTotalProductsOnPage() {
        $dbPDO = DbConnector::getConnect();
        $result = $dbPDO->query("SELECT COUNT(id) as count FROM product WHERE status=1");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchColumn();
    }
    
    public static function getTotalProductsInCategory($categoryID) {
        $dbPDO = DbConnector::getConnect();
        $sql = 'SELECT COUNT(id) as count FROM product WHERE status=1 AND category_id= :categoryID';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':categoryID', $categoryID, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetchColumn();
    }
    
    public static function getCategoryProducts($categoryID, $page, $limit = self::SHOW_BY_DEFAULT_CATEGORY) {
        $categoryID = intval($categoryID);
        //$limit = self::SHOW_BY_DEFAULT_CATEGORY;
        $offset = ($page - 1) * $limit;
        $dbPDO = DbConnector::getConnect();
        $sql = "SELECT * FROM product WHERE status=1 AND category_id= :categoryID ORDER BY id ASC LIMIT :limit OFFSET :offset";
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':categoryID', $categoryID, PDO::PARAM_INT);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $products = [];
        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $products;
    }
    
    public static function getProductById($id) {
        $dbPDO = DbConnector::getConnect();
        $sql = 'SELECT * FROM product WHERE status=1 AND id= :id';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();
    }
    
    public static function getProductsByIds($idsArray) {
        $dbPDO = DbConnector::getConnect();
        $idsString = implode(',', $idsArray);
        $result = $dbPDO->query("SELECT * FROM product WHERE status=1 AND id IN($idsString)");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $products = [];
        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }
        return $products;
    }
    
    public static function getProductsAdmin($page, $limit) {
        $page = intval($page);
        $offset = ($page - 1) * $limit;
        $dbPDO = DbConnector::getConnect();
        $sql = "SELECT * FROM product ORDER BY id ASC LIMIT $limit OFFSET $offset";
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $products = [];
        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }
        return $products;
    }
}
