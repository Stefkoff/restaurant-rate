<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\GooglePlaces\GooglePlace;


$this->title = 'Потребители';
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?=$this->title?></h1>
<br/><br/>
<?=Html::a('Нов', Url::toRoute('users/new'), [
    'class' => 'btn btn-primary open-dialog'
])?>
<br/><br/>
<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [        
        'username',
        'email',
        'firstname', 
        'lastname',
        ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
    ]
]);

echo  GooglePlace::widget();

?>

<script type="text/javascript">
            $(document).ready(function() {                
                
                $(document).controls();
                
            });
</script>
