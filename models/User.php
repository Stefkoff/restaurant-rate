<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\base\Security;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password 
 * @property string $firstname
 * @property string $lastname
 * @property string $auth_token
 * @property string $access_token
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password', 'auth_token'], 'required'],
            [['username', 'password', 'firstname', 'lastname'], 'string', 'max' => 64],
            [['auth_token', 'access_token'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password', 
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'auth_token' => 'Auth Token',
            'access_token' => 'Access Token',
        ];
    }
    
    public function login(){
        Yii::$app->user->login($this);
    }

    public function getAuthKey() {
        return $this->auth_token;
    }

    public function getId() {
        return $this->getPrimaryKey();
    }

    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentity($id) {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['access_token' => $token]);
    }
    
    public static function findByUsername($username){
        return static::findOne(['username' => $username]);
    }
    
    public static function findByPasswordResetToken($token){
        //todo        
    }
    
    public function validatePassword($password){       
        return $this->password === sha1($password);
    }
    
    public function setPassword($password){
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
    
    public function generateAuthKey(){
        $this->auth_token = Yii::$app->security->generateRandomKey() . '_' . time();
    }
    
    public function generetePasswordResetToken(){
        $this->access_token = Yii::$app->security->generateRandomKey() . '_' . time();
    }
    
    public function removePasswordResetToken(){
        $this->access_token = null;
    }
    
    public static function sayHello(){
        return "Hello World";
    }

}
