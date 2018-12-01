<?php

class CartController 
{
    public function actionIndex() {
        $categoryList = Category::getCategoryList();
        $productsInCart = Cart::getProductsInCart();
        if($productsInCart) {
            //echo '<pre>'; print_r($productsInCart);die();
            $productsIds = array_keys($productsInCart);
            //echo '<pre>';        print_r($productsIds);die();
            $products = Product::getProductsByIds($productsIds);
            //echo '<pre>';        print_r($products);die();
            $totalPrice = Cart::getTotalPrice($products);
        }
       
        require_once ROOT.'/views/cart/index.php';
        return true;
    }
    
//    public function actionAdd($id) {
//        Cart::addProduct($id);
//        $referer = $_SERVER['HTTP_REFERER'];
//        header("Location: $referer");
//    }
    
    public function actionAddAjax($id) {
        echo Cart::addProduct($id);
        return true;
    }
    
    public function actionDelete($id) {
        Cart::deleteProduct($id);
        header("Location: /cart");
    }
    
    public function actionCheckout() {
        
        $productsInCart = Cart::getProductsInCart();
        if($productsInCart == false) {
            header("Location: /");
        }
            $categoryList = Category::getCategoryList();
            //echo '<pre>'; print_r($productsInCart);die();
            $productsIds = array_keys($productsInCart);
            //echo '<pre>';        print_r($productsIds);die();
            $products = Product::getProductsByIds($productsIds);
            //echo '<pre>';        print_r($products);die();
            $totalQuantity = Cart::CartCount();
            $totalPrice = Cart::getTotalPrice($products);
            
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
                
                if(!isset($_POST['userName']) || (empty($_POST['userName']))) {
                    $errors[] = 'Заполните поле "Имя"';
                }
                if(!isset($_POST['userPhone']) || (empty($_POST['userPhone']))) {
                    $errors[] = 'Введите номер телефона';
                }
                if($errors == false) {
                    $result = Order::saveOrder($userID, $userName, $userPhone, $userComment, $productsInCart);
                    if($result) {
                        $adminEmail = 'andyua@inbox.ru';
                        $subject = 'New Order';
                        $message = $message = '<a href="http://digital-mafia.net/admin/orders">Список заказов</a>';
                        mail($message, $subject, $adminEmail);
                        
                        Cart::clear();
                    }
                }
            }
        require_once ROOT.'/views/cart/checkout.php';
        return true;
    }
}
