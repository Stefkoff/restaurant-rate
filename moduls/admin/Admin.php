<?php

namespace app\moduls\admin;

use Yii;

class Admin extends \yii\base\Module
{
    public $controllerNamespace = 'app\moduls\admin\controllers';

    public function init()
    {
        parent::init();
        $this->layoutPath = \Yii::getAlias('@app/moduls/admin/views/layouts/');
        $this->layout = 'admin';

        // custom initialization code goes here
    }
}
