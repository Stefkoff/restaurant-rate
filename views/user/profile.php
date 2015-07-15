<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Профил';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row-fluid">
    <div class="user-profile">
        <div class="row">
            <div class="span6">
                <div class="row-fluid">
                    <div class="span12">
                        <h1>
                            <b><?=$user->firstname." ".$user->lastname?></b>


                        </h1>
                        <div class="span6"> Email: <b><?=$user->email;?></b></div>
                        <i class="fa fa-beer"></i>
                        <i><?=Html::a('Редактирай', Url::toRoute(['user/edit', 'id' => $user->id]))?></i>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>


