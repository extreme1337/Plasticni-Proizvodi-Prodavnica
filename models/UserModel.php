<?php
    namespace App\Models;
    
    use App\Core\Model;
    use App\Core\Field;
    use \App\Validators\NumberValidator;
    use \App\Validators\DateTimeValidator;
    use \App\Validators\StringValidator;
    use \App\Validators\BitValidator;

    class UserModel extends Model{
        protected function getFields():array {
            return [
                'user_id'           => new Field((new NumberValidator())->setIntegerLength(11), false),           
                'created_at'        => new Field((new DateTimeValidator())->allowDate()->allowTime(),false),

                'username'          => new Field((new StringValidator())->setMaxLength(64) ),
                'password'          => new Field((new StringValidator())->setMaxLength(128) ),
                'email'             => new Field((new StringValidator())->setMaxLength(255) ),
                'salt'              => new Field((new StringValidator())->setMaxLength(64*1024) ),
                'is_active'         => new Field( new BitValidator() )
            ];

        }
        public function getAllUserByUsername(string $username){
            return $this->getByFieldName('username', $username);
        }

        public function getAllUserByEmail(string $email){
            return $this->getByFieldName('email', $email);
        }
        
    }