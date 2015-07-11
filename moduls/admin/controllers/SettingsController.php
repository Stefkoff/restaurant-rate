<?php
/**
 * Description of SettingsController
 *
 * @author Georgi
 */

namespace app\moduls\admin\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use app\filters\AccessRules;

class SettingsController extends Controller{
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRules::className()
                ],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin']
                    ]
                ]
            ]
        ];
    }
    
    public function actionIndex()
    {
        return $this->render('index');
    }
}
