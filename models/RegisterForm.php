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
    public $password;
    public $passwordRepeat;
    public $firstname;
    public $lastname;
    
    public function rules(){
        return [
            [['username', 'password'], 'required'],
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
        $user->password = sha1($this->password);
        $this->firstname = $this->firstname;
        $user->lastname = $this->lastname;
        $user->auth_token = Yii::$app->security->generateRandomString();
        
        if(!$user->save()){
            Yii::warning($user->getErrors());            
            return false;
        }
        
        Yii::$app->user->login($user);
        
        return true;
    }
}
