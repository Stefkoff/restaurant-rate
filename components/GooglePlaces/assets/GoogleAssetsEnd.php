<?php
/**
 * Description of GoogleAssets
 *
 * @author Georgi
 */

namespace app\components\GooglePlaces\assets;

use yii\web\AssetBundle;

class GoogleAssetsEnd extends AssetBundle{    
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
    		'js/socket.js'
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_END
    );
}
