<?php session_start(); ?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>

    <?php   
        include "connect.php";
        //eggrafi neou pelati
        if(isset($_POST['register']))  
        {    
            $fname=$_POST['fname'];
            $lname=$_POST['lname'];
            $uemail=$_POST['email'];  
            $uphone=$_POST['phone'];
            $upassword1=$_POST['password1'];
            $upassword2=$_POST['password2'];

            $check_email_query="SELECT * FROM customer WHERE customer.email='$uemail'";  
            $run_query=mysqli_query($mysql_con,$check_email_query);  
        
            if(mysqli_num_rows($run_query)>0)  
            {  
                echo("<script>alert('To email $uemail υπάρχει ήδη.')</script>");
                echo("<script>window.location = 'register.php';</script>");                
            }  

            //validate-check fields 
             $fname = trim($fname);
             $lname = trim($lname);
             $uemail = trim($uemail);
             $uphone = trim($uphone);
             $upassword1 = trim($upassword1);
             $upassword2 = trim($upassword2);

             $flag = 1;

            //validate password
             if ( $upassword1!=$upassword2 ){
                 echo("<script>alert('Οι κωδικοί που έχετε δώσει δεν είναι ίδιοι.')</script>");
                 echo("<script>window.location = 'register.php';</script>");
                 $flag = 0;
             }

            //validate fname
            $len = strlen($fname); 
            if ( $len<2 || $len>51 ){
                echo("<script>alert('Το όνομά σας μπορεί να αποτελείται απο 2 μέχρι 50 χαρακτήρες.')</script>");
                echo("<script>window.location = 'register.php';</script>");
                $flag = 0;
            }

            //validate lname
            $len = strlen($lname); 
            if ( $len<2 || $len>51 ){
                echo("<script>alert('Το επίθετό σας μπορεί να αποτελείται απο 2 μέχρι 50 χαρακτήρες.')</script>");
                echo("<script>window.location = 'register.php';</script>");
                $flag = 0;
            }

            //validate email
            if ( !filter_var( $uemail, FILTER_VALIDATE_EMAIL) ) {
                echo("<script>alert('Το email που εισάγατε δεν είναι έγκυρο.')</script>");
                echo("<script>window.location = 'register.php';</script>");
                $flag = 0;
            }
            
            //validate phone number 
            $len = strlen($uphone);
            if ( $len != 10 ) {
                echo("<script>alert('Το νούμερο τηλεφώνου που εισάγατε δεν είναι έγκυρο.')</script>");
                echo("<script>window.location = 'register.php';</script>");
                $flag = 0;
            }
            
            if ($flag == 1)
            {
                //insert the user into the database.  
                $insert_user="INSERT INTO customer VALUE ('$fname','$lname','$uemail','$upassword1','$uphone')";  
                if(mysqli_query($mysql_con,$insert_user))  
                {  
                    $_SESSION['session_email'] = $uemail;
                    header("location:index_cust.php"); 
                }   
            }else
            {
                //letters in the phone number
                echo("<script>alert('Κάτι πήγε λάθος. Παρακαλώ εισάγεται πάλι τα στοιχεία σας')</script>");
                echo("<script>window.location = 'register.php';</script>");

            }
        }  
    ?>
</html>