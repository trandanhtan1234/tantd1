<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel - Google Maps</title>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <style type="text/css">
        #map {
          height: 400px;
        }
    </style>
</head>
    
<body>
    <div class="container mt-5">
        <h2>Laravel - Google Maps</h2>
        <div id="map"></div>
    </div>
  
    <script type="text/javascript">
        function initMap() {
            //You can change LAT and LNG according to you're requirement
          const latLng = { lat: 21.60476953235633, lng: 39.10753805227597 };
          const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 7,
            center: latLng,
          });
  
          new google.maps.Marker({
            position: latLng,
            map,
            title: "Welcome to Jeddah Corniche",
          });
        }
  
        window.initMap = initMap;
    </script>
  
    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" ></script>
  
</body>
</html>