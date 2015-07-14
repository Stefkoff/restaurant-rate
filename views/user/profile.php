<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Профил';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-profile">
    <div class="row">
        <div class="span6">
            <div class="row-fluid">
                <div class="span12">
                    <h1>
                        Вашият <?= Html::encode($this->title) ?>
                    </h1>
                    <i><?=Html::a('Редактирай', Url::toRoute(['user/edit', 'id' => $user->id]))?></i>
                </div>


        </div>
            <div class="row">
                <div class="span6">
                    Имена: <b><?=$user->firstname." ".$user->lastname?></b>

                </div>
                <div class="span6"> Email: <b><?=$user->email;?></b></div>
            </div>
    </div>
</div>


