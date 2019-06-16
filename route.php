<?php
$veh = $_GET['veh_num'];
include_once("api/definations.php");
  
$sql = "select latitude,longitude from booking join slot_location where booking.slot_id=slot_location.slot_id and md_reg_no='".$veh."'";
$con = connection();
$result = $con->query($sql);
if ($result) {
  while($row = $result->fetch_assoc()) {
  $des_lat = $row['latitude'];
  $des_lon = $row['longitude'];
}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Directions Service</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
    </style>
  </head>
  <body>

      <p id="src_lat" hidden></p>
      <p id="src_lon" hidden></p>
    <div id="floating-panel">
      <button id="start" onclick="initMap()">Start</button>
      <button onclick="getLocation();" >Get Location</button>
      <button id="refresh" >Refresh</button>
    </div>
    <div id="map"></div>
    <script>
      var x = document.getElementById("src_lat");
      var y = document.getElementById("src_lon");


function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    x.innerHTML = position.coords.latitude;
    y.innerHTML = position.coords.longitude;
}
      
      function initMap() {
          var des_lat = "<?= $des_lat;?>";
          var des_lon = "<?= $des_lon;?>";

          var src_lat = parseFloat(document.getElementById("src_lat").innerHTML);
          var src_lon = parseFloat(document.getElementById("src_lon").innerHTML);
          console.log(src_lon);

        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: {lat: src_lat, lng: src_lon}
        });
        directionsDisplay.setMap(map);
        console.log(des_lat,des_lon,src_lat,src_lon);
          var onChangeHandler = function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        };
        document.getElementById('refresh').addEventListener('click', onChangeHandler);
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        
          var src_lat = document.getElementById("src_lat").innerHTML;
          var src_lon = document.getElementById("src_lon").innerHTML;
          var des_lat = "<?= $des_lat;?>";
          var des_lon = "<?= $des_lon;?>";
        directionsService.route({
          origin: new google.maps.LatLng(src_lat, src_lon),
          destination: new google.maps.LatLng(des_lat , des_lon),
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
      
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPbj_YTnp8rDJJSnlyExLlVwqfX10AJso">
    </script>
  </body>
</html>