<?php
    namespace App\Models;
    
    use App\Core\Model;
    use App\Core\Field;
    use \App\Validators\NumberValidator;
    use \App\Validators\DateTimeValidator;

    class CartProductModel extends Model{
        
        protected function getFields():array {
            return [
                'cart_product_id'  => new Field((new NumberValidator())->setIntegerLength(11), false),           
                'created_at'       => new Field((new DateTimeValidator())->allowDate()->allowTime(),false),
                
                'quantity'         => new Field((new NumberValidator())->setDecimal()
                                                                       ->setUnsigned()
                                                                       ->setIntegerLength(7)
                                                                       ->setMaxDigits(2)),
                'product_id'       => new Field((new NumberValidator())->setIntegerLength(11) ),
                'cart_id'          => new Field((new NumberValidator())->setIntegerLength(11) )
            ];

        }


    }