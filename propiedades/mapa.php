<?php
  $mapa = htmlentities($_GET['mapa']);
  $address = urlencode($mapa);
  $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=".$address;
  $response = file_get_contents($url);

  $json = json_decode($response,true);
  $lat = $json["results"][0]["geometry"]["location"]["lat"]; //OJO LOS PARAMETROS DENTRO DEL CORCHETE DEBEN ESTAR EN COMILLA SI NO NO FUNCIONA
  $lng = $json["results"][0]["geometry"]["location"]["lng"]; //OJO LOS PARAMETROS DENTRO DEL CORCHETE DEBEN ESTAR EN COMILLA SI NO NO FUNCIONA

  // echo $lat; //PRUEBA DE FUNCIONAMIENTO
  // echo '<br>'; //PRUEBA DE FUNCIONAMIENTO
  // echo $lng; //PRUEBA DE FUNCIONAMIENTO
?>

<!DOCTYPE html>
<html>
  <head>
    <style media="screen">
      html, body{
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map{
        height: 100%
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      function initMap() {
        var myLatLng = {lat: <?php echo $lat?>, lng: <?php echo $lng?>};

        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng,
          zoom: 17
        });

        // Create a marker and set its position.
        var marker = new google.maps.Marker({
          map: map,
          position: myLatLng,
          title: 'Hello World!'
        });
      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD5SDj-SNPqA6O9BDkgIK3NiD6Q78bO1sc&callback=initMap"
        async defer></script>
  </body>
</html>
