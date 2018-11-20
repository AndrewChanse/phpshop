<?php

class CatalogController 
{
    public function actionIndex($page = 1) {
        $categoryList = Category::getCategoryList();
        $catalogProducts = Product::getCatalogProducts($page, $limit = 6);
        $totalOnPage = Product::getTotalProductsOnPage();
        //echo '<pre>';        print_r($totalOnPage); die();
        
        $pagination = new Pagination($totalOnPage, $page, $limit, 'page-');
        
        require_once ROOT.'/views/catalog/index.php';
        return true;
    }
    
    public function actionCategory($categoryID, $page = 1) {
        $categoryList = Category::getCategoryList();
        $categoryProducts = Product::getCategoryProducts($categoryID, $page, $limit = 6);
        //print_r($categoryProducts); die();
        $totalInCategory = Product::getTotalProductsInCategory($categoryID);
        //echo '<pre>'; print_r($totalinCategory); die();
        //echo '<pre>';        print_r($totalOnPage); die();
        
        $pagination = new Pagination($totalInCategory, $page, $limit, 'page-');
        
        require_once ROOT.'/views/catalog/category.php';
        return true;
    }
}
