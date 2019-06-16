<?php
include_once("api/parking.php");

$positions = getParkingLocs();
if (!isset($_SESSION['uid'])) {
    header("Location:index.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <title>ParkIt</title>

</head>
<body>
    <?php include_once("include/navbar.php"); ?>
    <table hidden>
    <?php while ($row = $positions->fetch_assoc()) : ?>
        <tr id="<?= $row['p_id']; ?>">
            <td class="lat"><?= $row['latitude']; ?></td>
            <td class="long"><?= $row['longitude']; ?></td>
        </tr>
    <?php endwhile; ?>
    </table>

<div style="width: 100%;height:700px; z-index: 9999;position: relative;" id="nearByParking"></div>
<script type="text/javascript" src="js/jquery-3.3.1.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>


<script>
    var map,infoWindow,currentMarker,destinationMarker,options,marker,infowindow;
    var content = "<button class='btn waves waves-effect' onclick='booking()'>Park Here</button>";

    function booking(){
      var tbody = $("tbody").children();
      $.each(tbody,function(data,val){
              $.each($(val).children(),function(data,val1){
                if($(val1).attr("class")=="lat")
                {
                    lat = $(val1).html();
                }
                if($(val1).attr("class")=="long")
                {
                    long = $(val1).html();
                }
              });
            });
            var location_details = {};
            location_details.uid = "<?php echo $_SESSION['uid']; ?>";
            location_details.latitude = lat;
            location_details.longitude = long;
            location_details.md_reg_no = "<?php echo $_POST['md_reg_no']; ?>";
          $.post("booking.php",{'details':location_details},function(page){
              console.log(page);
              window.location.href = "payment.php";
          });
      }

    function initMap() {

    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
      var x = "<?php echo $_POST["parking_source"]; ?>";

      $.getJSON('js/in.json',function(data){
        for (var i = 0 ; i < data.length ; i++){
          if (data[i]['city'] == x){
            var src_lat = parseFloat(data[i]['lat']);
            var src_lng = parseFloat(data[i]['lng']);
            };
          }

        options = {
            center:{lat:src_lat,lng:src_lng},
            zoom:14
        };
        map = new google.maps.Map(document.getElementById('nearByParking'),options);
        

        var marker = new google.maps.Marker({
            position:{lat:src_lat,lng:src_lng},
            map:map,
            icon:"assets/img/if_car-front-02_1988880.png",
        });

        function Distance(lat1, lon1, lat2, lon2)
        {
          var R = 6371; // km
          var dLat = toRad(lat2-lat1);
          var dLon = toRad(lon2-lon1);
          var lat1 = toRad(lat1);
          var lat2 = toRad(lat2);


          var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2);
          var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
          var d = R * c;
          return d;
        }

        // Converts numeric degrees to radians
        function toRad(Value)
        {
            return (Value * Math.PI / 180);
        }

        var p_marker;

        function addMarker(lat,lng) {
        // body...
            var dist = Distance(src_lat,src_lng,lat,lng);

            p_marker = new google.maps.Marker({
                position:{lat:lat,lng:lng},
                map:map,
                title:"Parking " + dist.toFixed(2).toString() + " KM",
                icon:"assets/img/if_parking_38117.png",
            });

        }

        infowindow = new google.maps.InfoWindow();

        google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){
            return function() {
                infowindow.setContent(content);
                infowindow.open(map,p_marker);
            };
        })(marker,content,infowindow));

        var latlng = new google.maps.LatLng(src_lat, src_lng);

        var geocoder = new google.maps.Geocoder();

        geocoder.geocode(
            {'latLng': latlng},
            function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            var add= results[0].formatted_address ;

                            var  value=add.split(",");

                            count=value.length;
                            country=value[count-1];

                            state=value[count-2];
                            city=value[count-3];
                            alert("City : " + city);
                        }
                        else  {
                            alert("Looks like you are lost.");
                        }
                }
                 else {
                    alert("Geocoder failed due to: " + status);
                }
            }
        );

        var tbody = $("tbody").children()
        var lat;
        var long;
        var p_id;
        var count = 0

        $.each(tbody,function(data,val){
                $.each($(val).children(),function(data,val1){
                    if($(val1).attr("class")=="lat"){
                        lat = $(val1).html();
                        count++;
                    }
                    else{
                        long = $(val1).html();
                        count++;
                    }
                    if(count == 2){
                        addMarker(parseFloat(lat),parseFloat(long));
                        count = 0;
                    }

                });

            });

          });
    }
    
    $("#logout_link").show();
    $("#login_link").hide();

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPbj_YTnp8rDJJSnlyExLlVwqfX10AJso
&callback=initMap"></script>

</body>
<?php include_once("include/footer.php"); ?>
</html>
