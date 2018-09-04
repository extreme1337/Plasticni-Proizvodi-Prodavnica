<?php
    namespace App\Controllers;

    class UserManufacturerManagementController extends \App\Core\Role\UserRoleController {
        public function manufacturers() {
            $manufacturerModel = new \App\Models\ManufacturerModel($this->getDatabaseConnection());
            $manufacturers = $manufacturerModel->getAll();
            $this->set('manufacturers', $manufacturers);
        }

        public function getEdit($manufacturerId) {
            $manufacturerModel = new \App\Models\ManufacturerModel($this->getDatabaseConnection());
            $manufacturer = $manufacturerModel->getById($manufacturerId);

            if (!$manufacturer) {
                $this->redirect(\Configuration::BASE . 'user/manufacturers');
            }

            $this->set('manufacturer', $manufacturer);

            return $manufacturerModel;
        }

        public function postEdit($manufacturerId) {
            $manufacturerModel = $this->getEdit($manufacturerId);

            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $service = filter_input(INPUT_POST, 'service', FILTER_SANITIZE_STRING);
            $adress = filter_input(INPUT_POST, 'adress', FILTER_SANITIZE_STRING);
            

            $manufacturerModel->editById($manufacturerId, [
                'name' => $name,
                'service' => $service,
                'adress' => $adress
            ]);

            $this->redirect(\Configuration::BASE . 'user/manufacturers');
        }

        public function getAdd() {

        }

        public function postAdd() {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $service = filter_input(INPUT_POST, 'service', FILTER_SANITIZE_STRING);
            $adress = filter_input(INPUT_POST, 'adress', FILTER_SANITIZE_STRING);

            $manufacturerModel = new \App\Models\ManufacturerModel($this->getDatabaseConnection());
            
            $manufacturerId = $manufacturerModel->add([
                'name' => $name,
                'service' => $service,
                'adress' => $adress
            ]);

            if ($manufacturerId) {
                $this->redirect(\Configuration::BASE . 'user/manufacturers');
            }

            $this->set('message', 'Doslo je do greske: Nije moguce dodati ovog proizvodjaca!');
        }

        public function deleteById(){
            $manufacturerModel = new \App\models\ManufacturerModel($this->getDatabaseConnection());
            $manufacturer = $manufacturerModel->getAll();
            $this->set('manufacturers', $manufacturer);

        }

        public function postDeleteById(){ 
            $manufacturer1 = \filter_input(INPUT_POST,'manufacturer_id', FILTER_SANITIZE_NUMBER_INT);
            $manufacturerModel = new \App\models\ManufacturerModel($this->getDatabaseConnection());
            $manufacturer = $manufacturerModel->deleteById($manufacturer1);
            $this->redirect(\Configuration::BASE . 'user/manufacturers');
        }
    }
