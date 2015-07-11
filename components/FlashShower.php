<?php
/**
 * Description of FlashShower
 *
 * @author Georgi
 */

namespace app\components;

use Yii;
use yii\base\Widget;

class FlashShower extends Widget{
    public $key = null;
    public $type = null;
    public $extraText = null;
    
    public function init() {
        parent::init();
    }
    
    public function run() {
        if(Yii::$app->getSession()->hasFlash($this->key)){            
            $message = Yii::$app->getSession()->getFlash($this->key);
            Yii::$app->getSession()->remove($this->key);
            return "<div class='alert alert-" . $this->type . "'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" . (($this->extraText) ? "<strong>" . $this->extraText . "</strong> " : null) . $message . "</div>";
        }
    }
}
