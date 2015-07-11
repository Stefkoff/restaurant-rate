<?php

/**
 * Description of User
 *
 * @author Georgi
 */

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\filters\AccessRules;
use yii\web\Controller;
use app\models\User;

class UserController extends Controller{
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['profile', 'edit'],
                'ruleConfig' => [
                    'class' => AccessRules::className()
                ],
                'rules' => [
                    [
                        'actions' => ['profile', 'edit'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }    
    
    public function actionProfile(){
        $user = Yii::$app->user->getIdentity();
        return $this->render('profile', [
            'user' => $user
        ]);
    }
    
    public function actionEdit(){
        $request = Yii::$app->request;
        
        
        if($request->isPost){
            $id = (int) $request->post('userId');
            
            $user = User::findOne($id);
            
            if(!$user){
                return $this->goHome();
            }                                    
            
            if($user->load($request->post()) && $user->validate()){                
                if(isset($_POST['password']) && isset($_POST['password-repeat'])){
                    $password = $request->post('password');
                    $passwordRepeat = $request->post('password-repeat');
                    
                    if($password !== $passwordRepeat){
                        Yii::$app->getSession()->setFlash('passwordRepeat', 'Паролите не съвпадат');
                        
                        return $this->render('edit', [
                            'user' => $user
                        ]);
                    }
                    
                    $user->password = $password;
                    $user->setScenario('selfupdate');
                }                                
                
                if($user->save()){                                                            
                    return $this->render('profile', [
                        'user' => $user
                    ]);
                } else{
                    Yii::info($user->getErrors());
                }
            }                        
        }
        
        $userId = $request->get('id');       
        $user = User::findOne($userId);
        
        $user->isAdmin();
        
        if(!$user){
            return $this->goHome();
        }
                
        return $this->render('edit', [
            'user' => $user
        ]);
    }
}
