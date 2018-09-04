<?php
    namespace App\Models;
    
    use App\Core\Model;
    use App\Core\Field;
    use \App\Validators\NumberValidator;
    use \App\Validators\DateTimeValidator;
    use \App\Validators\StringValidator;

    class PaymentModel extends Model{
        
        protected function getFields():array {
            return [
                'payment_id'        => new Field((new NumberValidator())->setIntegerLength(11), false),            
                'created_at'        => new Field((new DateTimeValidator())->allowDate()->allowTime(),false),
                
                'amount'            => new Field((new NumberValidator())->setDecimal()
                                                                        ->setUnsigned()
                                                                        ->setIntegerLength(7)
                                                                        ->setMaxDigits(2)),
                'order_id'          => new Field((new NumberValidator())->setIntegerLength(11) )
            ];

        }

        

    }