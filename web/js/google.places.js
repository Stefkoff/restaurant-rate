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
        }
    };
})(jQuery);
