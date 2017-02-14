 
console.log("dasd");
var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 14.596116, lng: 121.027279},
          zoom: 13,
          streetViewControl: false,
          styles: [
  {
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#242f3e"
      }
    ]
  },
  {
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#746855"
      }
    ]
  },
  {
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#242f3e"
      }
    ]
  },
  {
    "featureType": "administrative.locality",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#d59563"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#d59563"
      }
    ]
  },
  {
    "featureType": "poi.attraction",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "poi.business",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "poi.government",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "poi.medical",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "poi.medical",
    "elementType": "geometry",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#263c3f"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#6b9a76"
      }
    ]
  },
  {
    "featureType": "poi.place_of_worship",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "poi.school",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "poi.sports_complex",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#38414e"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#212a37"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#9ca5b3"
      }
    ]
  },
  {
    "featureType": "road.arterial",
    "stylers": [
      {
        "visibility": "on"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#746855"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#1f2835"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "labels.text",
    "stylers": [
      {
        "weight": 1.5
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#f3d19c"
      }
    ]
  },
  {
    "featureType": "road.local",
    "stylers": [
      {
        "visibility": "simplified"
      }
    ]
  },
  {
    "featureType": "road.local",
    "elementType": "labels.text",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "transit",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#2f3948"
      }
    ]
  },
  {
    "featureType": "transit.station",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#d59563"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#17263c"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#515c6d"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#17263c"
      }
    ]
  }
]
        });


  var flightPlanCoordinates = [
          {lat: 14.657238, lng: 121.000392},
          {lat: 14.657561, lng: 121.021185},
          {lat: 14.655412, lng: 121.030133},
          {lat: 14.632978, lng: 121.044917},
          {lat:  14.599591, lng:121.059680},
          {lat: 14.596684, lng:121.059508},
          {lat: 14.592697, lng: 121.058393},
          {lat:14.584225, lng:121.055646},
          {lat:14.570768, lng: 121.046634},
          {lat: 14.563624, lng: 121.044316},
          {lat:14.540694, lng: 121.017709},
          {lat:14.537371, lng: 121.000628},
          {lat: 14.535377, lng: 120.984321}
        ];
        var flightPath = new google.maps.Polyline({
          path: flightPlanCoordinates,
          geodesic: true,
          strokeColor: '#42f46e',
          strokeOpacity: 1.0,
          strokeWeight: 5
        });

flightPath.setMap(map);

function CenterControl(controlDiv, map) {

        // Set CSS for the control border.
        var controlUI = document.createElement('div');
        controlUI.style.backgroundColor = 'rgba(255,255,255,0.7)';
        controlUI.style.border = '10% solid rgba(255,255,255,0.7)';
        controlUI.style.width="35rem"; 
        controlUI.style.borderRadius = '10px';
        controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.5)';
        controlUI.style.cursor = 'pointer';
        controlUI.style.marginRight = '10rem';
        controlUI.style.marginTop= '15rem';
        
        controlUI.title = 'UPDATES OF EDSA';
        controlDiv.appendChild(controlUI);

        // Set CSS for the control interior.
        var controlText = document.createElement('div');
        controlText.style.color = 'rgb(25,25,25)';
        controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlText.style.fontSize = '16px';
        controlText.style.padding = '20px';
     
        var html = "<b> Updates </b>"+
        "<br>TRAFFIC FACTORS<br><p class='textAlign:left;'>Traffic factors affecting the forecasts and their corresponding weights</p>"+
        "<br><ul>"+
        "<li>Weather - 30%</li></ul><br> Confidence Factor: 87%"
        controlText.innerHTML = html;
        controlUI.appendChild(controlText);

        // Setup the click event listeners: simply set the map to Chicago.
        controlUI.addEventListener('click', function() {
          
        });

      }
        var centerControlDiv = document.createElement('div');
        var centerControl = new CenterControl(centerControlDiv, map);
        centerControlDiv.index = 1;
        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(centerControlDiv);
      


	var icon = {
		url: "img/hexagon-512.png", // url
		scaledSize: new google.maps.Size(25, 25), // scaled size
		origin: new google.maps.Point(0,10), // origin
		anchor: new google.maps.Point(0, 0) // anchor
	};

	

function setShops(){
	$.get('php/getshops.php',{request : "shops"},function(data){
		$.each(data, function(i, item){
			var markerpos={
				lat:parseFloat(item[1]),
				lng:parseFloat(item[2])
			};
			
			console.log(markerpos);
			marker = new google.maps.Marker({
				map: map,
				draggable: false,
				animation: google.maps.Animation.DROP,
				position: markerpos,
				icon:icon
			});
				
			  var infowindow = new google.maps.InfoWindow({
				content: "<i class='glyphicon glyphicon-road' style='font-size:22px;vertical-align:bottom;'></i> <strong>"+item[0]+"</strong>"
				});
				
			marker.addListener('click', function(){
				showShop(item[3]);
			});
			
			marker.addListener('mouseover', function(){
				infowindow.open(map,this);
			});
			
			marker.addListener('mouseout', function(){
				infowindow.close();
			});
			
			
		});
	},'json').fail(function(data){
    console.log(data);
  });
}


