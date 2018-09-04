<?php
    namespace App\Controllers;

    class ProductController extends \App\Core\Controller{
        public function __pre(){
            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $categories = $categoryModel->getAll();
            $this->set('categories', $categories);
        }
        
        public function show($id){
            $productModel = new \App\Models\ProductModel($this->getDatabaseConnection());
            $product = $productModel->getById($id);
            
            if (!$product){
                header ('Location: /PlasticniProizvodi');
                exit;
            }
            if ($product->is_active != 1) {
                header ('Location: /PlasticniProizvodi');
                exit;
            }
            $this->set('product', $product);
            
            $productPriceModel = new \App\Models\ProductPriceModel($this->getDatabaseConnection());
            $productPrices = $productPriceModel->getAllProductPriceByProductId($id);
            $productPrice = $productPrices[count($productPrices)-1];
            $this->set('productPrice', $productPrice);
            
            $characteristicModel = new \App\Models\CharacteristicModel($this->getDatabaseConnection());
            $characteristicsInProduct = $characteristicModel->getById($id);
            $this->set('$characteristicsInProduct', $characteristicsInProduct);
            
            $productCharacteristicModel = new \App\Models\ProductCharacteristicModel($this->getDatabaseConnection());
            $productCharacteristicsInProduct = $productCharacteristicModel->getProductCharacteristicsFromProductId($id);
            $this->set('$productCharacteristicsInProduct', $productCharacteristicsInProduct);
            
            
        }

        private function normaliseKeywords(string $keywords): string {
            $keywords = trim($keywords);
            $keywords = preg_replace('/ +/', ' ', $keywords);
            return $keywords;
        }

        public function postSearch() {
            $productModel = new \App\Models\ProductModel($this->getDatabaseConnection());

            $q = filter_input(INPUT_POST, 'q', FILTER_SANITIZE_STRING);

            $keywords = $this->normaliseKeywords($q);

            $product = $productModel->getAllBySearch($q); 


            $this->set('product', $product);
        }
       /*
        private function getLastPrice($productId){
            $productPriceModel = new \App\Models\ProductPriceModel($this->getDatabaseConnection());
            $productPrices = $productPriceModel->getById($id);
            $lastPrice = 0;

            foreach($productPrices as $product_price){
                if ($lastPrice < $product_price->amount){
                    $lastPrice = $product_price->amount;
                }
            }
        }
        */
    }