<?php 
    session_start(); 
    if (!isset($_SESSION['session_email']))
    header("location: login.php");
    require_once('connect.php');

    $sql = "SELECT * FROM stock_price ";
    $result = $mysql_con->query($sql);
    $row = mysqli_fetch_assoc($result);
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
    </head>
    <body>

        <?php  include "header1.html" ?> 
        
        <!-- menubar-section-starts -->
        <div class="menu-bar">
            <div class="container">
                <div class="top-menu">
                    <ul>
                        <li><a href="index_cust.php">ΑΡΧΙΚΗ</a></li>|
                        <li class="active"><a href="order.php">ΠΑΡΑΓΓΕΛΙΑ</a></li>|
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
            right: 200px;
            
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
        
        .quantity {
            width: 50px;

        }
    
        </style>

    <!-- content-section-starts -->
    <div class="orders">
        <div class="container">
            <div class="order-top">
                <li class="item-lists">
                    <h4>Καφέδες</h4>
                    <p> Ελληνικός </p>
                    <P> Φραπές </P>
                    <P> Espresso </P>
                    <P> Cappuccino </P>
                    <P> Φίλτρου </P>
                </li>
                <li class="item-lists">
                    <form action="checkout.php" method="post">
                        <div class="special-info grid_1 simpleCart_shelfItem">
                            <h4>Τιμή</h4>
                            <div class="pre-top">
                                <div class="pr-left">
                                    <div class="item_add"><span class="item_price"><h6>
                                    <?php  
                                            echo $row["p_greek_coffee"]; 
                                            echo " €";
                                    ?>
                                    </h6></span></div>
                                
                                </div>
                                <div class="pr-right" >
                                    <input class="quantity" type="number" min="0" name="q_greek_coffee" id="q_greek_coffee" value="0">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="pre-top">
                                <div class="pr-left">
                                    <div class="item_add"><span class="item_price"><h6>
                                    <?php 
                                            echo $row["p_frape_coffee"]; 
                                            echo " €";
                                    ?>
                                    </h6></span></div>
                                </div>
                                <div class="pr-right" >
                                    <input class="quantity" type="number" min="0" name="q_frape_coffee" id="q_frape_coffee" value="0">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="pre-top">
                                <div class="pr-left">
                                    <div class="item_add"><span class="item_price"><h6>
                                    <?php 
                                            echo $row["p_espresso_coffee"]; 
                                            echo " €";
                                    ?>
                                    </h6></span></div>
                                </div>
                                <div class="pr-right" >
                                    <input class="quantity" type="number" min="0" name="q_espresso_coffee" id="q_espresso_coffee" value="0">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="pre-top">
                                <div class="pr-left">
                                    <div class="item_add"><span class="item_price"><h6>
                                    <?php 
                                            echo $row["p_cappuccino_coffee"]; 
                                            echo " €";
                                    ?>
                                    </h6></span></div>
                                </div>
                                <div class="pr-right" >
                                    <input class="quantity" type="number" min="0" name="q_cappuccino_coffee" id="q_cappuccino_coffee" value="0">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="pre-top">
                                <div class="pr-left">
                                    <div class="item_add"><span class="item_price"><h6>
                                    <?php 
                                            echo $row["p_filtered_coffee"]; 
                                            echo " €";
                                    ?>
                                    </h6></span></div>
                                </div>
                                <div class="pr-right" >
                                    <input class="quantity" type="number" min="0" name="q_filtered_coffee" id="q_filtered_coffee" value="0">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </li>
                    <div class="clearfix"></div>
                </div>
                <div class="order-top">
                
                    <li class="item-lists">
                        <h4> Φαγητά </h4>
                        <p> Τυρόπιτα </p>
                        <p> Χορτόπιτα </p>
                        <p> Κουλούρι </p>
                        <p> Τόστ </p>
                        <p> Κέικ </p>
                    </li>
                    <li class="item-lists">
                        <div class="special-info grid_1 simpleCart_shelfItem">
                            <h4>Τιμή</h4>
                            <div class="pre-top">
                                <div class="pr-left">
                                    <div class="item_add"><span class="item_price"><h6>
                                    <?php 
                                            echo $row["p_cheese_pie"]; 
                                            echo " €";
                                    ?>

                                    </h6></span></div>
                                </div>
                                <div class="pr-right" >
                                    <input class="quantity" type="number" min="0" name="q_cheese_pie" id="q_cheese_pie" value="0">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="pre-top">
                                <div class="pr-left">
                                    <div class="item_add"><span class="item_price"><h6>
                                    <?php 
                                            echo $row["p_green_pie"]; 
                                            echo " €";
                                    ?>
                                    </h6></span></div>
                                </div>
                                <div class="pr-right">
                                    <input class="quantity" type="number" min="0" name="q_green_pie" id="q_green_pie" value="0">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="pre-top">
                                <div class="pr-left">
                                    <div class="item_add"><span class="item_price"><h6>
                                    <?php 
                                            echo $row["p_bagel"]; 
                                            echo " €";
                                    ?>

                                    </h6></span></div>
                                </div>
                                <div class="pr-right" >
                                <input class="quantity" type="number" min="0" name="q_bagel" id="q_bagel" value="0">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="pre-top">
                                <div class="pr-left">
                                    <div class="item_add"><span class="item_price"><h6>
                                    <?php 
                                            echo $row["p_tost"]; 
                                            echo " €";
                                    ?>
                                    </h6></span></div>
                                </div>
                                <div class="pr-right" >
                                <input class="quantity" type="number" min="0" name="q_tost" id="q_tost" value="0">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="pre-top">
                                <div class="pr-left">
                                    <div class="item_add"><span class="item_price"><h6>
                                    <?php 
                                            echo $row["p_cake"]; 
                                            echo " €";
                                    ?>
                                    </h6></span></div>
                                </div>
                                <div class="pr-right" >
                                    <input  class="quantity" type="number" min="0" name="q_cake" id="q_cake" value="0">
                                    
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </li>
                    <div class="clearfix"></div>
                    </div>
            </div>
            <br>
            <a href="checkout.php">
                <button class="button button1"> Έτοιμος-η </button>
            </a>
            <br>
        </form>
    </div>

    <br>
    <br>
    
        <?php  include "footer.html" ?> 
       
    </body>
</html>