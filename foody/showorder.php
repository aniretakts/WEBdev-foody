<?php
    session_start();
    if (!isset($_SESSION['session_username']))
    header("location: login.php");

    include "connect.php";

    $sql = "SELECT * FROM deliveryman WHERE deliveryman.username='".$_SESSION['session_username']."'";
    $result = $mysql_con->query($sql);
    $row = mysqli_fetch_array($result);
    $status = $row['status'];

    //an einai apenergopoiimeni i bardia tou
    if ($status == 0 && $row['lat'] == 0 && $row['lng'] == 0) {
        echo("<script>alert('Παρακαλώ ενεργοποιήστε τη βάρδιά σας.')</script>");
        echo("<script>window.location = 'index_del.php';</script>");
        return;
    }

    $lat_del = $row['lat'];
    $lng_del = $row['lng'];
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Παραγγελία</title>
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
                        <li><a href="index_del.php">ΑΡΧΙΚΗ</a></li>|
                        <li class="active"><a href="showorder.php">ΠΑΡΑΓΓΕΛΙΑ</a></li>
                        <div class="clearfix"></div>
                    </ul>
                </div>
                
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
    
        <?php
            //an einai diathesimos, vrisketai i nea diathesimi paraggelia pou vrisketai pio konta tou
            if($status == 1) {
                $sql="SELECT * FROM orders WHERE orders.status=0 AND deliveryman IS NULL";
                $result = $mysql_con->query($sql);
                $count=mysqli_num_rows($result);
                
                if ($count==0){ 
                    echo "&nbsp &nbspΔεν υπάρχει ακόμα κάποια παραγγελία. Παρακαλώ περιμένετε.";
                    include "footer1.html";
                } else {
                    $sql1 = "UPDATE deliveryman SET deliveryman.status = 0
                             WHERE username='".$_SESSION['session_username']."'";
                    $result1 = $mysql_con->query($sql1);

                    $minimumDist2 = 999999999999;
                    $index = "";

                    while($row = mysqli_fetch_array($result)){ 
                        $destinationLat = $row['lat_st'];  //του store
                        $destinationLng = $row['lng_st'];
                        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$lat_del.",".$lng_del."&destinations=".$destinationLat.",".$destinationLng."&key=AIzaSyDO7v1R4tM1KAOpeBb2if55y2O-t6B8ASo";
                        $json = file_get_contents($url);
                        $response_a = json_decode($json, true);
                        $dist = $response_a['rows'][0]['elements'][0]['distance']['value'];
                        if($dist<$minimumDist2){
                            $minimumDist2 = $dist;
                            $index = $row['lname']; //lastname of customer
                        }
                    }

                    $output = '';  

                    $sql = "SELECT * FROM orders WHERE lname ='".$index."' AND status = 0";  
                    $result = $mysql_con->query($sql);      
                    $row = mysqli_fetch_array($result);      
                    
                    $sql = "UPDATE orders 
                    SET klm_route2 = '".$minimumDist2."', deliveryman = '".$_SESSION['session_username']."'
                    WHERE lname='$index'";
                    $result = $mysql_con->query($sql);

                    $output .= '  
                    <div class="table-responsive">  
                        <table class="table table-bordered">';  
                    
                    
                        $output .= '  
                            <tr>  
                                <td width="30%"><label>Διεύθυνση Καταστήματος Παραλαβής</label></td>  
                                <td width="70%">'.$row["address_st"].'</td>  
                            </tr>
                            <tr>  
                                <td width="30%"><label>Όνομα Πελάτη</label></td>  
                                <td width="70%">'.$row["fname"].'</td>  
                            </tr>  
                            <tr>  
                            <td width="30%"><label>Επίθετο Πελάτη</label></td>  
                            <td width="70%">'.$row["lname"].'</td>  
                            </tr>  
                            <tr>  
                                <td width="30%"><label>Διεύθυνση Πελάτη</label></td>  
                                <td width="70%">'.$row["address_cust"].'</td>  
                            </tr>  
                            <tr>  
                                <td width="30%"><label>Όροφος </label></td>  
                                <td width="70%">'.$row["floor"].'</td>  
                            </tr>  
                            <tr>  
                                <td width="30%"><label>Τηλέφωνο Πελάτη</label></td>  
                                <td width="70%">'.$row["phone"].'</td>  
                            </tr>  
                            <tr>  
                                <td width="30%"><label>Συνολικό Κόστος</label></td>  
                                <td width="70%">'.$row["totalcost"].'</td>  
                            </tr>   
                            ';  
                    
                    $output .= "</table></div>";  
                    echo $output;  

                ?> 
                        <div id="myMap"></div>
                        <a href="orderdone.php">
                            <input class="button button1" type="button"  name="done" id="done" value="Ολοκλήρωση Παραγγελίας">
                        </a>
                <?php    
                    }
                } else { //an exei idi mia paraggelia na ektelesei, emfanizetai auti
                    $output = ''; 
                    $sql = "SELECT * FROM orders WHERE deliveryman ='".$_SESSION['session_username']."' AND orders.status = 0";  
                    $result = $mysql_con->query($sql);      
                    $row = mysqli_fetch_array($result);      

                    $output .= '  
                    <div class="table-responsive">  
                        <table class="table table-bordered">';  
                    
                    
                        $output .= '  
                            <tr>  
                                <td width="30%"><label>Διεύθυνση Καταστήματος Παραλαβής</label></td>  
                                <td width="70%">'.$row["address_st"].'</td>  
                            </tr>
                            <tr>  
                                <td width="30%"><label>Όνομα Πελάτη</label></td>  
                                <td width="70%">'.$row["fname"].'</td>  
                            </tr>  
                            <tr>  
                            <td width="30%"><label>Επίθετο Πελάτη</label></td>  
                            <td width="70%">'.$row["lname"].'</td>  
                            </tr>  
                            <tr>  
                                <td width="30%"><label>Διεύθυνση Πελάτη</label></td>  
                                <td width="70%">'.$row["address_cust"].'</td>  
                            </tr>  
                            <tr>  
                                <td width="30%"><label>Όροφος </label></td>  
                                <td width="70%">'.$row["floor"].'</td>  
                            </tr>  
                            <tr>  
                                <td width="30%"><label>Τηλέφωνο Πελάτη</label></td>  
                                <td width="70%">'.$row["phone"].'</td>  
                            </tr>  
                            <tr>  
                                <td width="30%"><label>Συνολικό Κόστος</label></td>  
                                <td width="70%">'.$row["totalcost"].'</td>  
                            </tr>   
                            ';  
                    
                    $output .= "</table></div>";  
                    echo $output;  
                ?> 
                    <div id="myMap"></div>
                    <a href="orderdone.php">
                        <input class="button button1" type="button"  name="done" id="done" value="Ολοκλήρωση Παραγγελίας">
                    </a>
                <?php
                    }
                ?>

            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDO7v1R4tM1KAOpeBb2if55y2O-t6B8ASo&sensor=false"></script>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDO7v1R4tM1KAOpeBb2if55y2O-t6B8ASo&libraries=places"></script>
            <script type="text/javascript"> 
                var map;
                var marker2;
                var marker3;
                var myLatlng2 = { lat: <?php echo $row['lat_st']; ?> , lng: <?php echo $row['lng_st']; ?>};
                var myLatlng3 = { lat: <?php echo $row['lat_cust']; ?>, lng: <?php echo $row['lng_cust']; ?>};
                var geocoder = new google.maps.Geocoder();
                var infowindow2 = new google.maps.InfoWindow();
                var infowindow3 = new google.maps.InfoWindow();

                function initialize(){
                    var mapOptions = {
                        zoom: 17,
                        center: myLatlng2,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };

                    map = new google.maps.Map(document.getElementById("myMap"), mapOptions);

                    marker2 = new google.maps.Marker({
                        map: map,
                        position: myLatlng2
                    });

                    marker3 = new google.maps.Marker({
                        map: map,
                        position: myLatlng3
                    }); 

                    geocoder.geocode({'latLng': myLatlng2 }, function(results, status) {                        
                        infowindow2.setContent("Τοποθεσία Καταστήματος");
                        infowindow2.open(map, marker2);
                    });

                    geocoder.geocode({'latLng': myLatlng3 }, function(results, status) {                        
                        infowindow3.setContent("Τοποθεσία Πελάτη");
                        infowindow3.open(map, marker3);
                    });
                }
                google.maps.event.addDomListener(window, 'load', initialize);
                </script>
        <br>
        <br>
        <br>

        <?php  include "footer.html"; ?> 
      
    </body>
</html>