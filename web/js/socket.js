var Socket = false;

(function($){
	Socket = function(options){            
		var _socket;
		var _map;
		
		this.init(options);
	};
	
	Socket.prototype = {
			init: function(options){
				
				_map = GoogleMaps;
				_map.init();
				
				_socket = new WebSocket('ws://' + options.socketIp + ':8080');
				
				_socket.onopen = this.onOpen;
				_socket.onmessage = this.onMessage;
			},
			
			setMap: function(map){
				_map = map;
			},
			
			onOpen: function(){
				console.log(1);
			},
			
			onMessage: function(e){				
				
				console.log(e.data);
				
				var data = JSON.parse(e.data);
				
				var length = data.length;
				
				for(var i = 0; i < length; i++){
					switch(data[i].type){
					case 'setCenter':
						_map.setCenter(data[i].value.lat, data[i].value.lng);					
						break;
					case 'setMarcker':
						
						var markersLen = data[i].value.length;
						
						for(var j = 0; j < markersLen; j++){
							position = {lat: data[i].value[j].lat, lng: data[i].value[j].lng};
							_map.setMarckers(position, data[i].value[j].content);							
						}											
					}
				}							
			}
	}
})(jQuery);




/*
var conn = new WebSocket('ws://192.168.0.12:8080');

conn.onopen = function(e){
	console.log('Connection established!');
}

conn.onmessage = function(e){
	var data = JSON.parse(e.data);
	
	
	
	switch(data.type){
	case 'setCenter':
		g.setCenter(data.value.lat, data.value.lng);
		break;
	}
	
	console.log(data.value.lat);	
}
*/
