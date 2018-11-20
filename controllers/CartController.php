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
        $categoryList = Category::getCategoryList();
        $productsInCart = Cart::getProductsInCart();
        
        if($productsInCart == false) {
            header("Location: /");
        }
        $idsArray = array_keys($productsInCart);
        //echo '<pre>';        print_r($idsArray); die();
        $products = Product::getProductsByIds($idsArray);
        //echo '<pre>';        print_r($products); die();
        $totalPrice = Cart::getTotalPrice($products, $productsInCart);
        $quantity = Cart::countCartItems();
        
        $userName = false;
        $userPhone = false;
        $userComment = false;
        $result = false;
        
        if(!User::isGuest()) {
            $userID = User::checkLogged();
            $user = User::getUserById($userID);
            $userName = $user['name'];
        } else {
            $userID = false;
        }
        
        if(isset($_POST['submit'])) {
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            $errors = false;
            
            if(empty($_POST['userName']) || !isset($_POST['userName'])) {
                $errors[] = 'Enter User Name';
            }
            
            if($errors == false) {
                $result = Order::saveOrder($userName, $userPhone, $userComment, $userID, $productsInCart);
                
                if($result) {
                    $adminEmail = 'andyua@inbox.ru';
                    $subject = 'Subject';
                    $message = 'Smessage';
                    mail($message, $subject, $adminEmail);
                    
                    Cart::clear();
                }
            }
        }
                
        require_once ROOT.'/views/cart/checkout.php';
        return true;
    }
}
