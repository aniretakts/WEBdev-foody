<?php 
    session_start(); 
    if (!isset($_SESSION['session_email']))
    header("location: login.php");
    require_once('connect.php');

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Επιβεβαίωση Παραγγελίας</title>
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
        </style>
    </head>
    <body>
        
        <?php  include "header1.html" ?> 

        <!-- menubar-section-starts -->
        <div class="menu-bar">
            <div class="container">
                <div class="top-menu">
                    <ul>
                        <li><a href="index_cust.php" >ΑΡΧΙΚΗ</a></li>|
                        <li><a href="order.php">ΠΑΡΑΓΓΕΛΙΑ</a></li>|
                        <li><a href="stores.php">ΚΑΤΑΣΤΗΜΑΤΑ</a></li>
                        <div class="clearfix"></div>
                    </ul>
                </div>
                <div class="login-section">
                    <ul>
                        <li><h3>Γειά σου! </h3></li>
                        <li><a href="logout.php">Αποσύνδεση</a></li>
                        <div class="clearfix"></div>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- menubar-section-ends -->
        
        <style>
           
            .heading {
                font-size: 25px;
                color:#4CAF50;
                position:relative;
                left: 50px;
            }

            .rest {
                /*color:black;*/
                font-size: 15px;
                position:relative;
                left: 50px;    
            }

            .insidehead {
                font-size: 25px;
                color:#4CAF50;
                position:relative;
                left: 50px;
            }

            .button {
                font-size: 15px;
                position:relative;
                left: 50px;
                border: none;
                color: white;
                padding: 16px 32px;
                text-align: center;
                display: inline-block;
                margin: 4px 2px;
                -webkit-transition-duration: 0.4s; /* Safari */
                transition-duration: 0.4s;
                cursor: pointer;

                position: relative ; 
                background-color: white;
                color: black;
                border: 2px solid #4CAF50;
            }

                .button:hover {
                    background-color: #4CAF50;
                    color: white;
                }   
        </style>

        <div>
            <div>
                <br>
                <h1 class="heading">Το καλάθι σας περιέχει: </h1>
                <br>

                <?php
                    //upologismos telikou posou
                    $grcof_value = $_POST['q_greek_coffee'];
                    $frcof_value = $_POST['q_frape_coffee'];
                    $espcof_value = $_POST['q_espresso_coffee'];
                    $capcof_value = $_POST['q_cappuccino_coffee'];
                    $flcof_value = $_POST['q_filtered_coffee'];

                    $cheese_value = $_POST['q_cheese_pie'];
                    $green_value = $_POST['q_green_pie'];
                    $bagel_value = $_POST['q_bagel'];
                    $tost_value = $_POST['q_tost'];
                    $cake_value = $_POST['q_cake'];

                    $sql = "SELECT * FROM stock_price ";
                    $result = $mysql_con->query($sql);
                    $row = mysqli_fetch_assoc($result);
                    $grcof_price = $row["p_greek_coffee"] * $grcof_value;
                    $frcof_price = $row["p_frape_coffee"] * $frcof_value;
                    $espcof_price = $row["p_espresso_coffee"] * $espcof_value;
                    $capcof_price = $row["p_cappuccino_coffee"] * $capcof_value;
                    $flcof_price = $row["p_filtered_coffee"] * $flcof_value;
                    $cheese_price = $row["p_cheese_pie"] * $cheese_value;
                    $green_price = $row["p_green_pie"] * $green_value;
                    $bagel_price = $row["p_bagel"] * $bagel_value;
                    $tost_price = $row["p_tost"] * $tost_value;       
                    $cake_price = $row["p_cake"] * $cake_value;

                    $sum = $grcof_price + $frcof_price + $espcof_price + $capcof_price + $flcof_price + $cheese_price + $green_price + $bagel_price + $tost_price + $cake_price ;
                ?>
                
                <div>
                    <table class="rest">

                    <tr>
                        <th>Ελληνικός καφές: </th>
                        <th><?php echo $grcof_value ?></th>
                    </tr>

                    <tr>
                        <th>Φραπές: </th>
                        <th><?php echo $frcof_value ?></th>
                    </tr>

                    <tr>
                        <th>Espresso: </th>
                        <th><?php echo $espcof_value ?></th>
                    </tr>

                    <tr>
                        <th>Cappuccino:</th>
                        <th><?php echo $capcof_value ?></th>
                    </tr>

                    <tr>
                        <th>Καφές φίλτρου:</th>
                        <th><?php echo $flcof_value ?></th>
                    </tr>

                    <tr>
                        <th>Τυρόπιτα:</th>
                        <th><?php echo $cheese_value ?></th>
                    </tr>

                    <tr>
                        <th>Χορτόπιτα:</th>
                        <th><?php echo $green_value ?></th>
                    </tr>

                    <tr>
                        <th>Κουλούρι:</th>
                        <th><?php echo $bagel_value ?></th>
                    </tr>

                    <tr>
                        <th>Τόστ: </th>
                        <th><?php echo $tost_value ?></th>
                    </tr>

                    <tr>
                        <th>Κέικ: </th>
                        <th><?php echo $cake_value ?></th>
                    </tr>
                    </table>
                    
                
                </div>
                <br>

                <h2 class="rest">Σύνολο: <?php echo $sum ?> € </h2>

            </div>
            <br>
            <form class="rest" action="checkorder.php" method="post">
                <tr><p style="font-size:25px; color:#4CAF50;">Στοιχεία Παράδοσης</p></tr>
                <br>
                <tr>
                    <p>Όνομα</p>
                    <td class="input"><input name="fname" id="fname" required="required" size="40" type="text" value=""></td>
                </tr>
                <tr>
                    <p>Επίθετο</p>
                    <td class="input"><input name="lname" id="lname" required="required" size="40" type="text" value=""></td>
                </tr>
                <tr>
                    <p>Όροφος</p>
                    <td class="input"><input name="floor" id="floor" required="required" size="40" type="text" value=""></td>
                </tr>
                <tr>
                    <p>Τηλέφωνο</p>
                    <td class="input"><input name="phone" id="phone" required="required" size="40" type="number" value=""></td>
                </tr>
                
                <tr>
                    <p>Διεύθυνση</p>
                    <td class="input"><input name="address" id="address" required="required" size="40" type="text"  value=""></td>
                </tr>
            <br>
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
        <input type="hidden" name="latitude" id="latitude" placeholder="Latitude"/>
        <input type="hidden" name="longitude" id="longitude" placeholder="Longitude"/>
        <input type="hidden" name="cost" id="cost" value = <?php echo $sum; ?> />
        <input type="hidden" name="cheese" id="cheese" value = <?php echo $cheese_value; ?> />
        <input type="hidden" name="green" id="green" value = <?php echo $green_value; ?> />
        <input type="hidden" name="bagel" id="bagel" value = <?php echo $bagel_value; ?> />
        <input type="hidden" name="tost" id="tost" value = <?php echo $tost_value; ?> />
        <input type="hidden" name="cake" id="cake" value = <?php echo $cake_value; ?> />

        <br>
        <br>
        <a>
            <button class="button" id="button"> Ολοκλήρωση παραγγελίας  </button>
        </a>
        </form>
        <br>

        <?php include "footer.html" ?> 
    </body>
</html>