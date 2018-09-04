<?php
    namespace App\Controllers;

    class CategoryController extends \App\Core\Controller{
        public function __pre(){
            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $categories = $categoryModel->getAll();
            $this->set('categories', $categories);
        }
        
        public function show($id){
            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $category = $categoryModel->getById($id);
            $this->set('category', $category);
            
            $productModel = new \App\Models\ProductModel($this->getDatabaseConnection());
            $productsInCategory = $productModel->getAllFromDifferentTable($id);
            $productsInCategory = array_filter($productsInCategory, function($product) {
                return $product->is_active == 1;
            });
            $this->set('productsInCategory', $productsInCategory);
             
        }
        
        
    }