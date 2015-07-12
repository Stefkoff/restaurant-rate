<?php

/**
 * Description of UsersController
 *
 * @author Georgi
 */

namespace app\moduls\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\filters\AccessRules;
use yii\data\ActiveDataProvider;
use app\models\User;
use app\models\GroupMember;
use app\models\Group;

class UsersController extends Controller{
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRules::className()
                ],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'new'],
                        'allow' => true,
                        'roles' => ['admin']
                    ]
                ]
            ]
        ];
    }
    
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
            'pagination' => [
                'pageSize' => 5
            ]
        ]);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }
    
    public function actionNew(){        
        $request = Yii::$app->request;
        $user = new User();
        
        if($request->isPost){
            if($user->load($request->post()) && $user->save()){
                $role = (int) $request->post('role');
                
                if(Group::isValidGroup($role)){
                    $groupMember = new GroupMember();
                    $groupMember->user_id = $user->id;
                    $groupMember->group_id = $role;
                    
                    if($groupMember->save()){
                        return "<a class='auto-close'></a>";
                    }
                    
                } else{
                    throw new CHttpException(404,'Не съществува такава група!');
                }
                    
            } else{
                return $this->renderPartial('new', [
                    'user' => $user
                ]);
            }
        }                
        
        return $this->renderPartial('new', [
            'user' => $user
        ]);
    }
}
