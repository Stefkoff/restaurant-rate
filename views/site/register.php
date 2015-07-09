<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* $var $this yii\web\View */

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-register">
    <h1><?=Html::encode($this->title);?></h1>
    
    <p>Please fill out the following fields to register</p>
    
    <?php $form = ActiveForm::begin([
        'id' => 'register-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label']]
            
    ]);?>
    
    <?=$form->field($model, 'username'); ?>
    <?=$form->field($model, 'password')->passwordInput(); ?>
    <?=$form->field($model, 'passwordRepeat')->passwordInput(); ?>
    <?=$form->field($model, 'firstname'); ?>
    <?=$form->field($model, 'lastname'); ?>
    
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>
    
    <?php Activeform::end(); ?>
    
</div>
