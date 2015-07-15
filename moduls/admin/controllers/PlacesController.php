<?php
/**
 * Description of PlacesController
 *
 * @author Georgi
 */

namespace app\moduls\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\filters\AccessRules;

use dosamigos\google\places\Search;
use yii\helpers\Json;

class PlacesController extends Controller{
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRules::className()
                ],
                'rules' => [
                    [
                        'actions' => ['index', 'search'],
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
    
    public function actionSearch(){
    	$request = Yii::$app->request;
    	
    	$query = $request->get('term');
    	
    	$search = new Search(['key' => 'AIzaSyBOHCLkfRYWN6Jpvz8l2P7zY-pTIABQ86o']);
    	
    	$result = $search->text($query);
    	
    	$places = [];
    	
    	foreach ($result['results'] as $res){
    		$places[] = ['value' => $res['formatted_address'], 'goog' => $res['geometry']['location']['lat']];
    	}    	    
    	
    	echo Json::encode($places);

    	
//     	echo "<pre>";
//     	echo print_r($result);
//     	echo "</pre>";
//     	die;
    	
    }
}
