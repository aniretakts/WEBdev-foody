<?php
    session_start(); 
    if (!isset($_SESSION['session_username']))
    header("location: login.php");
    require_once('connect.php');

    //euresi paraggelias pou molis pragmatopoiithike
    $sql = "SELECT * FROM orders WHERE deliveryman = '".$_SESSION['session_username']."' AND orders.status = 0";
    $result = $mysql_con->query($sql);
    $row = mysqli_fetch_array($result);
    $new_lat = $row['lat_cust'];
    $new_lng = $row['lng_cust'];

    //enimerosi oti pragmatopoiithike
    $sql = "UPDATE orders SET orders.status = 1 
            WHERE deliveryman='".$_SESSION['session_username']."' AND lat_cust = '".$new_lat."' AND lng_cust = '".$new_lng."' ";
    $result = $mysql_con->query($sql);

    //ananeosi suntetagmenon topothesias deliveryman
    $sql = "SELECT * FROM deliveryman WHERE username = '".$_SESSION['session_username']."'";
    $result = $mysql_con->query($sql);
    $row = mysqli_fetch_array($result);

    $sql = "UPDATE deliveryman SET deliveryman.status = 1, lat = '".$new_lat."', lng = '".$new_lng."' 
            WHERE username='".$_SESSION['session_username']."'";
    $result = $mysql_con->query($sql);

    echo("<script>alert('Ευχαριστούμε για τη συνεργασία. Η πληρωμή σας έχει προστεθεί. Παρακαλώ περιμένετε για επόμενη παραγγελία.')</script>");
    echo("<script>window.location = 'index_del.php';</script>");
?>