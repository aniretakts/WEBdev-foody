<?php 
    session_start(); 
    if (!isset($_SESSION['session_email']))
    header("location: login.php");
    require_once('connect.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>

    <?php
        $emaill = $_SESSION['session_email'];
        //elegxos an uparxei diathesimo apothema kai euresi kontinoterou katastimatos me auto
        $count = array($_POST['cheese'], $_POST['green'], $_POST['bagel'], $_POST['tost'], $_POST['cake'] );

        $customer = array($_POST['fname'], $_POST['lname'], $_POST['floor'], $_POST['phone'], $_POST['address'], $_POST['cost']);

        $tbl_name="stores";
        $sql="SELECT * FROM $tbl_name";
        $result = $mysql_con->query($sql);

        $originLat = $_POST['latitude']; //του πελάτη απο τον χάρτη
        $originLng = $_POST['longitude']; 

        $minimumDist1 = 999999999999;
        $index = "";
        $flag = 0;

        while($row = mysqli_fetch_array($result)){
            $destinationLat = $row['lat'];
            $destinationLng = $row['lng'];

            $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$originLat.",".$originLng."&destinations=".$destinationLat.",".$destinationLng."&key=AIzaSyDO7v1R4tM1KAOpeBb2if55y2O-t6B8ASo";
            $json = file_get_contents($url);
            $response_a = json_decode($json, true);
            $dist = $response_a['rows'][0]['elements'][0]['distance']['value'];

            $ok = 0;
            $sql1="SELECT * FROM stock_price WHERE store_name='".$row['name']."'";
            $result1 = $mysql_con->query($sql1);

            $row1 = mysqli_fetch_array($result1);
            if(($row1['s_cheese_pie'] - $count[0]) >= 0) { $ok = $ok + 1; }
            if(($row1['s_green_pie'] - $count[1]) >= 0) { $ok = $ok + 1; }
            if(($row1['s_bagel'] - $count[2]) >= 0) { $ok = $ok + 1; }
            if(($row1['s_tost'] - $count[3]) >= 0) { $ok = $ok + 1; }
            if(($row1['s_cake'] - $count[4]) >= 0) { $ok = $ok + 1; }

            if($ok == 5) {  //an uparxei se ola ta proionta pou paraggeile o pelatis apothema
                if($dist<$minimumDist1){
                    $flag = 1;
                    $minimumDist1 = $dist;
                    $index = $row['name']; 
                    $st_address = $row['address'];
                    $finallat = $destinationLat;
                    $finallng = $destinationLng;
                }
            }
        }

        if($flag == 0) {
            echo("<script>alert('Δεν υπάρχει αρκετό απόθεμα. Παρακαλούμε, επαναλάβετε την παραγγελία σας.')</script>");
            echo("<script>window.location = 'order.php';</script>");
        } else {           
            //ananeosi gia to apothema kai kataxorisi paraggelias
            $sql="SELECT * FROM stock_price WHERE store_name='".$index."'";
            $result = $mysql_con->query($sql);

            $row = mysqli_fetch_array($result);
            $new_cheese = $row['s_cheese_pie'] - $count[0];
            $new_green = $row['s_green_pie'] - $count[1];
            $new_bagel = $row['s_tost'] - $count[3];
            $new_tost = $row['s_tost'] - $count[3];
            $new_cake = $row['s_cake'] - $count[4];

            $sql = "UPDATE stock_price 
                    SET s_cheese_pie = '".$new_cheese."', s_green_pie = '".$new_green."', s_tost = '".$new_tost."', s_bagel = '".$new_bagel."', s_cake = '".$new_cake."'
                    WHERE store_name='$index'";
            $result = $mysql_con->query($sql);

            $today = date("Y-m-d");

            $sql = "INSERT INTO orders (fname, lname, floor, phone, address_cust, lat_cust, lng_cust, address_st, lat_st, lng_st, totalcost, klm_route1, order_date, email_cust) 
                    VALUES ( '$customer[0]','$customer[1]','$customer[2]','$customer[3]','$customer[4]', '$originLat' , '$originLng', '$st_address', '$finallat', '$finallng', '$customer[5]', '$minimumDist1', '$today','$emaill')";
            $result = $mysql_con->query($sql);

            echo("<script>alert('Η παραγγελία σας καταχωρήθηκε επιτυχώς. Εκτιμώμενος χρόνος παράδοσης 30 λεπτά.')</script>");
            echo("<script>window.location = 'index_cust.php';</script>");
        }
    ?>
</html>