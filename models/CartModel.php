<?php
    namespace App\Models;
    
    use App\Core\Model;
    use App\Core\Field;
    use \App\Validators\NumberValidator;
    use \App\Validators\DateTimeValidator;

    class CartModel extends Model{
        
        protected function getFields():array {
            return [
                'cart_id'           => new Field((new NumberValidator())->setIntegerLength(11), false),            
                'created_at'        => new Field((new DateTimeValidator())->allowDate()->allowTime(),false),

                'user_id'           => new Field((new NumberValidator())->setIntegerLength(11) )
            ];

        }

        

    }