<?php
    namespace App\Models;
    
    use App\Core\Model;
    use App\Core\Field;
    use \App\Validators\NumberValidator;
    use \App\Validators\DateTimeValidator;
    use \App\Validators\StringValidator;

    class ShipmentModel extends Model{
        
        protected function getFields():array {
            return [
                'shipment_id'       => new Field((new NumberValidator())->setIntegerLength(11), false),            
                'created_at'        => new Field((new DateTimeValidator())->allowDate()->allowTime(),false),
                
                'tracking_number'   => new Field((new StringValidator())->setMaxLength(12) ),
                'order_id'          => new Field((new NumberValidator())->setIntegerLength(11) )
            ];

        }

        public function getAllShipmentByOrderId(int $orderId) {
            return $this->getAllByFieldName('order_id',$orderId);
        }

    }