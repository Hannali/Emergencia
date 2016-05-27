Emergencia = 
{
	map: false,
	origin: false,
	icon : 'http://localhost/icon_maps/soccer.png',
	center: false,
	ltC: 28.6419328,
	lgC: -106.09229871,
	bounds:false,	
	minZoom: 14,
	rectangle: false,
	id: false,
	markers:[],
	markersArray: [],
	lastMarker: false,

	init: function()
	{
		if($('#map-canvas').html())
		{
			Emergencia.map.setZoom(Emergencia.minZoom);
			Emergencia.deleteOverlays();
		}
		else
		{			
			Emergencia.id = (new Date()).getTime();
			var id = Emergencia.id;
		
			$('#map-canvas').html('<div id="map-canvas_'+id+'"></div>');
			$('#map-canvas_'+id).css({
				'width': '100%',
				'height': "400px",
				'-webkit-transform': 'inherit',
				'position': 'relative'
			});
			
			Emergencia.map = new google.maps.Map(document.getElementById('map-canvas_' + id),{
				zoom: Emergencia.minZoom,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				panControl: false
			});

			//Emergencia.limitMap();
		}
	},
	
	styles:function(){},
	
	createMarkers: function(){
		Emergencia.init();
	},
	
	addInfoMarkers: function(markers)
	{
		$("#directionsPanel").html('');
		Emergencia.init();	
		Emergencia.markers = markers;
		Emergencia.map.setCenter(Emergencia.center);
		$.each(markers, function(id,marker) {
			Emergencia.infoMarker(marker);
		});	
	},
	
	infoMarker: function(i)
	{
		
		var mark = new google.maps.LatLng(i[0], i[1]);

		var infowindow = new google.maps.InfoWindow({
			content: '<div ><div id="siteNotice"><a style="cursor:pointer;color:#2DC66E"><b>'+i[4]+'</b></a></div><div id="bodyContent">' + i[2] +' <a class="blue btn white-text text-white" onclick="Emergencia.howToGet('+i[0]+','+i[1]+')">Como llegar</a></div>'
		});
		
		var m = new google.maps.Marker({
			position: mark,
			map: Emergencia.map,
			title: i[4]
		});
		Emergencia.markersArray.push(m);
		google.maps.event.addListener(m, 'click', function() {
			infowindow.open(Emergencia.map,m);
		});
	},
	
	addMarker: function(lt,lg,i)
	{
		Emergencia.ltC = lt ? lt : Emergencia.ltC;
		Emergencia.lgC = lg ? lg : Emergencia.lgC;
		i = i ? i : urlAbsolute + 'app/views/images/icons/marker.png';
		
		Emergencia.init();
		Emergencia.center = new google.maps.LatLng(Emergencia.ltC, Emergencia.lgC),
		Emergencia.map.setCenter(Emergencia.center);
		
		marker = new google.maps.Marker({
			map:Emergencia.map,
			draggable:true,
			animation: google.maps.Animation.DROP,
			position: Emergencia.center,
			icon: i
		  });
		Emergencia.markersArray.push(marker);
		Emergencia.lastMarker = marker;
		google.maps.event.addListener(marker, 'click', Emergencia.initMarker);
		google.maps.event.addListener(marker, 'drag', Emergencia.dragMarker);
	},
	
	dragMarker: function(m)
	{
		var c = m.latLng;
		if (Emergencia.bounds.contains(c))
		{
			$('#id_localizacion').val(c.ob + '/' +  c.pb);
		}else
		{
			var r = Emergencia.limitPosition(c.lng(), c.lat());
			$('#id_localizacion').val(r.ob + '/' +  r.pb);
			Emergencia.lastMarker.setPosition(r);
		}
	},
	
	limitPosition:function(x, y)
	{
		var N = Emergencia.bounds.getNorthEast(),
			S = Emergencia.bounds.getSouthWest();
		
		if (x < S.lng())x = S.lng();
		if (x > N.lng())x = N.lng();
		if (y < S.lat())y = S.lat();
		if (y > N.lat())y = N.lat();
		return new google.maps.LatLng(y, x);
	},
	
	initMarker: function()
	{
		if (marker.getAnimation() != null)
			marker.setAnimation(null);
		else
			marker.setAnimation(google.maps.Animation.BOUNCE);
	},
	
	setOrigin: function(obj, lt, lg)
	{
		
		if(navigator.geolocation)
			navigator.geolocation.getCurrentPosition(
				function(position){
					var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
					Emergencia.origin = pos;
					
					if(obj && lt && lg)
						obj.init(lt, lg);	
				}
			);
		else
			Emergencia.origin = new google.maps.LatLng(28.6419328, -106.09229871);
	},

	howToGet: function(lt, lg)
	{
		Emergencia.setOrigin({
			init: function(lt, lg)
			{
				Emergencia.init();
				var request = {
					origin: Emergencia.origin,
					destination: new google.maps.LatLng(lt, lg),
					travelMode: google.maps.TravelMode.DRIVING
				};
			
				var ds = new google.maps.DirectionsService();
				var dd = new google.maps.DirectionsRenderer();

				Emergencia.markersArray.push(dd);

				dd.setMap(Emergencia.map);
				$("#directionsPanel").html('<button style="margin:0px" class="btn blue f" onclick="Emergencia.addInfoMarkers(Emergencia.markers)">Regresar</button>');
				dd.setPanel(document.getElementById("directionsPanel"));
			
				ds.route(request, function(result, status) 
				{
					if (status == google.maps.DirectionsStatus.OK)
					{
						dd.setDirections(result);
					}
				});
			}
		}, lt, lg);
	},
	
	limitMap: function() 
	{				
		google.maps.event.addListener(Emergencia.map, 'drag', function() {
			var c = Emergencia.map.getCenter();
			
			if (Emergencia.bounds.contains(c)) 
				return;
			Emergencia.map.setCenter(Emergencia.limitPosition(c.lng(), c.lat()));
		});

		Emergencia.rectangle = new google.maps.Rectangle({
			bounds: Emergencia.bounds,
			strokeColor: '#252525',
			strokeOpacity: .9,
			strokeWeight: 1,
			fillColor: '#000',
			fillOpacity: 0.01,
			editable: false,
			draggable: false
		});

		Emergencia.rectangle.setMap(Emergencia.map);
		google.maps.event.addListener(Emergencia.map, 'zoom_changed', function(){
			if (Emergencia.map.getZoom() < Emergencia.minZoom) 
				Emergencia.map.setZoom(Emergencia.minZoom);
		});
	},
	
	deleteOverlays: function() 
	{
		for (var i = 0; i < Emergencia.markersArray.length; i++) {
			Emergencia.markersArray[i].setMap(null);
		}
		Emergencia.markersArray = [];
	}
}