<?php
    namespace App\Controllers;

    class UserCategoryManagementController extends \App\Core\Role\UserRoleController{
        public function categories(){
                $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
                $categories = $categoryModel->getAll();
                $this->set('categories', $categories);
            }

        public function getEdit($categoryId){
            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $category = $categoryModel->getById($categoryId);

            if(!$category){
                $this->redirect(\Configuration::BASE . 'user/categories');
            }

            $this->set('category', $category);

            return $categoryModel;
        }
        
        public function postEdit($categoryId){
            $categoryModel = $this->getEdit($categoryId);

            $editData = [
                'name'           => \filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING),
                'is_active'      => \filter_input(INPUT_POST, 'is_active', FILTER_SANITIZE_NUMBER_INT)
            ];
            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
                      
            $res = $categoryModel->editById($categoryId, $editData);
            if (!$res) {
                $this->set('message', 'Nije bilo moguce izmeniti aukciju.');
                return;
            }

            $this->redirect(\Configuration::BASE . 'user/categories');
        }

        public function getAdd(){
            
        }

        public function postAdd(){
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING); 
          #  $picturePath = filter_input(INPUT_POST, 'picture_path', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());

            $categoryId = $categoryModel->add([
                'name' => $name,
               # 'picture_path' => $picturePath,
                'description' => $description
            ]);

            if($categoryId){
                $this->redirect(\Configuration::BASE . 'user/categories');
            }

            $this->set('message', 'Doslo je do greske: Nije moguce dodati ovu kategoriju!');
        }
    }