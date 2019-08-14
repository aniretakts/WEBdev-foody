<?php
    session_start(); 
    if (!isset($_SESSION['session_username']))
    header("location: login.php");
    require_once('connect.php');

    //apothikeusi tis topothesias tou delivera stin vasi
    $sql = "UPDATE deliveryman SET lat = '".$_POST['latitude']."', lng = '".$_POST['longitude']."' WHERE username='".$_SESSION['session_username']."'";
    $result = $mysql_con->query($sql);

    echo("<script>alert('Παρακαλώ περιμένετε. Θα ενημερωθείτε μόλις υπάρξει κάποια παραγγελία προς παράδοση.')</script>");
    echo("<script>window.location = 'index_del.php';</script>");
?>