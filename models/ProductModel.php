<?php
    namespace App\Models;
    
    use \App\Core\Model;
    use \App\Core\Field;
    use \App\Validators\NumberValidator;
    use \App\Validators\DateTimeValidator;
    use \App\Validators\StringValidator;
    use \App\Validators\BitValidator;
    
    class ProductModel extends Model {
        
        protected function getFields():array {
            return [
                'product_id'        => new Field((new NumberValidator())->setIntegerLength(11), false),
                'created_at'        => new Field((new DateTimeValidator())->allowDate()->allowTime(),false),
               # 'category_id'           => new Field((new NumberValidator())->setIntegerLength(11) ),
                'name'              => new Field((new StringValidator())->setMaxLength(128) ),
                'picture_path'      => new Field((new StringValidator())->setMaxLength(255) ),  
                'description'       => new Field((new StringValidator())->setMaxLength(64*1024) ),
                'is_active'         => new Field( new BitValidator() ), 
                'user_id'           => new Field((new NumberValidator())->setIntegerLength(11) ),
                'manufacturer_id'   => new Field((new NumberValidator())->setIntegerLength(11) )
            ];

        }

        public function getAllByCategoryId(int $categoryId): array{
            return $this->getAllByFieldName('category_id', $categoryId);
        }

        public function getAllByUserId(int $userId): array{
            return $this->getAllByFieldName('user_id', $userId);
        }

        public function getAllByManufacturerId(int $manufacturerId): array{
            return $this->getAllByFieldName('manufacturer_id', $manufacturerId);
        }

        public function getAllBySearch (string $keywords) {
          $sql = 'SELECT * FROM `product` WHERE (`name` LIKE ? OR `description` LIKE ?) AND is_active = 1;';
          

            $keywords = '%' . $keywords . '%';

            $prep = $this->getConnection()->prepare($sql);
            if(!$prep) {
                return [];
            }

            $res = $prep->execute([$keywords, $keywords]);
            if(!$res) {
                return [];
            }

            return $prep->fetchAll(\PDO::FETCH_OBJ);
        }

    }