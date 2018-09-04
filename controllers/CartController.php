<?php

namespace App\controllers;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class CartController extends \App\core\Controller{

    public function show(){
     /*   $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
        $categories = $categoryModel->getAll();
        $this->set('categories',$categories);
        
        $sessionId = $this->getSessionId();

        $orderCartModel = new \App\models\CartModelModel($this->getDatabaseConnection());
        $order = $orderCartModel->selectTableInnerJoin($sessionId);
        $this->set('cartModelModel', $order);  
        */
        
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

        public function deleteById(){
            $orderCartModel = new \App\models\CartModelModel($this->getDatabaseConnection());
            $cartModel = $orderCartModel->getAll();
            $this->set('cartModel',$cartModel);
            $deleteById = \filter_input(INPUT_POST,'cart_model_id', FILTER_SANITIZE_NUMBER_INT);
            $deleteModelFromCart = $orderCartModel->deleteById($deleteById);
            header('Location: '.\Configuration::BASE.'cart');
        }
                

    public function orderFromCart(){
        $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
        $categories = $categoryModel->getAll();
        $this->set('categories',$categories);

        $orderCartModel = new \App\models\CartModelModel($this->getDatabaseConnection());
        $order = $orderCartModel->selectTableInnerJoin($this->getSessionId());
        $this->set('cartModelModel', $order);
        
    }


    public function postOrderFromCart(){
        $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
        $categories = $categoryModel->getAll();
        $this->set('categories',$categories);
        
        $sessionId = $this->getSessionId();

        $orderCartModel = new \App\models\CartModelModel($this->getDatabaseConnection());
        $order = $orderCartModel->selectTableInnerJoin($sessionId);
        $this->set('cartModelModel', $order); 
        $orderSum = $orderCartModel->suma($sessionId);
        $this->set('suma',$orderSum);


        

        
        $forename = \filter_input(INPUT_POST,'forename', FILTER_SANITIZE_STRING);
        $surename = \filter_input(INPUT_POST,'surename', FILTER_SANITIZE_STRING);
        $residential_address = \filter_input(INPUT_POST,'residential_address', FILTER_SANITIZE_STRING);
        $email = \filter_input(INPUT_POST,'email', FILTER_SANITIZE_STRING);
        $cartModel = new \App\models\CartModel($this->getDatabaseConnection());
        $cartId = (array)$cartModel->getByFieldName('session_number',$this->getSessionId());
        $string2 = "";
        foreach($order as $niz){
            $string2 .= $niz['name']."  Cena proizvoda: ".$niz['price_for_model']." RSD \n";
        }
        
       
        


        $orderModel = new \App\models\OrderCartModel($this->getDatabaseConnection());
        
        if(!$orderModel){
            $this->set('Location: '.\Configuration::BASE);
        }
        $orderModel->add([
            'forename' => $forename,
            'surname' => $surename,
            'residential_address' => $residential_address,
            'email'=> $email,
            'cart_id' => $cartId['cart_id']        
        ]);
        
        
        $mail = new PHPMailer(true);
        try{
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = \Configuration::MAIL_HOST;  
            $mail->SMTPAuth = true;                               
            $mail->Username = \Configuration::MAIL_USERNAME;                 
            $mail->Password = \Configuration::MAIL_PASSWORd;
            $mail->SMTPSecure = \Configuration::MAIL_PROTOCOL;                            
            $mail->Port = \Configuration::MAIL_PORT;                                    

            //Recipients
            $mail->setFrom(\Configuration::MAIL_USERNAME);
            $mail->addAddress($email); 

        
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $string = '<!doctype html><html><head><meta charset="utf-8"></head><body>';
            $string = 'Proizvodi koje zelite da narucite: '.\htmlspecialchars($string2).'  ';
            $string .= 'Ukupna cena je: '.\sprintf("%.2f",$orderSum['suma']).'  ';
            $string .= 'Vasa porudzbina je u obradi!';
            $string .= '</body></html>';
        
            $mail->Body    = $string;
            $mail->send();
            header('Location: '.\Configuration::BASE);
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
        


    }

    

    


}