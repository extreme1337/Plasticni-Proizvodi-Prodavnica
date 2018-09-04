<?php
    namespace App\Models;
    
    use App\Core\Model;
    use App\Core\Field;
    use \App\Validators\NumberValidator;
    use \App\Validators\DateTimeValidator;
    use \App\Validators\StringValidator;

    class OrderModel extends Model{
        
        protected function getFields():array {
            return [
                'order_id'          => new Field((new NumberValidator())->setIntegerLength(11), false),            
                'created_at'        => new Field((new DateTimeValidator())->allowDate()->allowTime(),false),
                #status je enum
                'status'            => new Field((new StringValidator())->setMaxLength(64*1024) ),
                'cart_id'           => new Field((new NumberValidator())->setIntegerLength(11) )
            ];

        }

        

    }