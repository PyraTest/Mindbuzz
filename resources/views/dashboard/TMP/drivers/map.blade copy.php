<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Google Maps Multiple Markers Example - ItSolutionStuff.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <style type="text/css">
        #map {
          height: 500px;
        }
    </style>
</head>
    
<body>
    <div class="container mt-5">
        <h2>Laravel Google Maps Multiple Markers Example - ItSolutionStuff.com</h2>
        <div id="map"></div>
    </div>
    
    <script type="text/javascript">
        function initMap() {
            const myLatLng = { lat: 30.033333, lng: 31.233334 };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 5,
                center: myLatLng,
            });
  
            var locations = {{ Js::from($array) }};
  
            var infowindow = new google.maps.InfoWindow();
  
            var marker, i;
              
            for (i = 0; i < locations.length; i++) {  
                var icon = locations[i][3] || {};

                  marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    title: locations[i][0],
                    icon: icon.icon,
                    shadow: icon.shadow,
                    //visible: true,
                    //zIndex: i, 
                    //icon:locations[i][3],
                    //animation:google.maps.Animation.Drop,
                    //draggable: true

                  });

                  google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                      infowindow.setContent(locations[i][0]);
                      infowindow.open(map, marker);
                    }
                  })(marker, i));
  
            }
        }
  
        window.initMap = initMap;
    </script>
  
    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" ></script>
  
</body>
</html>