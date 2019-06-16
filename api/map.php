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
<nav>
    <div class="nav-wrapper">
        <a style="margin-left: 10px;" href="index.php" class="brand-logo">Google Map API</a>
        <ul class="right hide-on-med-and-down">
            <li><a>About Us</a></li>
            <li><a>Login</a></li>
        </ul>
    </div>
</nav>

<div style="width: 100%;height: 300px; z-index: 9999;position: relative;" id="nearByParking"></div>

<div class="container">
    <div class="row center-align">
        <div class="col s12 m12 l4">
            <h4>
                Real time Parking
            </h4>
        </div>

        <div class="col s12 m12 l4">
            <h4>
                Advance Booking Available
            </h4>
        </div>

        <div class="col s12 m12 l4">
            <h4>
                Book your Slot
            </h4>
        </div>
    </div>
</div>
<script>

    var map,infoWindow,currentMarker,destinationMarker,options;

    function initMap() {
        options = {
            center:{lat:19.0006,lng:73.1042},
            zoom:14
        };
        map = new google.maps.Map(document.getElementById('nearByParking'),options);

        var marker = new google.maps.Marker({
            position:{lat:19.0006,lng:73.1042},
            map:map,
            icon:"../assets/img/if_car-front-02_1988880.png",
        });
    }

    // Check if location is available from the browser itself

</script>
<script type="text/javascript" src="../js/jquery-3.3.1.min.js" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBIhPehYF5MkI8a4k6Q5Tw7mQKRgWZgeE0
&callback=initMap">
</script>
</body>
</html>