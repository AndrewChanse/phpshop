<?php

return [
    'product/([0-9]+)' => 'product/view/$1',
    'catalog/page-([0-9]+)' => 'catalog/index/$1',
    'catalog' => 'catalog/index',
    
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2',
    'category/([0-9]+)' => 'catalog/category/$1',
    
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',
        
    
    //'cart/add/([0-9]+)' => 'cart/add/$1',
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1',
    'cart/delete/([0-9]+)' => 'cart/delete/$1',
    'cart/checkout' => 'cart/checkout',
    'cart' => 'cart/index',
    
    'admin/product/create' => 'adminProduct/create',
    'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'admin/product/page-([0-9]+)' => 'adminProduct/index/$1',
    'admin/product' => 'adminProduct/index',
    
    'admin/category' => 'adminCategory/index',
    'admin/order' => 'adminOrder/index',
    'admin' => 'admin/index',
    
    '' => 'site/index'
    
];

