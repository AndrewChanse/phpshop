<?php

class AdminProductController extends AdminBase 
{
    public function actionIndex($page=1) {
        $products = Product::getProductsAdmin($page, $limit=13);
        $totalOnPage = Product::getTotalProductsAdmin();
        $limit = Product::SHOW_BY_DEFAULT_ADMIN;
        //echo '<pre>';        print_r($totalOnPage); die();
        
        $pagination = new Pagination($totalOnPage, $page, $limit, 'page-');
        
        require_once ROOT.'/views/admin_product/index.php';
        return true;
    }
    
    public function actionCreate() {
        $categorySelect = Category::getCategoryList();
        $options = [];
        
        if(isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['description'] = $_POST['description'];
            $options['availability'] = $_POST['availability'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];
            $errors = false;
            
            if(!isset($_POST['name']) || empty($_POST['name'])) {
                $errors[] = 'Enter Name!';
            }
            
            if($errors == false) {
                $id = Product::createProduct($options);
                if($id) {
                    if(is_uploaded_file($_FILES['image']['tmp_name'])) {
                        move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/upload/images/products/'.$id.'.jpg');
                    }
                }
            }
            header("Location: /admin/product");
        }
        require_once ROOT.'/views/admin_product/create.php';
        return true;
    }
    
    public function actionUpdate($id) {
        $categorySelect = Category::getCategoryList();
        $product = Product::getProductByIdAdmin($id);
        
        $options = [];
        $options['name'] = $product['name'];
        $options['code'] = $product['code'];
        $options['price'] = $product['price'];
        $options['category_id'] = $product['category_id'];
        $options['brand'] = $product['brand'];
        $options['description'] = $product['description'];
        $options['availability'] = $product['availability'];
        $options['is_new'] = $product['is_new'];
        $options['is_recommended'] = $product['is_recommended'];
        $options['status'] = $product['status'];
        $result = false;
        
        if(isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['description'] = $_POST['description'];
            $options['availability'] = $_POST['availability'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];
            $errors = false;
            
            if(!isset($_POST['name']) || empty($_POST['name'])) {
                $errors[] = 'Enter Name!';
            }
            
            if($errors == false) {
                Product::updateProduct($id, $options);
                if(is_uploaded_file($_FILES['image']['tmp_name'])) {
                    move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/upload/images/products/'.$id.'.jpg');
                }
            }
            header("Location: /admin/product");
        }
        require_once ROOT.'/views/admin_product/update.php';
        return true;
    }
    
    public function actionDelete($id) {
 
        if(isset($_POST['submit'])) {
            Product::deleteProduct($id);
            header("Location: /admin/product");
        }
        require_once ROOT.'/views/admin_product/delete.php';
        return true;
    }
}
