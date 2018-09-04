<?php
    namespace App\Controllers;

    class UserProductCategoryManagementController extends \App\Core\Role\UserRoleController{
        public function producategories(){
                $productCategoryModel = new \App\Models\ProductCategoryModel($this->getDatabaseConnection());
                $producategories = $productCategoryModel->getAll();
                $this->set('producategories', $producategories);
            }

        public function getEdit($producategoriesId){
            $productCategoryModel = new \App\Models\ProductCategoryModel($this->getDatabaseConnection());
            $producategory = $productCategoryModel->getById($producategoriesId);

            $productModel = new \App\Models\ProductModel($this->getDatabaseConnection());
            $product = $productModel->getById($producategoriesId);
            $this->set('product',$product);

            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $categories = $categoryModel->getAll();
            $this->set('categories', $categories);

            if(!$producategory){
                $this->redirect(\Configuration::BASE . 'user/producategories');
            }

            $this->set('producategory', $producategory);

            return $productCategoryModel;
        }
        
        public function postEdit($producategoriesId){
            $productCategoryModel = $this->getEdit($producategoriesId);

            $categoryId = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT);
            
            $productCategoryModel->editById($producategoriesId, [
                'category_id' => $categoryId
            ]);

            $this->redirect(\Configuration::BASE . 'user/producategories');
        }

        public function getAdd(){
            $productModel = new \App\Models\ProductModel($this->getDatabaseConnection());
            $products = $productModel->getAll();
            $this->set('products', $products);

            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $categories = $categoryModel->getAll();
            $this->set('categories', $categories);
        }

        public function postAdd(){
            $categoryId = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT);
            $productId = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT);
            
            $productCategoryModel = new \App\Models\ProductCategoryModel($this->getDatabaseConnection());

            $producategoriesId = $productCategoryModel->add([
                'product_id' => $productId,
                'category_id' => $categoryId
            ]);

            if($producategoriesId){
                $this->redirect(\Configuration::BASE . 'user/producategories');
            }

            $this->set('message', 'Doslo je do greske: Nije moguce dodati ovu kategoriju ovom proizvodu!');
        }
    }