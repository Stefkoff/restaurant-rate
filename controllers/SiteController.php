<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\ContactForm;
use app\models\User;
use yii\db\Query;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),      
                'only' => ['register', 'recover', 'reset', 'logout', 'places'],
                'rules' => [
                    [
                        'actions' => ['logout', 'places'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['register', 'recover', 'reset'],
                        'allow' => true,
                        'roles' => ['?']
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionRegister(){
        if(!Yii::$app->user->isGuest){
            return $this->goHome();
        }
        
        $model = new RegisterForm();
        if($model->load(Yii::$app->request->post()) && $model->register()){            
            return $this->goBack();
        } else{            
            return $this->render('register', [
                'model' => $model
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionForgot(){
        
        $requst = Yii::$app->request;        
        
        if($requst->isPost){
            $email = $requst->post('email');                                    
            $user = User::find()->where('email = :email', [':email' => $email])->one();                        
            
            if(!$user){
                Yii::$app->getSession()->setFlash('emailNotFound', 'Емайл адресът не е намерен!');                
            } else{
                $userAccessToken = $user->generateAccessToken();
                Yii::$app->getSession()->setFlash('emailFound', 'До вас е изпратен имейл');
            }
            
            return $this->render('forgot_pass');
        }
        
        return $this->render('forgot_pass');
    }
    
    public function actionRecover(){
        $request = Yii::$app->request;
        if($request->isGet){
            $email = $request->get('email');
            $access_token = $request->get('token');

            //$user = User::find()->where(['email' => $email, 'access_token' => $access_token])->one();
            $user = User::findOne(['email' => $email, 'access_token' => $access_token]);
            
            if(!$user){
                $this->goHome();
            } else{
                return $this->render('resetPassword', [
                    'user_id' => $user->id
                ]);
            }                        
        }
    }
    
    public function actionReset(){        
        
        $request = Yii::$app->request;
        
        if($request->isPost){
            $password = $request->post('password');
            $passwordRepeat = $request->post('password_repeat');
            $userId = $request->post('userId');
            
            $user = User::findIdentity($userId);
            
            if($password !== $passwordRepeat){
                Yii::$app->getSession()->setFlash('passwordRepeat', 'Паролите не съвпадат');
                
                return $this->render('resetPassword', [
                    'user_id' => $user->id
                ]);
            } else{
                $user->password = $password;
                if($user->save()){                    
                    Yii::$app->user->login($user);
                }                      
                return $this->render('index');
            }
        }
    }
    
    public function actionPlaces($q){
         $query = new Query;
    
        $query->select('username')
            ->from('user')
            ->where('username LIKE "%' . $q .'%"')
            ->orderBy('username');
        $command = $query->createCommand();
        $data = $command->queryAll();
        $out = [];
        foreach ($data as $d) {
            $out[] = ['value' => $d['username']];
        }
        echo \yii\helpers\Json::encode($out);                         
    }
}
