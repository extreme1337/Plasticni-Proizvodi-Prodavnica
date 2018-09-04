<?php
    namespace App\Models;
    
    use App\Core\Model;
    use App\Core\Field;
    use \App\Validators\NumberValidator;
    use \App\Validators\DateTimeValidator;

    class ProductPriceModel extends Model{
        protected function getFields():array {
            return [
                'product_price_id'  => new Field((new NumberValidator())->setIntegerLength(11), false),          
                'created_at'        => new Field((new DateTimeValidator())->allowDate()->allowTime(),false),
                
                'amount'            => new Field((new NumberValidator())->setDecimal()
                                                                        ->setUnsigned()
                                                                        ->setIntegerLength(7)
                                                                        ->setMaxDecimalDigits(2)),
                'product_id'        => new Field((new NumberValidator())->setIntegerLength(11))
            ];

        }

        public function getAllProductPriceByProductId(int $productId): array{
            return $this->getAllByFieldName('product_id', $productId);
        }

        /*
        public function getAllFromDifferentTable(int $category_id): array{
            $sql = 'SELECT * FROM Product WHERE product_id IN (SELECT product_id FROM Product_Category WHERE category_id = ?);';
            $prep = $this->dbc->getConnection()->prepare($sql);
            $res = $prep->execute([$category_id]);
            $items = [];
            if ($res) {
                $items = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
            return $items;
        }
        */
        
    }