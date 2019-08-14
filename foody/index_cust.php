<?php
    session_start();
    if (!isset($_SESSION['session_email']))
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
                        <li class="active"><a href="index.php">ΑΡΧΙΚΗ</a></li>|
                        <li><a href="order.php">ΠΑΡΑΓΓΕΛΙΑ</a></li>|
                        <li><a href="stores.php">ΚΑΤΑΣΤΗΜΑΤΑ</a></li>
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
        
        <div class="banner wow fadeInUp" data-wow-delay="0.4s" id="Home">
            <div class="container">
                <div class="banner-info">
                    <div class="banner-info-head text-left wow fadeInLeft" data-wow-delay="0.5s">
                        <h1>Καλώς ήλθατε στα Foody </h1>
                        <br>
                        <h2 style="color:whitesmoke;"> Τώρα μπορείτε να παραγγείλετε και on-line!</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- content-section-starts -->
        <div class="content">
            <div class="ordering-section" id="Order">
                <div class="container">
                    <div class="ordering-section-head text-center wow bounceInRight" data-wow-delay="0.4s">
                        <h3>Εύκολη και γρήγορη παραγγελία</h3>
                        <div class="dotted-line">
                            <h4>Σε μόνο 4 βήματα </h4>
                        </div>
                    </div>
                    <div class="ordering-section-grids">
                        <div class="col-md-3 ordering-section-grid">
                            <div class="ordering-section-grid-process wow fadeInRight" data-wow-delay="0.4s" ">
                                <i class="one"></i><br>
                                <i class="one-icon"></i>
                                <p>Σύνδεση </p>
                                <label></label>
                            </div>
                        </div>
                        <div class="col-md-3 ordering-section-grid">
                            <div class="ordering-section-grid-process wow fadeInRight" data-wow-delay="0.4s" ">
                                <i class="two"></i><br>
                                <i class="two-icon"></i>
                                <p>Επιλογή <span>προϊόντων</span></p>
                                <label></label>
                            </div>
                        </div>
                        <div class="col-md-3 ordering-section-grid">
                            <div class="ordering-section-grid-process wow fadeInRight" data-wow-delay="0.4s" ">
                                <i class="three"></i><br>
                                <i class="three-icon"></i>
                                <p>Επιβεβαίωση <span>παραγγελίας </span></p>
                                <label></label>
                            </div>
                        </div>
                        <div class="col-md-3 ordering-section-grid">
                            <div class="ordering-section-grid-process wow fadeInRight" data-wow-delay="0.4s" ">
                                <i class="four"></i><br>
                                <i class="four-icon"></i>
                                <p>Άνοιξε <span>στον διανομέα! </span></p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-section-ends -->

        <?php  include "footer.html" ?> 
    </body>
</html>