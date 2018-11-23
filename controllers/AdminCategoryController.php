<?php

class AdminCategoryController extends AdminBase 
{
    public static function actionIndex() {
        $categoryList = Category::getCategoryListAdmin();
        
        require_once ROOT.'/views/admin_category/index.php';
        return true;
    }
    
    public function actionCreate() {
         
        if(isset($_POST['submit'])) {
            $name = $_POST['name'];
            $sort_order = $_POST['sort_order'];
            $status = $_POST['status'];
            $errors = false;
            
            if(!isset($_POST['name']) || empty($_POST['name'])) {
                $errors[] = 'Enter Name!';
            }
            
            if($errors == false) {
                Category::createCategory($name, $sort_order, $status);
            }
            header("Location: /admin/category");
        }
        require_once ROOT.'/views/admin_category/create.php';
        return true;
    }
    
    public function actionUpdate($id) {
        $category = Category::getCategoryById($id);
        $name = $category['name'];
        $sort_order = $category['sort_order'];
        $status = $category['status'];
         
        if(isset($_POST['submit'])) {
            $name = $_POST['name'];
            $sort_order = $_POST['sort_order'];
            $status = $_POST['status'];
            $errors = false;
            
            if(!isset($_POST['name']) || empty($_POST['name'])) {
                $errors[] = 'Enter Name!';
            }
            
            if($errors == false) {
                Category::updateCategory($name, $sort_order, $status, $id);
            }
            header("Location: /admin/category");
        }
        require_once ROOT.'/views/admin_category/update.php';
        return true;
    }
    
    public function actionDelete($id) {
        $category = Category::getCategoryById($id);
        
        if(isset($_POST['submit'])) {
            Category::deleteCategory($id);
            header("Location: /admin/category");
        }
        require_once ROOT.'/views/admin_category/delete.php';
        return true;
    }
}
