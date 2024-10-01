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
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9243.364868170222!2d105.93874892983038!3d21.012518988733117!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a8c5b4f1deff%3A0x27e57979c5d3de97!2zQuG7h25oIHZp4buHbiDEkGEga2hvYSBHaWEgTMOibQ!5e1!3m2!1svi!2s!4v1725546065835!5m2!1svi!2s" width="full" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <!-- <div id="map"></div> -->
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