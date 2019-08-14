<?php
    session_start();
    if (!isset($_SESSION['session_username']))
    header("location: login.php");
    include "connect.php";

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Αρχική</title>
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
    </head>

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
            
        </style>

    <body>
        
        <?php  include "header1.html" ?> 

        <!-- menubar-section-starts -->
        <div class="menu-bar">
            <div class="container">
                <div class="top-menu">
                    <ul>
                        <li class="active"><a href="index_del.php">ΑΡΧΙΚΗ</a></li>|
                        <li><a href="showorder.php">ΠΑΡΑΓΓΕΛΙΑ</a></li>
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
        
        <div class="banner wow fadeInUp" data-wow-delay="0.4s" id="Home">
            <div class="container">
                <div class="banner-info">
                    <div class="banner-info-head text-left wow fadeInLeft" data-wow-delay="0.5s">
                        <h1>Καλώς ήλθατε στα  </h1>
                        <h1>Foody </h1>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <br>
            <br>
            <br>
            <?php
                //an einai apenergopoiimeni i vardia tou
                $sql = "SELECT * FROM deliveryman WHERE username = '".$_SESSION['session_username']."' ";
                $result = $mysql_con->query($sql);
                $row = mysqli_fetch_array($result);
                $del_username = $row["username"];

                if($row['status']==0 && $row['lat'] == 0 && $row['lng'] == 0) {
            ?>
             
            <h3> &nbsp &nbsp &nbsp  Έναρξη Βάρδιας</h3>
            <a href="location.php">
                <input class="button button1" type="button"  name="activation" id="activation" value="Ενεργοποίηση">
                <?php //header("location: location.php");
                 ?>
            </a>

            <br>
            <br>
            <br>
            <br>

            <?php
                }else{ //an einai energopoiimenos
                    echo "&nbsp &nbspΜην παραλείψετε να αποσυνδεθείτε όταν τελειώσει η βάρδιά σας. <br>";
                    echo "&nbsp &nbspΠαρακαλώ, να ανανεώνετε την σελίδα ΠΑΡΑΓΓΕΛΙΕΣ<br>&nbsp &nbsp για να ενημερώνεστε για νέα ανάθεση παραγγελίας. <br><br>";
                }
            

                $today = date("Y-m-d");
                //echo $today; 

                $sql = "SELECT * FROM timetable_del WHERE username = '".$_SESSION['session_username']."' ";
                $result = $mysql_con->query($sql);
                $totalseconds = 0;
                $flag = 0;

                
                while($row = mysqli_fetch_array($result)){  //για κάθε γραμμή του πίνακα με το σωστό username
                    $shift = date("Y-m-d", strtotime($row["start_shift"]));

                    if ($shift === $today){ //για κάθε γραμμή του πίνακα με το σωστό username και σημερινη ημερομηνία 

                        $flag = 1;
                        $time1 = $row["start_shift"];
                        $time2 = $row["end_shift"];
                        $totalseconds = $totalseconds + (strtotime($time2) - strtotime($time1)); //αθροισμα δευτερολέπτων προηγούμενων βαρδιων ίδιας ημέρας 
                    
                    }
                }

                if ($flag = 0){

                    echo "<br>&nbsp &nbspΔεν έχετε εργαστεί ακόμα.";

                }else{

                    echo "<br>&nbsp &nbsp Σήμερα, μέχρι στιγμής, έχετε: <br>";

                    $sql = "SELECT * FROM timetable_del WHERE username = '".$_SESSION['session_username']."' ORDER BY aa_key DESC limit 1 "; 
                    $result = $mysql_con->query($sql);
                    $row = mysqli_fetch_array($result);

                    $hours = $totalseconds/3600;
                    $hours = floor($hours);

                    $minutes = ($totalseconds/60) - ($hours * 3600);
                    $minutes = floor($minutes);

                    $seconds = $totalseconds - ($hours * 3600) - ($minutes * 60);     

                    echo "&nbsp &nbsp Εργαστεί: ".$hours." ώρες, ".$minutes." λεπτά και ".$seconds." δευτερόλεπτα.<br>";
                    echo "&nbsp &nbsp (οι ώρες ανανεώνονται με κάθε νέα σύνδεση)<br>";   
                    
                    
                    $routes = 0;
                    $klm = 0;
                    $sql = "SELECT * FROM orders WHERE deliveryman = '".$_SESSION['session_username']."' AND order_date = '".$today."' ";
                    $result = $mysql_con->query($sql);
                   
                    while($row = mysqli_fetch_array($result)){  //για κάθε γραμμή του πίνακα με το σωστό username και ημερομηνια σημερινη 
                        $routes ++;
                        $klm = $klm + $row["klm_route1"] + $row["klm_route2"];
                    }
                   

                    echo "&nbsp &nbsp Εκτελέσει: ".$routes." διαδρομές.<br>";
                    echo "&nbsp &nbsp Διανύσει: ".$klm." μέτρα.<br>";

                    $hoursalary = (5 * $hours) + ( 0.05 * $minutes) + ( 0.0008333333 * $seconds); // ωριαίος μισθός 
                    $hoursalary = floor ($hoursalary * 100) /100;
                    $klmsalary = $klm * 0.0001 ; //γιατι το google maps μετράει σε μέτρα όχι χλμ
                    $klmsalary = floor ($klmsalary * 100) /100;
                    $salary = $hoursalary + $klmsalary;
                    $salary = floor ($salary * 100) /100;
                    $sql = "UPDATE deliveryman SET salary_perday = '".$salary."'   WHERE username = '" . $_SESSION['session_username'] ."'";
                    $result = $mysql_con->query($sql);

                
                    echo "&nbsp &nbsp Η αμοιβή σας για: <br> &nbsp &nbsp τις ώρες εργασίας σας είναι ".$hoursalary." €. <br>";
                    echo "&nbsp &nbsp  τα χιλιόμετρα που έχετε διανύσει είναι ".$klmsalary." €. <br>";
                    echo "&nbsp &nbsp Η συνολική αμοιβή σας είναι ".$salary." €. <br>";
                } 

            ?>

        </div>
        
         <!-- <?php  include "footer1.html" ?>  

    </body>
</html>