<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UrlHelper
 *
 * @author Georgi
 */

namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class StringHelper extends Component{
    
    public function fixUrlAmpersand($url){
        Yii::info($url);
        
        $helpArray = explode('amp;', $url);
        
        $clearUrl = '';
        
        foreach ($helpArray as $u){
            $clearUrl .= $u;
        }
        
        return $clearUrl;
    }    
}
