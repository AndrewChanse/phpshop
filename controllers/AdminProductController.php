<?php

class AdminProductController extends AdminBase 
{
    public function actionIndex($page=1) {
        $products = Product::getProductsAdmin($page, $limit=15);
        
        require_once ROOT.'/views/admin_product/index.php';
        return true;
    }
}
