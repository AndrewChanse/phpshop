<?php

return [
    
    'product/([0-9]+)' => 'product/view/$1',
    
    'catalog/page-([0-9]+)' => 'catalog/index/$1',
    'catalog' => 'catalog/index',
    
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2',
    'category/([0-9]+)' => 'catalog/category/$1',
    
    'cart/add/([0-9]+)' => 'cart/add/$1',
    'cart' => 'cart/index',
    
    '' => 'site/index'
];

