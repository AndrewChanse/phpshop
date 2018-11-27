<?php

include_once ROOT.'/models/Product.php';
include_once ROOT.'/models/Category.php';

class SiteController 
{
    public function actionIndex() {
        $categoryList = Category::getCategoryList();
        $products = Product::getLatestProducts(6);
        //echo '<pre>';        print_r($products); die();
        
        require_once ROOT.'/views/site/index.php';
        return true;
    }
}
