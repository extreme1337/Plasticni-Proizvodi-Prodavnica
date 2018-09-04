<?php
    namespace App\Controllers;

    class UserProductPriceManagementController extends \App\Core\Role\UserRoleController{
        public function prices(){
                $productPriceModel = new \App\Models\ProductPriceModel($this->getDatabaseConnection());
                $productPrices = $productPriceModel->getAll();
                $this->set('productPrices', $productPrices);
            }

        public function getEdit($productPriceId){
            $productPriceModel = new \App\Models\ProductPriceModel($this->getDatabaseConnection());
            $price = $productPriceModel->getById($productPriceId);

            $productModel = new \App\Models\ProductModel($this->getDatabaseConnection());
            $product = $productModel->getById($productPriceId);
            $this->set('product',$product);

            $productModel = new \App\models\ProductModel($this->getDatabaseCOnnection());
            $products = $productModel->getAll();
            $this->set('products',$products);

            if(!$price){
                $this->redirect(\Configuration::BASE . 'user/prices');
            }

            $this->set('price', $price);

            return $productPriceModel;
        }
        
        public function postEdit($productPriceId){
            $productPriceModel = $this->getEdit($productPriceId);

            $amount = sprintf("%.2f",\filter_input(INPUT_POST,'amount', FILTER_SANITIZE_STRING));

            $productPriceModel->editById($productPriceId, [
                'amount' => $amount
            ]);

            $this->redirect(\Configuration::BASE . 'user/prices');
        }

        public function getAdd(){
            $productModel = new \App\Models\ProductModel($this->getDatabaseConnection());
            $products = $productModel->getAll();
            $this->set('products',$products);
        }

        public function postAdd(){
            $amount = sprintf("%.2f",\filter_input(INPUT_POST,'amount',FILTER_SANITIZE_STRING));
            $productId = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT);
            
            $productPriceModel = new \App\Models\ProductPriceModel($this->getDatabaseConnection());

            $productPriceId = $productPriceModel->add([
                'product_id' => $productId,
                'amount' => $amount
            ]);

            if($productPriceId){
                $this->redirect(\Configuration::BASE . 'user/prices');
            }

            $this->set('message', 'Doslo je do greske: Nije moguce dodati ovu cenu proizvoda!');
        }
    }