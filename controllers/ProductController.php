<?php
//include_once ROOT.'/models/Product.php';
//include_once ROOT.'/models/Category.php';

class ProductController 
{
    public function actionView($id) {
        $categoryList = Category::getCategoryList();
        $product = Product::getProductById($id);
        //echo '<pre>';        print_r($product); die();
        
        require_once ROOT.'/views/product/view.php';
        return true;
    }
}
