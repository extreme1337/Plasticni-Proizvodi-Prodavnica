<?php
    namespace App\Controllers;

    class ApiBookmarkController extends \App\Core\ApiController{
        public function show() {
            $products = $this->getSession()->get('bookmarks', []);

            $productPriceModel = new \App\Models\ProductPriceModel($this->getDatabaseConnection());

            $sum = 0;

            foreach ($products as &$product) {
                $product->price = 0;

                $prices = $productPriceModel->getAllProductPriceByProductId($product->product_id);

                if (count($prices) == 0) {
                    continue;
                }

                $product->price = $prices[count($prices)-1]->amount;

                $sum += $product->price;
            }

            $this->set('bookmarks', $products);
            $this->set('sum', $sum);
        }

        public function getBookmarks(){
            $bookmarks = $this->getSession()->get('bookmarks', []);
            $this->set('bookmarks', $bookmarks);
        }

        public function addBookmark($productId){
            $productModel = new \App\Models\ProductModel($this->getDatabaseConnection());
            $product = $productModel->getById($productId);

            if(!$product){
                $this->set('error',-1);
                return;
            }

            $bookmarks = $this->getSession()->get('bookmarks', []);

            foreach($bookmarks as $bookmark){
                if($bookmark ->product_id == $productId){
                    $this->set('error', -2);
                    return; 
                }
            }

            $bookmarks[] = $product;
            $this->getSession()->put('bookmarks',$bookmarks);

            $this->set('error',0);
            return;
        }

        public function clear(){
            $this->getSession()->put('bookmarks', []);
            $this->set('error',0);
        }

    }