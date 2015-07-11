<?php

/**
 * Description of RegisterForm
 *
 * @author Georgi
 */

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class RegisterForm extends Model{
    public $username;
    public $email;
    public $password;
    public $passwordRepeat;
    public $firstname;
    public $lastname;
    
    public function rules(){
        return [
            [['username', 'email', 'password', 'passwordRepeat'], 'required'],
            [['firstname', 'lastname'], 'default'],
            ['passwordRepeat', 'checkPasswordRepeat']
        ];
    }
//    
    public function checkPasswordRepeat($attribute, $params){        
        if($this->password !== $this->$attribute){
            $this->addError($attribute, 'Password repeat doesnt match to the password');
        }
    }
    
    public function register(){
        
        if(!$this->validate()){
            return false;
        }
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = $this->password;
        $user->firstname = $this->firstname;
        $user->lastname = $this->lastname;        
        
        if(!$user->save()){
            Yii::warning($user->getErrors());            
            return false;
        }
        
        Yii::$app->user->login($user);
        
        return true;
    }
}
