<?php
    session_start();
    if (!isset($_SESSION['session_username']))
    header("location: login.php");
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
    <body>       
        <?php  include "header1.html" ?> 

        <!-- menubar-section-starts -->
        <div class="menu-bar">
            <div class="container">
                <div class="top-menu">
                    <ul>
                        <li class="active"><a href="index_man.php">ΑΡΧΙΚΗ</a></li>|
                        <li><a href="stock.php">ΑΠΟΘΕΜΑΤΑ</a></li>|
                        <li><a href="inprogress.php">ΕΚΡΕΜΕΙΣ ΠΑΡΑΓΓΕΛΙΕΣ</a></li>
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
                        <h1>Καλώς ήλθατε στα Foody </h1>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <br>

        <div>
            <h1>Ενημερώστε εύκολα κι γρήγορα τα αποθέματα του καταστήματός σας.</h1>
            <h2>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ή </h2>
            <h1>Δείτε τις εκκρεμείς παραγγελίες για το κατάστημά σας.</h1>
        </div>

        <?php  include "footer1.html" ?> 
    </body>
</html>