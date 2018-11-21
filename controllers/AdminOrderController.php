<?php

class AdminOrderController extends AdminBase 
{
    public static function actionIndex() {
        
        
        require_once ROOT.'/views/admin_order/index.php';
        return true;
    }
}
