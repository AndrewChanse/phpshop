<?php

class Product 
{
    const SHOW_BY_DEFAULT_INDEX = 6;
    const SHOW_BY_DEFAULT_CATALOG = 9;
    const SHOW_BY_DEFAULT_CATEGORY = 3;
    const SHOW_BY_DEFAULT_ADMIN = 12;

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
    
    public static function getTotalProductsAdmin() {
        $dbPDO = DbConnector::getConnect();
        $result = $dbPDO->query("SELECT COUNT(id) as count FROM product");
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
    
    public static function getProductsAdmin($page, $limit=self::SHOW_BY_DEFAULT_ADMIN) {
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
    
    public static function getProductByIdAdmin($id) {
        $dbPDO = DbConnector::getConnect();
        $sql = 'SELECT * FROM product WHERE id= :id';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();
    }
    
    public static function createProduct($options) {
        $dbPDO = DbConnector::getConnect();
        $sql = 'INSERT INTO product '
                . '(name, code, price, category_id, brand, description, '
                . 'availability, is_new, is_recommended, status) '
                . 'VALUES (:name, :code, :price, :category_id, :brand, '
                . ':description, :availability, :is_new, :is_recommended, :status)';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_INT);
        $result->bindParam(':price', $options['price'], PDO::PARAM_INT);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->execute();
        return $dbPDO->lastInsertId();
    }
    
    public static function updateProduct($id, $options) {
        $dbPDO = DbConnector::getConnect();
        $sql = 'UPDATE product '
                . 'SET '
                . 'name= :name, '
                . 'code= :code, '
                . 'price= :price, '
                . 'category_id= :category_id, '
                . 'brand= :brand, '
                . 'description= :description, '
                . 'availability= :availability, '
                . 'is_new= :is_new, '
                . 'is_recommended= :is_recommended, '
                . 'status= :status '
                . 'WHERE id= :id';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_INT);
        $result->bindParam(':price', $options['price'], PDO::PARAM_INT);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }
    
    public static function deleteProduct($id) {
        $dbPDO = DbConnector::getConnect();
        $sql = 'DELETE FROM product WHERE id= :id';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }

    public static function getImage($id) {
        $noImage = 'no-image.jpg';
        $path = '/upload/images/products/';
        $pathToImage = $path.$id.'.jpg';
        if(file_exists(ROOT.$pathToImage)) {
            return $pathToImage;
        }
        return $path.$noImage;
    }
}
