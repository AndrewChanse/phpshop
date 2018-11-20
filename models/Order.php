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
}
