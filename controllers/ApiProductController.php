<?php
    namespace App\Controllers;

    class ApiProductController extends \App\Core\ApiController{
        public function show($id){
            $productModel = new \App\Models\ProductModel($this->getDatabaseConnection());
            $product = $productModel->getById($id);
            $this->set('product', $product);
        }
    }