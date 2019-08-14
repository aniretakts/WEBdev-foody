<?php session_start(); ?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>

    <?php
        include "connect.php";

        $rdb_value = $_POST['rdb'];

        if ( $rdb_value == "customer" ) //elegxos gia eisodo pelati
        {
            $email=$_POST['email-username']; 
            $mypassword=$_POST['password']; 
            
            $tbl_name="customer";
            $sql="SELECT * FROM $tbl_name WHERE customer.email='$email' AND customer.password='$mypassword'";
            $result = $mysql_con->query($sql);
            $count=mysqli_num_rows($result);

            if($count==1){
                $_SESSION['session_email'] = $email;
                header("location:index_cust.php");
            }
            else {
                echo("<script>alert('Κάτι πήγε λάθος. Παρακαλώ εισάγεται πάλι τα στοιχεία σας')</script>");
                echo("<script>window.location = 'login.php';</script>");
            }
        }elseif ( $rdb_value == "manager" ) //elegxos gia eisodo manager
        {
            $username=$_POST['email-username']; 
            $mypassword=$_POST['password']; 
            
            $tbl_name="manager";
            $sql="SELECT * FROM $tbl_name WHERE manager.username='$username' AND manager.password='$mypassword'";
            $result = $mysql_con->query($sql);
            $count=mysqli_num_rows($result);

            if($count==1){
                $_SESSION['session_username'] = $username;
                header("location:index_man.php");
            }
            else {
                echo("<script>alert('Κάτι πήγε λάθος. Παρακαλώ εισάγεται πάλι τα στοιχεία σας')</script>");
                echo("<script>window.location = 'login.php';</script>");
            }
        }else //elegxos gia eisodo delivera
        {
            $username=$_POST['email-username']; 
            $mypassword=$_POST['password']; 
            
            $tbl_name="deliveryman";
            $sql="SELECT * FROM $tbl_name WHERE deliveryman.username='$username' AND deliveryman.password='$mypassword'";
            $result = $mysql_con->query($sql);
            $count=mysqli_num_rows($result);

            if($count==1){
                $_SESSION['session_username'] = $username;
                header("location:index_del.php");
            }
            else {
                echo("<script>alert('Κάτι πήγε λάθος. Παρακαλώ εισάγεται πάλι τα στοιχεία σας')</script>");
                echo("<script>window.location = 'login.php';</script>");
            }
        }
    ?>
</html>