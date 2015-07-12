<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<h1>Нов потребител</h1>


<?php $form = ActiveForm::begin([
    'id' => 'form-new-user',
    'options' => ['class' => 'form-horizontal ajax'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"span3\">{input}</div>\n<div class=\"span8\">{error}</div>",
            'labelOptions' => ['class' => 'span1 control-label']]
]);

    echo $form->field($user, 'username');
    echo $form->field($user, 'password')->passwordInput();
    echo $form->field($user, 'email')->input('email');
    echo $form->field($user, 'firstname');
    echo $form->field($user, 'lastname');        
?>

<div class="form-group">
    <?=Html::label('Роля', 'role', [
        'class' => 'span1 control-label'
    ])?>
    <div class="span3">
        <?=Html::dropDownList('role', 1, [
            1 => 'Потребител',
            2 => 'Модератор',
            3 => 'Админ'
        ], [
            'class' => 'control-label'
        ])?>
    </div>
</div>

<div class="form-actions">
    <?=Html::submitButton('Добави', [
        'class' => 'btn btn-primary'
    ])?>
    <?=Html::button('Затвори', [
        'class' => 'btn btn-warning close-dialog'
    ])?>
</div>

<?php ActiveForm::end(); ?>
