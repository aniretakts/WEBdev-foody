<?php 
    session_start(); 
    if (!isset($_SESSION['session_username']))
    header("location: login.php");
    require_once('connect.php');

    $sql = "SELECT * FROM manager WHERE username='" . $_SESSION['session_username'] ."'";    
    $result = $mysql_con->query($sql);
    $row = mysqli_fetch_assoc($result);
    $m_afm = $row["afm"]; 

    $sql = "SELECT * FROM stores WHERE manager_afm='$m_afm'";    
    $result = $mysql_con->query($sql);
    $row = mysqli_fetch_assoc($result);
    $m_store = $row["name"];
    
    $sql = "SELECT * FROM stock_price WHERE store_name='$m_store'";    
    $result = $mysql_con->query($sql);
    $row = mysqli_fetch_assoc($result);

    $stock_cheese_pie = $row['s_cheese_pie'] + $_POST['q_cheese_pie'];
    $stock_green_pie = $row['s_green_pie']  + $_POST['q_green_pie'];
    $stock_bagel = $row['s_bagel']  + $_POST['q_bagel'];
    $stock_tost = $row['s_tost']  + $_POST['q_tost'];
    $stock_cake = $row['s_cake']  + $_POST['q_cake'] ; 

    $sql = "UPDATE stock_price 
            SET s_cheese_pie = '".$stock_cheese_pie."', s_green_pie = '".$stock_green_pie."', s_tost = '".$stock_tost."', s_bagel = '".$stock_bagel."', s_cake = '".$stock_cake."'
            WHERE store_name='$m_store'";
    $result = $mysql_con->query($sql);

    if($result){ //epitixis ananeosi apothematos stin vasi
        echo("<script>alert('Η βάση ενημερώθηκε επιτυχώς.')</script>");
        echo("<script>window.location = 'index_man.php';</script>");
    } else{ 
        echo("<script>alert('Κάτι πήγε στραβά. Παρακαλώ ξαναπροσπαθήστε.')</script>");
        echo("<script>window.location = 'index_man.php';</script>");
    }

?>