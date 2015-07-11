<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Профил';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-profile">
    <div class="row">
        <div class="col-lg-4">
            <h1><?=Html::encode($this->title) . ': ' . $user->username?></h1>
        </div>
        <div class="col-lg-8">
            <?=Html::a('Edit', Url::toRoute(['user/edit', 'id' => $user->id]))?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1">
            Email
        </div>
        <div class="col-md-1">
            <?=$user->email;?>
        </div>
    </div>
    <div class="row">        
        <div class="col-md-1">
            Firstname
        </div>
        <div class="col-md-1">
            <?=$user->firstname;?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1">
            Lastname
        </div>
        <div class="col-md-1">
            <?=$user->lastname;?>
        </div>
    </div>
</div>
