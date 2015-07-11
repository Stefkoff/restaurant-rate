<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\components\FlashShower;


$this->title = 'Редактиране на профил';
$this->params['breadcrumb'][] = $this->title;
?>

<div class="user-edit">
    <h1><?=Html::encode($this->title);?></h1>
        
    <div class="alert alert-info">
        <p>Ако не искате да сменяте паролата, опставете полетата за парола и за повторение на парола празни</p>
    </div>
    
    <?php
        $form = ActiveForm::begin([
            'id' => 'user-edit-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-2 control-label'],
            ],
        ]);
        ?>
    <?=FlashShower::widget([
        'key' => 'passwordRepeat', 
        'type' => 'danger',
        'extraText' => 'Грешка!'
        ]);?>
    <div class="form-group">
        
            <?=Html::label('Парола', 'password', [
                'class' => 'col-lg-2 control-label'
            ]);?>
        <div class="col-lg-3">
            <?=Html::input('password', 'password', null, [
                'class' => 'form-control'
            ]);?>
        </div>
    </div>
    <div class="form-group">
        
            <?=Html::label('Повтори парола', 'password-repeat', [
                'class' => 'col-lg-2 control-label'
            ]);?>
        <div class="col-lg-3">
            <?=Html::input('password', 'password-repeat', null, [
                'class' => 'form-control'
            ]);?>
        </div>
    </div>
        <?php
        echo $form->field($user, 'email');
        echo $form->field($user, 'firstname');
        echo $form->field($user, 'lastname');           
        echo Html::hiddenInput('userId', $user->id);
    ?>
    
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <?=Html::submitButton('Редактирай', [
                'class' => 'btn btn-primary'
            ]);?>
        </div>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>
