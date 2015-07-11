<?php

use yii\helpers\Html;

$this->title = "Възтановяване на парола";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-reset-pass">
    <h1><?=Html::encode($this->title)?></h1>
    
    
    <div class="form">
    <?php
    echo Html::beginForm('reset', 'post', [
        'class' => 'form-horizontal'
    ]);    
    ?>    
    <?php
    if(Yii::$app->getSession()->hasFlash('passwordRepeat')){
        echo "<div class='error-summary'>" . Yii::$app->getSession()->getFlash('passwordRepeat') . "</div>";
        Yii::$app->getSession()->remove('passwordRepeat');
    }
    ?>
    <?=Html::label('Парола', 'password', ['class' => 'control-label'])?>        
    <?=Html::input('password', 'password', null, ['class' => 'form-control', 'id' => 'password']);?>        
        <?=Html::label('Повтори паролата', 'password-repeat', ['class' => 'control-label'])?>        
    <?=Html::input('password', 'password_repeat', null, ['id' => 'password-repeat', 'class' => 'form-control']);?>
    <?=Html::hiddenInput('userId', $user_id);?>
    <?=Html::submitButton('Възтанови', [
        'class' => 'btn btn-primary form-control'
    ]);?>
    <?=Html::endForm();?>    
    </div>
