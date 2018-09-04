<?php
    namespace App\Models;
    
    use App\Core\Model;
    use App\Core\Field;
    use \App\Validators\NumberValidator;
    use \App\Validators\StringValidator;

    class CharacteristicModel extends Model{

        protected function getFields():array {
            return [
                'characteristic_id'     => new Field((new NumberValidator())->setIntegerLength(11), false),

                'name'                  => new Field((new StringValidator())->setMaxLength(64) )
            ];

        }
        
        public function getAllByCharacteristicId(int $charactericticId): array{
           return $this->getAllByFieldName('characterictic_id', $charactericticId);
        }

        

    }