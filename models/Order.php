<?php

class Order 
{
    public static function saveOrder($userID, $userName, $userPhone, $userComment, $productsInCart) {
        $products = json_encode($productsInCart, true);
        $dbPDO = DbConnector::getConnect();
        $sql = 'INSERT INTO product_order '
                . '(user_id, '
                . 'user_name, '
                . 'user_phone, '
                . 'user_comment, '
                . 'products) '
                . 'VALUES '
                . '(:userID, '
                . ':userName, '
                . ':userPhone, '
                . ':userComment, '
                . ':products)';
        $result = $dbPDO->prepare($sql);
        $result->bindParam(':userID', $userID, PDO::PARAM_INT);
        $result->bindParam(':userName', $userName, PDO::PARAM_STR);
        $result->bindParam(':userPhone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':userComment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':products', $products, PDO::PARAM_STR);
        return $result->execute();
    }
}
