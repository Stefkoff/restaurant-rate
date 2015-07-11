<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Потребители';
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?=$this->title?></h1>
<br/><br/>
<a class="open-dialog" href="<?=Yii::$app->urlManager->createAbsoluteUrl('admin/users/view')?>">simple alert</a>
<br/><br/>
<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [        
        'username',
        'email',
        'firstname', 
        'lastname',
        ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}'],
    ]
]);
?>

<script type="text/javascript">
            $(document).ready(function() {                
                
                $(document).controls();
                
            });
</script>
