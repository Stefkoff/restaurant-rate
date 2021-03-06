<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\base\Security;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password 
 * @property string $email
 * @property string $firstname
 * @property string $lastname
 * @property string $auth_token
 * @property string $access_token
 * 
 * @property GroupMember $groupMembers 
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{            
    
    public $group = null;
    
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
            [['username', 'email'], 'required'],
            [['password'], 'required', 'except' => 'selfupdate'],
            [['username', 'email', 'firstname', 'lastname'], 'string', 'max' => 45],
            [['password', 'auth_token', 'access_token'], 'string', 'max' => 64]
        ];
    }
    
    public function beforeSave($insert) {                            
        
        $this->password = sha1($this->password);
        $this->auth_token = Yii::$app->security->generateRandomString();                                                
        
        if($this->scenario == 'selfupdate'){
            $this->password = sha1($this->password);
        }
        
        if(parent::beforeSave($insert)){
            return true;
        }
        
        return false;
    }
    
    public function afterSave($insert, $changedAttributes) {                        
        
        
        if($insert){
            $groupMember = new GroupMember();

            $groupMember->group_id = Group::GROUP_USERS;
            $groupMember->user_id = $this->id;
            if(!$groupMember->save()){
                return false;
            }
        }
        
        if(parent::afterSave($insert, $changedAttributes)){
            return true;
        }
    }
    
    public function afterFind() {
        $this->group = $this->groupMembers->find()->one();
        
        parent::afterFind();
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
            'email' => 'Email',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'auth_token' => 'Auth Token',
            'access_token' => 'Access Token',
        ];
    }
    
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['selfupdate'] = ['password'];
        return $scenarios;
    }
    
    public function isAdmin(){
        $groupMember = $this->getGroupMembers();
        
        $member = $groupMember->where('group_id = 3')->one();
        
        if(!empty($member)){
            return true;
        }
        
        return false;
    }
    
    public function isModerator(){
        $groupMember = $this->getGroupMembers();
        
        $member = $groupMember->where('group_id = 2')->one();
        
        if(!empty($member)){
            return true;
        }
        
        return false;
        
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
   public function getGroupMembers()
   {
       return $this->hasOne(GroupMember::className(), ['user_id' => 'id']);
   }
    
    public function generateAccessToken(){
        $this->access_token = sha1($this->auth_token);
        $this->save();
        
        $text = Html::a('Click here', Yii::$app->urlManager->createAbsoluteUrl(['site/recover', 'email' => $this->email, 'token' => $this->access_token]));
        $text = Yii::$app->stringHelper->fixUrlAmpersand($text);
        
        Yii::$app->mailer->compose()
                ->setFrom('noreply@restaurant.com')
                ->setTo($this->email)
                ->setSubject('Password Recovery')
                ->setTextBody($text)
                ->send();
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
