<?php
  session_start(); 
  if (!isset($_SESSION['session_username']))
  header("location: login.php");
  require_once('connect.php');

  //energopoiisi delivera kai kataxorisi topothesias tou
  $sql = "UPDATE deliveryman 
  SET deliveryman.status = 1 
  WHERE username = '" . $_SESSION['session_username'] ."'";
  $result = $mysql_con->query($sql);


  $sql1 = "INSERT INTO timetable_del (username, start_shift ) 
    VALUES ( '" . $_SESSION['session_username'] ."', now() )";
  $result = $mysql_con->query($sql1);
 
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Τοποθεσία</title>
        <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery.min.js"></script>
        <!-- Custom Theme files -->
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
        <!-- Custom Theme files -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

        <!--Animation-->
        <script src="js/wow.min.js"></script>
        <link href="css/animate.css" rel='stylesheet' type='text/css' />
        <script>
	    new WOW().init();
        </script>
        <script src="js/simpleCart.min.js"> </script>
        <script type="text/javascript" src="js/move-top.js"></script>
        <script type="text/javascript" src="js/easing.js"></script>
        <script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
				});
			});
        </script>
    <style>
      #myMap {
      height: 350px;
      width: 450px;
      }

      .button {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 16px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        -webkit-transition-duration: 0.4s; /* Safari */
        transition-duration: 0.4s;
        cursor: pointer;

        position: absolute;
        left: 50px;
        
      }

      .button1 {
        background-color: white;
        color: black;
        border: 2px solid #4CAF50;
      }

      .button1:hover {
        background-color: #4CAF50;
        color: white;
      }
    </style>
  </head>

  <body>
  <?php include "header1.html"; ?>
  <!-- menubar-section-starts -->
  <div class="menu-bar">
    <div class="container">
        <div class="login-section">
            <ul>
              <li><h3>Γειά σου <?php echo $_SESSION['session_username']; ?> </h3></li>
              <li><a href="logout.php">Αποσύνδεση</a></li>
              <div class="clearfix"></div>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
  </div>
  <!-- menubar-section-ends -->

  <br>
  <br>
  <br>

  <form action="del_address.php" method="post">
  <input name="address" id="address" required="required" size="40" type="text"  value="">
    <br>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDO7v1R4tM1KAOpeBb2if55y2O-t6B8ASo&sensor=false"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDO7v1R4tM1KAOpeBb2if55y2O-t6B8ASo&libraries=places"></script>
    <script type="text/javascript"> 
      var map;
      var marker;
      var myLatlng = new google.maps.LatLng(38.246640,21.734574);
      var geocoder = new google.maps.Geocoder();
      var infowindow = new google.maps.InfoWindow();


      function initialize(){
        var mapOptions = {
          zoom: 18,
          center: myLatlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById("myMap"), mapOptions);

        marker = new google.maps.Marker({
          map: map,
          position: myLatlng,
          draggable: true 
        }); 

        geocoder.geocode({'latLng': myLatlng }, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
              $('#latitude,#longitude').show();
              $('#address').val(results[0].formatted_address);
              $('#latitude').val(marker.getPosition().lat());
              $('#longitude').val(marker.getPosition().lng());
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
            }
          }
        });

        google.maps.event.addListener(marker, 'dragend', function() {
          geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              if (results[0]) {
                $('#address').val(results[0].formatted_address);
                $('#latitude').val(marker.getPosition().lat());
                $('#longitude').val(marker.getPosition().lng());
                infowindow.setContent(results[0].formatted_address);
                infowindow.open(map, marker);
              }
            }
          });
        });

        var search = document.getElementById('address');
        var autocomplete = new google.maps.places.Autocomplete(search);
        autocomplete.bindTo('bounds', map);

        google.maps.event.addListener(autocomplete, 'place_changed', function () {   
          geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) { 
            if (status == google.maps.GeocoderStatus.OK) {
              if (results[0]) {                 
                var place = autocomplete.getPlace();
            
                if (place.geometry.viewport) {
                  map.fitBounds(place.geometry.viewport);
                } else {
                  map.setCenter(place.geometry.location);
                }

                completeAddress = document.getElementById('address').value;
                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();

                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

                infowindow.setContent(completeAddress);
                infowindow.open(map, marker);
              }
            }
          });
        });
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </div>

  <div id="myMap"></div>
  <input type="hidden" name="latitude" id="latitude" placeholder="Latitude"></input>
  <input type="hidden" name="longitude" id="longitude" placeholder="Longitude"></input>
  <button class="button button1" id="button"> Επιβεβαίωση </button>
  </form> 
    <br>
    <br>
    <?php include "footer.html"; ?>
  </body>
  <p>
  </p>
</html>