<?php

    namespace App\Models;

    use App\Core\DatabaseConnection;
    use \App\Core\Model;
    use \App\Core\Field;
    use \App\Validators\NumberValidator;
    use \App\Validators\StringValidator;

    class ManufacturerModel extends Model {

        protected function getFields(): array{
            return[
                'manufacturer_id'   => new Field((new NumberValidator())->setIntegerLength(11), false),
                
                'name'              => new Field((new StringValidator())->setMaxLength(64) ),
                'service'           => new Field((new StringValidator())->setMaxLength(64) ),
                'adress'            => new Field((new StringValidator())->setMaxLength(64*1024) )
            ];
        }

        

        public function getByName(string $name) {
            return $this->getAllByFieldName('name',$name);
        }
    }