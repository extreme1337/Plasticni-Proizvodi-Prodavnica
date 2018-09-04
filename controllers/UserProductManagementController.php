<?php
    namespace App\Controllers;

    class UserProductManagementController extends \App\Core\Role\UserRoleController {
        public function products() {
            $productModel = new \App\Models\ProductModel($this->getDatabaseConnection());
            $products = $productModel->getAll();
            $this->set('products', $products);
        }

        public function getEdit($productId) {
            $productModel = new \App\Models\ProductModel($this->getDatabaseConnection());
            $product = $productModel->getById($productId);
            $this->set('product', $product);
            
            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $categories = $categoryModel->getAll();
            $this->set('categories', $categories);

            $productCategoryModel = new \App\Models\ProductCategoryModel($this->getDatabaseConnection());
            $producategories = $productCategoryModel->getAll();
            $this->set('producategories', $producategories);

            $productPriceModel = new \App\Models\ProductPriceModel($this->getDatabaseConnection());
            $productPrices = $productPriceModel->getAllProductPriceByProductId($productId);
            $productPrice = $productPrices[count($productPrices)-1];
            $this->set('productPrice', $productPrice);
        /*    print_r($productPrice);  */

            $manufacturerModel = new \App\models\ManufacturerModel($this->getDatabaseConnection());
            $manufacturer = $manufacturerModel->getAll();
            $this->set('manufacturers', $manufacturer);

            if (!$product) {
                $this->redirect(\Configuration::BASE . 'user/products');
            }

            $this->set('product', $product);

            return $productModel;
        }

        public function postEdit($productId) {
            $productModel = $this->getEdit($productId);

            $editData = [
                'name'           => \filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING),
                'description'    => \filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING),
                'user_id'        => $this->getSession()->get('user_id')
            ];
            $productModel = new \App\Models\ProductModel($this->getDatabaseConnection());
            $productPriceModel = new \App\Models\ProductPriceModel($this->getDatabaseConnection());
            $productCategoryModel = new \App\Models\ProductCategoryModel($this->getDatabaseConnection()); 

            $categoryId = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT);

            $productCategoryModel->editById($productId, [
                
                'category_id' => $categoryId
            ]);

            $amount = sprintf("%.2f",\filter_input(INPUT_POST,'amount', FILTER_SANITIZE_STRING));
           

            $productPriceModel->add([
                'product_id' => $productId,
                'amount' => $amount
            ]);

           
            
            $productCategoryModel->add([
                'product_id' => $productId,
                'category_id' => $categoryId
            ]);

            $res = $productModel->editById($productId, $editData);
            if (!$res) {
                $this->set('message', 'Nije bilo moguce izmeniti aukciju.');
                return;
            }

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $uploadStatus = $this->doImageUpload('image', $productId);
                if (!$uploadStatus) {
                    return;
                }
            }

            $this->redirect(\Configuration::BASE . 'user/products');
        }

        public function getAdd() {
            $categoryModel = new \App\models\CategoryModel($this->getDatabaseConnection());
            $category = $categoryModel->getAll();
            $this->set('categories', $category);

            $productCategoryModel = new \App\Models\ProductCategoryModel($this->getDatabaseConnection());
            $producategories = $productCategoryModel->getAll();
            $this->set('producategories', $producategories);

            $productPriceModel = new \App\Models\ProductPriceModel($this->getDatabaseConnection());
            $productPrice = $productPriceModel->getAll();
            $this->set('productPrice', $productPrice);

            $manufacturerModel = new \App\models\ManufacturerModel($this->getDatabaseConnection());
            $manufacturer = $manufacturerModel->getAll();
            $this->set('manufacturers',$manufacturer);
        }

        public function postAdd() {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
           
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            #$isActive = filter_input(INPUT_POST, 'is_active', FILTER_SANITIZE_NUMBER_INT); */
            $manufacturerId = filter_input(INPUT_POST, 'manufacturer_id', FILTER_SANITIZE_NUMBER_INT);
            $categoryId = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT);

          /*  $productId = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT); */
            /*$addData = [
                'name'            => \filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING),
                'description'     => \filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING),
                'manufacturer_id' => \filter_input(INPUT_POST, 'manufacturer_id', FILTER_SANITIZE_NUMBER_INT),
               /* 'category_id'     => \filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT), 
              
                'user_id'         => $this->getSession()->get('user_id')
            ];
                 */
            $productModel = new \App\Models\ProductModel($this->getDatabaseConnection());   

            $productId = $productModel->add([
                'name' => $name,
                'description' => $description,
                'user_id' => $this->getSession()->get('user_id'),
                'manufacturer_id' => $manufacturerId
            ]);

            if (!$productId) {
                $this->set('message', 'Nije dodat proizvod.');
                return;
            }

            $productCategoryModel = new \App\Models\ProductCategoryModel($this->getDatabaseConnection()); 
            $productCategoryModel->add([
                'product_id' => $productId,
                'category_id' => $categoryId
            ]);

            $amount = sprintf("%.2f",\filter_input(INPUT_POST,'amount', FILTER_SANITIZE_STRING));
            $productPriceModel = new \App\Models\ProductPriceModel($this->getDatabaseConnection());
            $productPriceModel->add([
                'product_id' => $productId,
                'amount' => $amount
            ]);

            $uploadStatus = $this->doImageUpload('image', $productId);
            if (!$uploadStatus) {
                return;
            }

            $this->redirect(\Configuration::BASE . 'user/products');
        }

        public function deleteById(){
            $productModel = new \App\models\ManufacturerModel($this->getDatabaseConnection());
            $product = $productModel->getAll();
            $this->set('products',$product);

        }

        public function postDeleteById(){
            
            $manufacturer1 = \filter_input(INPUT_POST,'manufacturer_id', FILTER_SANITIZE_NUMBER_INT);
            $productModel = new \App\models\ManufacturerModel($this->getDatabaseConnection());
            $product = $productModel->deleteById($manufacturer1);
            $this->redirect(\Configuration::BASE . 'user/products');
        }

        private function doImageUpload(string $fieldName, string $productId): bool {
            $productModel = new \App\Models\ProductModel($this->getDatabaseConnection());
            $product = $productModel->getById(intval($productId));
            # codeguy/upload

            unlink(\Configuration::UPLOAD_DIR . $product->picture_path);

            $uploadPath = new \Upload\Storage\FileSystem(\Configuration::UPLOAD_DIR);
            $file = new \Upload\File($fieldName, $uploadPath);
            $file->setName($productId);
            $file->addValidations([
                new \Upload\Validation\Mimetype(["image/jpeg", "image/png"]),
                new \Upload\Validation\Size("3M")
            ]);

            try {
                $file->upload();

                $fullFilename = $file->getNameWithExtension();

                $productModel->editById(intval($productId), [
                    'picture_path' => $fullFilename
                ]);

                
                return true;
            } catch (\Exception $e) {
                $this->set('message', 'Greska: ' . implode(', ', $file->getErrors()));
                return false;
            }
        }

    }
