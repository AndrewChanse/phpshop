<?php

class AdminCategoryController extends AdminBase 
{
    public static function actionIndex() {
        
        
        require_once ROOT.'/views/admin_category/index.php';
        return true;
    }
}
