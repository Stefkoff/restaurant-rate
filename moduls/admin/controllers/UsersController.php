<?php

/**
 * Description of UsersController
 *
 * @author Georgi
 */

namespace app\moduls\admin\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use app\filters\AccessRules;
use yii\data\ActiveDataProvider;
use app\models\User;

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
        return $this->renderPartial('new');
    }
}
