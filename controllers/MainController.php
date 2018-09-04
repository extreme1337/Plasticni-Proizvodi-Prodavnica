<?php
    namespace App\Controllers;

    class MainController extends \App\Core\Controller{

        public function __pre(){
            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $categories = $categoryModel->getAll();
            $this->set('categories', $categories);
        }

        public function home(){
            
        }

        public function getRegister(){

        }
        
        public function postRegister(){
            $email     = \filter_input(INPUT_POST, 'reg_email', FILTER_SANITIZE_EMAIL);
            #$forename  = \filter_input(INPUT_POST, 'reg_forename', FILTER_SANITIZE_STRING);
            #$surname   = \filter_input(INPUT_POST, 'reg_surname', FILTER_SANITIZE_STRING);
            $username  = \filter_input(INPUT_POST, 'reg_username', FILTER_SANITIZE_STRING);
            $password1 = \filter_input(INPUT_POST, 'reg_password_1', FILTER_SANITIZE_STRING);
            $password2 = \filter_input(INPUT_POST, 'reg_password_2', FILTER_SANITIZE_STRING);

            if($password1 !== $password2){
                $this->set('message','Doslo je do greske: Niste uneli dva puta istu lozinku.');
                return;
            }

            $validanPassword = (new \App\Validators\StringValidator())
                ->setMinLength(7)
                ->setMaxLength(120)
                ->isValid($password1);

            if ( !$validanPassword) {
                $this->set('message', 'Doslo je do greske: Lozinka nije ispravnog formata.');
                return;
            }

            $userModel = new \App\Models\UserModel($this->getDatabaseConnection());
            $user = $userModel->getByFieldName('email', $email);
            if($user){
                $this->set('message','Doslo je do greske: Vec postoji korisnik sa tim emailom.');
                return;
            }

            $user = $userModel->getByFieldName('username', $username);
            if($user){
                $this->set('message','Doslo je do greske: Vec postoji korisnik sa tim korisnickim imenom.');
                return;
            }

            $passwordHash = \password_hash($password1, PASSWORD_DEFAULT);

            $userId = $userModel->add([
                'username' => $username,
                'password' => $passwordHash,
                'email' => $email
            ]);

            if(!$userId){
                $this->set('message','Doslo je do greske: Nije bilo uspesno registrovanje.');
                return;
            }
            
            
            $this->set('message','Napravljen je novi nalog. Sada mozete da se prijavite.');

        }

        public function getLogin(){

        }

        public function postLogin(){
            $username = \filter_input(INPUT_POST, 'login_username', FILTER_SANITIZE_STRING);
            $password = \filter_input(INPUT_POST, 'login_password', FILTER_SANITIZE_STRING);

            
            $validanPassword = (new \App\Validators\StringValidator())
                ->setMinLength(7)
                ->setMaxLength(120)
                ->isValid($password);

            if (!$validanPassword) {
                $this->set('message', 'Doslo je do greške: Lozinka nije ispravnog formata.');
                return;
            }

            $userModel = new \App\Models\UserModel($this->getDatabaseConnection());
            $user = $userModel->getByFieldName('username', $username);
            if(!$user){
                $this->set('message','Doslo je do greske: Ne postoji korisnik sa tim korisnickim imenom.');
                return;
            }

            

            if(!password_verify($password, $user->password)){
                \sleep(1);
                $this->set('message','Doslo je do greske: Lozinka nije ispravna.');
                return;
            }

            $this->getSession()->put('user_id', $user->user_id);
            $this->getSession()->save();

            $this->redirect(\Configuration::BASE . 'user/profile');
        }

        public function getLogout(){
            $this->getSession()->remove('user_id');
            $this->getSession()->save();
            $this->redirect(\Configuration::BASE);
        }
            
    }