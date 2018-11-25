<?php

class Order 
{
    public static function saveOrder($userName, $userPhone, $userComment, $userID, $products) {
        $dbPDO = DbConnector::getConnect();
        $products = json_encode($products);
        $sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products) '
                . 'VALUES (:userName, :userPhone, :userComment, :userID, :products)';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':userName', $userName, PDO::PARAM_STR);
        $result->bindParam(':userPhone', $userPhone, PDO::PARAM_INT);
        $result->bindParam(':userComment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':userID', $userID, PDO::PARAM_INT);
        $result->bindParam(':products', $products, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->execute();
    }
    
    public static function getOrderList() {
        $dbPDO = DbConnector::getConnect();
        $result = $dbPDO->query("SELECT * FROM product_order ORDER BY date DESC");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $orderList = [];
        $i = 0;
        while ($row = $result->fetch()) {
            $orderList[$i]['id'] = $row['id'];
            $orderList[$i]['user_name'] = $row['user_name'];
            $orderList[$i]['user_phone'] = $row['user_phone'];
            $orderList[$i]['date'] = $row['date'];
            $orderList[$i]['status'] = $row['status'];
            $i++;
        }
        return $orderList;
    }
    
    public static function getOrderById($id) {
        $dbPDO = DbConnector::getConnect();
        $sql = 'SELECT * FROM product_order WHERE id= :id';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();
    }
    
    public static function getOrderProducts($id) {
        $dbPDO = DbConnector::getConnect();
        $sql = 'SELECT * FROM product_order WHERE id= :id';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $row = $result->fetch();
        return $row['products'];
    }
    
    public static function updateOrder($id, $userName, $userPhone, $userComment, $date, $status) {
        $dbPDO = DbConnector::getConnect();
        $sql = 'UPDATE product_order '
                . 'SET '
                . 'user_name= :userName, '
                . 'user_phone= :userPhone, '
                . 'user_comment= :userComment, '
                . 'date= :date, '
                . 'status= :status '
                . 'WHERE id= :id';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':userName', $userName, PDO::PARAM_STR);
        $result->bindParam(':userPhone', $userPhone, PDO::PARAM_INT);
        $result->bindParam(':userComment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':date', $date, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }
    
    public static function deleteOrder($id) {
        $id = intval($id);
        $dbPDO = DbConnector::getConnect();
        $sql = 'DELETE FROM product_order WHERE id= :id';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }

    public static function getTotalPrice($products, $productsArray) {
        $total = 0;
        foreach ($products as $product) {
            $total += $product['price'] * $productsArray[$product['id']];
        }
        return $total;
    }

    public static function getStatusText($status) {
        switch ($status) {
            case 1: echo 'Новый заказ';
                break;
            case 2: echo 'В обработке';
                break;
            case 3: echo 'Доставляется';
                break;
            case 4: echo 'Закрыт';
                break;
            default: 'Отменён';
                break;
        }
    }
}
