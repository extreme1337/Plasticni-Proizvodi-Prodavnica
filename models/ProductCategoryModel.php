<?php
    namespace App\Models;
    
    use App\Core\Model;
    use \App\Core\Field;
    use \App\Validators\NumberValidator;

    class ProductCategoryModel extends Model{
        
        protected function getFields():array {
            return [
                'product_category_id'   => new Field((new NumberValidator())->setIntegerLength(11), false),

                'category_id'           => new Field((new NumberValidator())->setIntegerLength(11) ),
                'product_id'            => new Field((new NumberValidator())->setIntegerLength(11) )
            ];

        }

        

    }