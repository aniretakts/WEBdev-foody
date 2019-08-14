<?php       
    session_start();

    //logout delivera
    if (strpos($_SESSION['session_username'], 'del') !== false) {      
        require_once('connect.php');
        $sql = "SELECT * FROM deliveryman WHERE deliveryman.username='".$_SESSION['session_username']."'";
        $result = $mysql_con->query($sql);
        $count=mysqli_num_rows($result);

        if($count==1){       
            $sql1 = "UPDATE deliveryman SET lat = 0, lng = 0, deliveryman.status = 0 WHERE username='".$_SESSION['session_username']."'";
            $result1 = $mysql_con->query($sql1);
          

            $sql2 = "UPDATE timetable_del SET end_shift = now() WHERE username='".$_SESSION['session_username']."' ORDER BY aa_key DESC limit 1";
            $result2 = $mysql_con->query($sql2);
             
        }
    }

    session_destroy();  
    header("location: login.php");
?> 