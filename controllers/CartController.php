<?php

class CartController 
{
    public function actionIndex() {
        
        require_once ROOT.'/views/cart/index.php';
        return true;
    }
    
    public function actionAdd($id) {
        Cart::addProduct($id);
        $referer = $_SERVER['HTTP_REFERER'];
        header("Location: $referer");
    }
}
