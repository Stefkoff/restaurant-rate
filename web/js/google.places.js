var GoogleMaps = {
	map: null,
	init: function(){
		this.map = new google.maps.Map(document.getElementById('map-canvas'), {
            zoom: 8,
            center: {lat: -34.397, lng: 150.644}
          });
	},
    
    setCenter: function(lat, lng){
    	this.map.setZoom(15);
    	var newLatLng = new google.maps.LatLng(-21.397, 160.644);
    	this.map.setCenter(newLatLng);
    },
    
    setMarckers: function(position, content){
    	
    	var marker = new google.maps.Marker({
    		position: new google.maps.LatLng(position.lat, position.lng),
    		map: this.map,
    		title: "opa"
    	});
    	
    	var info = new google.maps.InfoWindow({
    		content: content
    	});
    	
    	google.maps.event.addListener(marker, 'click', function(){
    		info.open(this.map, marker);
    	});
    }
};


/*
var GoogleMaps = false;

(function($){
    GoogleMaps = function(options){
        
        var map;
        var autocomplete;
        
        if(typeof options === "undifined"){
            var option = {};
        }
        
        this.init(options);
    };
    
    GoogleMaps.prototype = {
        init: function(options){        	
        	google.maps.event.addDomListener(window, 'load', this.initMap);        	
        	this.initAutocomplete(options);        	                                                
            this.addListeners();
        },
        
        addListeners: function(){
            $('#center-change').on('click', function(){                
                var newLatLng = new google.maps.LatLng(-21.397, 160.644);
                 map.setCenter(newLatLng);                 
            });
            
            $('#find-me').on('click', this.findMe);
        },
        
        findMe: function(){
        	if(navigator.geolocation){
        		navigator.geolocation.getCurrentPosition(function(position){
        			var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        			
        			map.setZoom(15);
        			map.setCenter(pos, 7);
        		});
        	}
        },
        
        initAutocomplete: function(options){
        	autocomplete = new google.maps.places.Autocomplete(document.getElementById('places'), {
        		types: ['geocode']
        	});
        	
        	google.maps.event.addListener(autocomplete, 'place_changed', this.placeChanged);
        },
        
        initMap: function(){
        	map = new google.maps.Map(document.getElementById('map-canvas'), {
                zoom: 8,
                center: {lat: -34.397, lng: 150.644}
              });
        },
        
        placeChanged: function(){
        	var newPlace = autocomplete.getPlace();
        	console.log(newPlace);
        	map.setCenter({lat:newPlace.geometry.location.A, lng:newPlace.geometry.location.F});        	
        },
        
        setCenter: function(lat, lng){
        	this.map.setZoom(15);
        	this.map.setCenter({lat, lng});
        },
        
        changeMap: function(lat, lng, address, id, type){
        	map.setZoom(15);
        	map.setCenter({lat, lng});
        	
        	$('#place-info').html('');
        	
        	$('<input>').attr({
        		type: 'hidden',
        		id: 'place-id',
        		name: 'place-id',
        		value: id
        	}).appendTo('#place-info');
        	        	
        	
        	var length = type.length;
        	
        	for(var i = 0; i < length; i++){
        		$('<input>').attr({
            		type: 'hidden',
            		id: 'place-type-' + i,
            		name: 'place-type-' + i,
            		value: type[i]
            	}).appendTo('#place-info');
        	}
        	
        	console.log(type);
        	
        }
    };
})(jQuery); */
