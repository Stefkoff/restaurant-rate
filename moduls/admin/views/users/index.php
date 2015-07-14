<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use dosamigos\google\places\Search;
use dosamigos\google\places\Place;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;

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

$search = new Search(['key' => 'AIzaSyBOHCLkfRYWN6Jpvz8l2P7zY-pTIABQ86o']);

$result = $search->text('pizza stop silistra');

$coord = new LatLng([
    'lat' => $result['results'][0]['geometry']['location']['lat'],
    'lng' => $result['results'][0]['geometry']['location']['lng']
]);

$marker = new Marker([
    'position' => $coord,
    'title' => 'Pizza'
]);

$map = new Map([
    'center' => $coord,
    'zoom' => 14
]);

$map->addOverlay($marker);

echo $map->display();


?>

<script type="text/javascript">
            $(document).ready(function() {                
                
                $(document).controls();
                
            });
</script>
