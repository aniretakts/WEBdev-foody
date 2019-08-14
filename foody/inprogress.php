<?php  
    session_start();
    if (!isset($_SESSION['session_username']))
    header("location: login.php");
    include "connect.php";

    //euresi katastimatos tou sugkekrimenou manager
    $sql="SELECT * FROM manager WHERE manager.username = '".$_SESSION['session_username']."' ";
    $result = $mysql_con->query($sql);
    $row = mysqli_fetch_array($result);
    $afm = $row['afm'];


    $sql="SELECT * FROM stores WHERE stores.manager_afm = '$afm' ";
    $result = $mysql_con->query($sql);
    $row = mysqli_fetch_array($result);
    $address = $row['address'];

    //euresi ton paraggelion tou katastimatos tou pou ekremoun
    $sql="SELECT * FROM orders WHERE orders.address_st = '$address' AND orders.status = 0 ";
    $result = $mysql_con->query($sql);
    $count=mysqli_num_rows($result);
    
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
        <title>Εκρεμείς Παραγγελίες</title>  
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
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
      <?php  include "header1.html" ?> 

        <!-- menubar-section-starts -->
        <div class="menu-bar">
            <div class="container">
                <div class="top-menu">
                    <ul>
                        <li><a href="index_man.php">ΑΡΧΙΚΗ</a></li>|
                        <li><a href="stock.php">ΑΠΟΘΕΜΑΤΑ</a></li>|
                        <li class="active"><a href="inprogress.php">ΕΚΡΕΜΕΙΣ ΠΑΡΑΓΓΕΛΙΕΣ</a></li>
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

        <?php
            if($count == 0) {
                echo "&nbsp &nbspΔεν υπάρχουν εκρεμείς παραγγελίες προς το παρόν για το κατάστημά σας.";
            }else{
        ?>

        <div class="container" style="width:800px;"> 
            <br>  
            <div class="table-responsive">  
                <table class="table table-bordered">  
                    <tr>  
                        <th width="70%">Όνομα Πελάτη</th>  
                        <th width="30%">Λεπτομέρειες</th>  
                    </tr>  
                    <?php  
                        while($row = mysqli_fetch_array($result)) 
                        {  
                    ?>  
                    <tr>  
                        <td> <?php echo $row["lname"]; ?> </td>  
                        <td><a href="#" class="hover" id="<?php echo $row["id"]; ?>"><?php echo "Προβολή"; ?></a></td>  
                    </tr>   
                    <?php  
                    }  
                    ?>  
                </table>  
            </div>  
        </div>

        <?php
            }
        ?>

        <?php include "footer1.html"; ?>
      </body>  
 </html>  
 
 <script>  
    //dunamiki emfanisi ton ekremon paraggelion meso ajax
    $(document).ready(function(){  
        $('.hover').popover({  
            title:fetchData,  
            html:true,  
            placement:'right'  
        });  
        function fetchData(){  
            var fetch_data = '';  
            var element = $(this);  
            var id = element.attr("id");  
            $.ajax({  
                    url:"select.php",  
                    method:"POST",  
                    async:false,  
                    data:{id:id},  
                    success:function(data){  
                        fetch_data = data;  
                    }  
            });  
            return fetch_data;  
        }  
    });  
 </script> 