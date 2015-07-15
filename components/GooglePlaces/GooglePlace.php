<?php

/**
 * Description of GooglePlace
 *
 * @author Georgi
 */

namespace app\components\GooglePlaces;

use yii\base\Widget;

class GooglePlace extends Widget{
    
    public function init(){
        parent::init();
    }
    
    public function run() {
        return $this->render('google');
    }
    
}
