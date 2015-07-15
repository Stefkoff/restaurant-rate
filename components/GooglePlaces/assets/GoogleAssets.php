<?php
/**
 * Description of GoogleAssets
 *
 * @author Georgi
 */

namespace app\components\GooglePlaces\assets;

use yii\web\AssetBundle;

class GoogleAssets extends AssetBundle{    
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [                
        'https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places',        
        'js/google.places.js',
    ];        
    public $css = [
        'css/google.places.css'
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
}
