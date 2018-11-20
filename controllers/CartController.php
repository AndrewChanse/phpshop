<?php

class CartController 
{
//    public function actionAdd($id) {
//        Cart::addProduct($id);
//        $referer = $_SERVER['HTTP_REFERER'];
//        header("Location: $referer");
//    }
    
    public function actionAddAjax($id) {
        echo Cart::addProduct($id);
        return true;
    }
    
    public function actionIndex() {
        $categoryList = Category::getCategoryList();
        $productsInCart = false;
        $productsInCart = Cart::getProductsInCart();
        if($productsInCart) {
       //echo '<pre>';        print_r($productsInCart); die();
            $idsArray = array_keys($productsInCart);
            //echo '<pre>';        print_r($idsArray); die();
            $products = Product::getProductsByIds($idsArray);
            //echo '<pre>';        print_r($products); die();
            $totalPrice = Cart::getTotalPrice($products, $productsInCart);
        }
                
        require_once ROOT.'/views/cart/index.php';
        return true;
    }
    
    public function actionDelete($id) {
        Cart::deleteItem($id);
        header("Location: /cart");
    }
    
    public function actionCheckout() {
        
        
        require_once ROOT.'/views/cart/checkout.php';
        return true;
    }
}
