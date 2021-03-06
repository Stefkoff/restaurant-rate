<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use dosamigos\google\places\Search;
use dosamigos\google\places\Place;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\Autocomplete;

use kartik\typeahead\Typeahead;

use app\components\GooglePlaces\assets\GoogleAssets;
use app\components\GooglePlaces\assets\GoogleAssetsEnd;
use yii\web\JsExpression;

GoogleAssets::register($this);
GoogleAssetsEnd::register($this);

//$search = new Search(['key' => 'AIzaSyBOHCLkfRYWN6Jpvz8l2P7zY-pTIABQ86o']);
//
//$result = $search->text('pizza stop silistra');
//
//$coord = new LatLng([
//    'lat' => $result['results'][0]['geometry']['location']['lat'],
//    'lng' => $result['results'][0]['geometry']['location']['lng']
//]);
//
//$marker = new Marker([
//    'position' => $coord,
//    'title' => 'Pizza'
//]);
//
//$map = new Map([
//    'center' => $coord,
//    'zoom' => 14
//]);
//
//$map->addOverlay($marker);
//
//echo $map->display();


?>
 
 <div class="row-fluid">
	<div id="map-canvas"></div> 
 </div>
 <br/><br>
 <form class="form-horizontal">
 <div class="row-fluid">
 	<div class="span3">
 		<?php 
 		echo '<label class="control-label">State</label>';  		
		echo AutoComplete::widget([
		    'name' => 'country control',
			'id' => 'google-search',
		    'clientOptions' => [
		        'source' => Yii::$app->urlManager->createAbsoluteUrl('admin/places/search'),
		    	'select' => new JsExpression("
		    			function(event, ui){
		    				console.log(ui.item);
		    				var a = ui.item;
		    				g.changeMap(a.lat, a.lng, a.address, a.id, a.type);
		    			}
		    			")
		    ],				
		]);
 		?>
 	</div> 	
 </div>
 <div class="row-fluid" id="place-info">
 	<?php 
 		echo Html::hiddenInput('name', null, [
 				'id' => 'place-name'
 		]);
 		echo Html::hiddenInput('id', null, [
 				'id' => 'place-id'
 		]);
 		echo Html::hiddenInput('name', null, [
 				'id' => 'place-type'
 		]);
 	?>
 </div> 
 </form>
 <script type="text/javascript">     
     var sock = new Socket({
         socketIp: '<?= Yii::$app->params['socketIpAddress']?>'
     });
 </script>
