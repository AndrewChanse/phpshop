<?php

class AdminOrderController extends AdminBase 
{
    public static function actionIndex() {
        $orderList = Order::getOrderList();
        
        require_once ROOT.'/views/admin_order/index.php';
        return true;
    }
    
    public static function actionView($id) {
        $order = Order::getOrderById($id);
        $jsonProducts = Order::getOrderProducts($id);
        //echo '<pre>'; print_r($orderProducts); die();
        $productsArray = json_decode($jsonProducts, true);
        //echo '<pre>'; print_r($productsArray); die();
        $productsIds = array_keys($productsArray);
        $products = Product::getProductsByIds($productsIds);
        $totalPrice = Order::getTotalPrice($products, $productsArray);
        
        require_once ROOT.'/views/admin_order/view.php';
        return true;
    }
    
    public function actionUpdate($id) {
        $order = Order::getOrderById($id);
        
        $userName = $order['user_name'];
        $userPhone = $order['user_phone'];
        $userComment = $order['user_comment'];
        $date = $order['date'];
        $status = $order['status'];
        $result = false;
        
        if(isset($_POST['submit'])) {
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            $date = $_POST['date'];
            $status = $_POST['status'];
            $errors = false;
            
            if(!isset($_POST['userName']) || empty($_POST['userName'])) {
                $errors[] = 'Enter Name!';
            }
            
            if($errors == false) {
                Order::updateOrder($id, $userName, $userPhone, $userComment, $date, $status);
            }
            header("Location: /admin/order");
        }
        require_once ROOT.'/views/admin_order/update.php';
        return true;
    }
    
    public function actionDelete($id) {
        if(isset($_POST['submit'])) {
            Order::deleteOrder($id);
            header("Location: /admin/order");
        }
        require_once ROOT.'/views/admin_order/delete.php';
        return true;
    }
}
