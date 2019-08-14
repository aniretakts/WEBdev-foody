<?php 
    session_start(); 
    if (!isset($_SESSION['session_email']))
    header("location: login.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Καταστήματα</title>
    
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
        <!-- <link href="animate.css" rel='stylesheet' type='text/css' /> -->
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

    <body>
        <?php  include "header1.html" ?> 

        <!-- menubar-section-starts -->
        <div class="menu-bar">
            <div class="container">
                <div class="top-menu">
                    <ul>
                        <li><a href="index_cust.php">ΑΡΧΙΚΗ</a></li>|
                        <li><a href="order.php">ΠΑΡΑΓΓΕΛΙΑ</a></li>|
                        <li class="active"><a href="stores.php">ΚΑΤΑΣΤΗΜΑΤΑ</a></li>
                        <div class="clearfix"></div>
                    </ul>
                </div>
                <div class="login-section">
                    <ul>
                        <li><h3>Γειά σου!</h3></li>
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
        
        <!-- an prolavoume na ta kanoume meso tis vasis -->
        <div class="info">
            <div class="container">

                <div class="col-md-3 "> </div>

                <div class="col-md-3 ">
                    <h3 style="color:darkgoldenrod;">Κατάστημα 1</h3>
                    <p>Κανακάρη Ρούφου 5 </p>
                    <p>Τηλ. 2610 345432</p>
                </div>

                <br>
                <br>

                <div class="col-md-3 ">
                    <h3 style="color:darkgoldenrod;">Κατάστημα 2</h3>
                    <p>Πατρέως 26</p>
                    <p>Τηλ. 2610 234234</p>
                </div>

                <div class="col-md-3 "> </div>
            </div>

            <br>
            <br>

            <div class="container">

                <div class="col-md-3 "> </div>

                <div class="col-md-3 ">
                    <h3 style="color:darkgoldenrod;">Κατάστημα 3</h3>
                    <p>Αλεξανδρουπόλεως 43</p>
                    <p>Τηλ. 2610 454545</p>
                </div>

                <br>
                <br>

                <div class="col-md-3 ">
                    <h3 style="color:darkgoldenrod;">Κατάστημα 4</h3>
                    <p>Δημητρίου Γούναρη 100 </p>
                    <p>Τηλ. 2610 767676 </p>
                </div>

                <div class="col-md-3 "> </div>
            </div>
          
            <br>
            <br>

            <div class="container">

                <div class="col-md-3 "> </div>

                <div class="col-md-3 ">
                    <h3 style="color:darkgoldenrod;">Κατάστημα 5</h3>
                    <p>Ακρωτηρίου 45</p>
                    <p>Τηλ. 2610 987987</p>
                </div>

                <div class="col-md-6 "> </div>
            </div>
        </div>

        <br>
        <br>
        <br>     
       
        <?php  include "footer1.html" ?>       
    </body>
</html>