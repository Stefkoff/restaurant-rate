<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Забравена парола';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-forgot-pass">
    <h1><?=Html::encode($this->title)?></h1>
    
    <p>Моля въведете вашият имейл адрес</p>
    
    <div class="form">
        <?php 
        echo Html::beginForm('', 'post', [
            'class' => 'form-horizontal'
        ]);

        if(Yii::$app->getSession()->hasFlash('emailNotFound')){
            echo "<div class='error'>" . Yii::$app->getSession()->getFlash('emailNotFound') . "</div>";
            Yii::$app->getSession()->removeFlash('emailNotFound');
        }
        
        if(Yii::$app->getSession()->hasFlash('emailFound')){
            echo "<div class='error'>" . Yii::$app->getSession()->getFlash('emailFound') . "</div>";
            Yii::$app->getSession()->removeFlash('emailFound');
        }
        
        echo Html::input('email', 'email', null, [
            'class' => 'form-control'
        ]);
        ?>
        
        <div class="form-group">
            <?=Html::submitButton('Изпрати', [
                'class' => 'btn btn-primary'
            ]); ?>
        </div>
        
        <?=Html::endForm();?>
    </div>
</div>