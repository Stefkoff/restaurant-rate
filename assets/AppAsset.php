<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
     public $depends = [
        'yii\web\YiiAsset',
         '\rmrevin\yii\fontawesome\AssetBundle',         
//        'yii\bootstrap\BootstrapAsset',
//        'yii\web\JqueryAsset'
    ];
    public $css = [
        'css/site.css',
        'css/jquery.dialog2.css',
        'css/bootstrap.css'
    ];
    public $js = [
        'js/jquery.form.min.js',
        'js/jquery.controls.js',
        'js/jquery.dialog2.js',
        'js/jquery.dialog2.helpers.js',        
        'js/main.js'
    ];
   
}
