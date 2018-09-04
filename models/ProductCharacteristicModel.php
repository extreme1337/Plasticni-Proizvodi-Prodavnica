<?php
    namespace App\Models;
    
    use App\Core\Model;
    use \App\Core\Field;
    use \App\Validators\NumberValidator;
    use \App\Validators\StringValidator;

    class ProductCharacteristicModel extends Model{
        
        protected function getFields():array {
            return [
                'product_characteristic_id'   => new Field((new NumberValidator())->setIntegerLength(11), false),

                'value'                       => new Field((new StringValidator())->setMaxLength(64*1024) ),
                'characteristic_id'           => new Field((new NumberValidator())->setIntegerLength(11) ),
                'product_id'                  => new Field((new NumberValidator())->setIntegerLength(11) )
            ];

        }

        public function getAllCharacteristicByProductId(int $productId): array{
            return $this->getAllByFieldName('product_id', $productId);
        }

        

    }