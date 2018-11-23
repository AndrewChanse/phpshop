<?php

class Category 
{
    public static function getCategoryList() {
        $dbPDO = DbConnector::getConnect();
        $result = $dbPDO->query("SELECT * FROM category WHERE status=1 ORDER BY id ASC");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $categoryList = [];
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }
        return $categoryList;
    }
    
    public static function getCategoryListAdmin() {
        $dbPDO = DbConnector::getConnect();
        $result = $dbPDO->query("SELECT * FROM category ORDER BY id ASC");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $categoryList = [];
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $categoryList[$i]['status'] = $row['status'];
            $i++;
        }
        return $categoryList;
    }
    
    public static function getStatusText($status) {
        echo ($status) ? 'Отображается' : 'Скрыта';
    }
    
    public static function getCategoryById($id) {
        $dbPDO = DbConnector::getConnect();
        $sql = 'SELECT * FROM category WHERE id= :id';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();
    }
    
    public static function createCategory($name, $sort_order, $status) {
        $dbPDO = DbConnector::getConnect();
        $sql = 'INSERT INTO category '
                . '(name, sort_order, status) '
                . 'VALUES (:name, :sort_order, :status)';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sort_order, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        $result->execute();
    }
    
    public static function updateCategory($name, $sort_order, $status, $id) {
        $dbPDO = DbConnector::getConnect();
        $sql = 'UPDATE category SET '
                . 'name= :name, '
                . 'sort_order= :sort_order, '
                . 'status= :status '
                . 'WHERE id= :id';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sort_order, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }
    
    public static function deleteCategory($id) {
        $dbPDO = DbConnector::getConnect();
        $sql = 'DELETE FROM category WHERE id= :id';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }
}
