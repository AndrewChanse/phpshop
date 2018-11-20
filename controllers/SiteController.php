<?php
//include ROOT.'/models/category.php';
//include ROOT.'/models/product.php';

class SiteController 
{
    public function actionIndex() {
        $categoryList = Category::getCategoryList();
        $latestProducts = Product::getLatestProducts();
        
        require_once ROOT.'/views/site/index.php';
        return true;
    }
}
