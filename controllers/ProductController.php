<?php

class ProductController 
{
    public function actionView($id) {
        $categoryList = Category::getCategoryList();
        $product = Product::getProductById($id);
        
        require_once ROOT.'/views/product/view.php';
        return true;
    }
}
