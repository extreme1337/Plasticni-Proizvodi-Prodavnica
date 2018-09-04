<?php
    namespace App\Models;
    
    use App\Core\Model;
    use App\Core\Field;
    use \App\Validators\NumberValidator;
    use \App\Validators\DateTimeValidator;
    use \App\Validators\StringValidator;

    class UserModel extends Model{
        protected function getFields():array {
            return [
                'user_login_id'    => new Field((new NumberValidator())->setIntegerLength(11), false),           
                'created_at'       => new Field((new DateTimeValidator())->allowDate()->allowTime(),false),

                'ip'               => new Field((new StringValidator())->setMaxLength(64*1024) ),
                'user_id'          => new Field((new NumberValidator())->setIntegerLength(11) )
            ];

        }

        public function getAllUserLoginByIp(int $id) {
            return $this->getAllByFieldName('ip',$id);
        }

        public function getAllUserLoginByUserId(int $userId) {
            return $this->getAllByFieldName('user_id',$userId);
        }
    }