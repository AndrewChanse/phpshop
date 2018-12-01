<?php

class Cart 
{
    public static function addProduct($id) {
        $id = intval($id);
        $productsInCart = [];
        if(isset($_SESSION['products'])) {
            $productsInCart = $_SESSION['products'];
        }
        if(array_key_exists($id, $productsInCart)) {
            $productsInCart[$id]++;
        } else {
            $productsInCart[$id] = 1;
        }
        $_SESSION['products'] = $productsInCart;
        return self::CartCount();
        //echo '<pre>';        print_r($_SESSION['products']); die();
    }
    
    public static function CartCount() {
        if(isset($_SESSION['products'])) {
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count += $quantity;
            }
            return $count;
        }
        return 0;
    }
    
    public static function getProductsInCart() {
        if(isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }
    
    public static function getTotalPrice($products) {
        if(isset($_SESSION['products'])) {
            $productsInCart = self::getProductsInCart();
            $total = 0;
            foreach ($products as $product) {
                $total += $product['price'] * $productsInCart[$product['id']];
            }
            return $total;
        }
        return 0;
    }
    
    public static function deleteProduct($id) {
        $productsInCart = self::getProductsInCart();
        if($productsInCart[$id] >= 2) {
            $productsInCart[$id]--;
        } else {
            unset($productsInCart[$id]);
        }
        $_SESSION['products'] = $productsInCart;
    }
    
    public static function clear() {
        unset($_SESSION['products']);
    }
}
