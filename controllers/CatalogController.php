<?php
//include_once ROOT.'/models/Product.php';
//include_once ROOT.'/models/Category.php';
//include_once ROOT.'/components/Pagination.php';

class CatalogController 
{
    public function actionIndex($page = 1) {
        $categoryList = Category::getCategoryList();
        $catalogProducts = Product::getCatalogProducts($page, $limit = 12);
        $total = Product::getTotalPages();
        //print_r($total); die();
        
        $pagination = new Pagination($total, $page, $limit, 'page-');
        
        require_once ROOT.'/views/catalog/index.php';
        return true;
    }
    
    public function actionCategory($categoryId, $page = 1) {
        $categoryList = Category::getCategoryList();
        $categoryProducts = Product::getCategoryProducts($categoryId, $page, $limit = 3);
        $total = Product::getTotalPagesInCategory($categoryId);
        //print_r($total); die();
        
        $pagination = new Pagination($total, $page, $limit, 'page-');
        
        require_once ROOT.'/views/catalog/category.php';
        return true;
    }
}
