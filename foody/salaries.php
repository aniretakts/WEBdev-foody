<?php

    // κλήση στο browser: http://localhost:83/foody/salaries.php?month=02&&year=2018

    include "connect.php";
    header('Content-Type: text/plain');


    $month = $_GET['month'];
    $year = $_GET['year'];
   
    $data =  "<xml>\n";
    $data .= "  <header>\n";
    $data .= "      <transaction>\n";
    $month_now = date("m");
    $year_now = date("Y");
    $data .= "          <period month='".$month."' year='".$year."'/>\n"; 
    $data .= "      </transaction>\n";
    $data .= "  </header>\n";
    $data .= "  <body>\n";
    $data .= "      <employees>\n";

    //---------managers------------//
    $sql = "SELECT * FROM manager ";
    $result = $mysql_con->query($sql);

    while($row = mysqli_fetch_array($result)){  //για κάθε γραμμή του πίνακα => για κάθε μανατζερ

        $data .= "          <employee>\n";
        $data .= "              <firstname>".$row["name"]."</firstname>\n";
        $data .= "              <lastname>".$row["surname"]."</lastname>\n";
        $data .= "              <amka>".$row["amka"]."</amka>\n";
        $data .= "              <afm>".$row["afm"]."</afm>\n";
        $data .= "              <iban>".$row["iban"]."</iban>\n";


        //------------salary---------//
        $sql1 = "SELECT * FROM stores WHERE stores.manager_afm = '".$row["afm"]."' ";
        $result1 = $mysql_con->query($sql1);
        $row1 =  mysqli_fetch_array($result1);

        $sql2 = "SELECT * FROM orders WHERE orders.address_st = '".$row1["address"]."' ";
        $result2 = $mysql_con->query($sql2);

        $salaryman = 0;
        $totalincome = 0; //γενικά το κέρδος του καταστήματος

        while($row2 = mysqli_fetch_array($result2)){ //σε όλες τις παραγγελίες 

            $salary_month = date("m", strtotime($row2["order_date"]));
            $salary_year = date("Y", strtotime($row2["order_date"]));

            if ( ($salary_month == $month) && ($salary_year == $year) ){ //τσεκαρω τον χρόνο και τον μήνα 
                $totalincome = $totalincome + $row2["totalcost"];
            }

        }
        
        if ( $year_now >= $year ){
            if ($month_now >= $month ){
                $salaryman = 800 + ($totalincome * 0.02 ); //2% του συνολικου τζίρου 
            }
        }

        //------------salary---------//

        $salaryman = floor ($salaryman * 100) /100;
        $data .= "              <amount>".$salaryman."</amount>\n";
        $data .= "          </employee>\n";
    }

    //---------managers------------//


    //---------deliverymen------------//
    $sql = "SELECT * FROM deliveryman ";
    $result = $mysql_con->query($sql);

    while($row = mysqli_fetch_array($result)){  //για κάθε γραμμή του πίνακα => για κάθε διανομέα 

        $data .= "          <employee>\n";
        $data .= "              <firstname>".$row["name"]."</firstname>\n";
        $data .= "              <lastname>".$row["surname"]."</lastname>\n";
        $data .= "              <amka>".$row["amka"]."</amka>\n";
        $data .= "              <afm>".$row["afm"]."</afm>\n";
        $data .= "              <iban>".$row["iban"]."</iban>\n";

        //------------salary---------//

        $sql1 = "SELECT * FROM orders WHERE orders.deliveryman = '".$row["username"]."' ";
        $result1 = $mysql_con->query($sql1);
        
        $totalklm = 0;
        $salarydel = 0;

        while($row1 = mysqli_fetch_array($result1)){ //για κάθε παραγγελία του συγκεκριμένου διανομέα 

            $salary_month = date("m", strtotime($row1["order_date"]));
            $salary_year = date("Y", strtotime($row1["order_date"]));
            
            if ( ($salary_month == $month) && ($salary_year == $year) ){ //τσεκαρω τον χρόνο και τον μήνα 
                $totalklm = $totalklm + $row1["klm_route1"] + $row1["klm_route2"]; //αθροίζω τα μετρα
            }    
        }

        $sql2 = "SELECT * FROM timetable_del WHERE timetable_del.username = '".$row["username"]."' ";
        $result2 = $mysql_con->query($sql2);

        $totalhours = 0;
        $totalminutes = 0;
        $totalseconds = 0;
        $totalsecondspershift = 0;

        while($row2 = mysqli_fetch_array($result2)){ //για κάθε βάρδια του συγκεκριμένου διανομέα

            $salary_month = date("m", strtotime($row2["start_shift"]));
            $salary_year = date("Y", strtotime($row2["start_shift"]));

            if ( ($salary_month == $month) && ($salary_year == $year) ){ //τσεκαρω τον χρόνο και τον μήνα 

                $time1 = $row2["start_shift"];
                $time2 = $row2["end_shift"];
                $totalsecondspershift = $totalsecondspershift + (strtotime($time2) - strtotime($time1)); //αθροισμα δευτερολέπτων όλων των βαρδιων αυτού του μήνα  
                
                $hours = $totalsecondspershift/3600;
                $hours = floor($hours);

                $minutes = ($totalsecondspershift/60) - ($hours * 3600);
                $minutes = floor($minutes);

                $seconds = $totalsecondspershift - ($hours * 3600) - ($minutes * 60);

                $totalhours = $totalhours + $hours; 
                $totalminutes = $totalminutes + $minutes;
                $totalseconds = $totalseconds + $seconds;
            } 
        }

        if ( $year_now >= $year ){
            if ($month_now >= $month ){
                $salarydel = ($totalklm * 0.0001) + ( 5 * $totalhours) + ( 0.05 * $totalminutes) + ( 0.0008333333 * $totalseconds); 
            }
        }
        
        //------------salary---------//
        $salarydel = floor ($salarydel * 100) /100;
        $data .= "              <amount>".$salarydel."</amount>\n";
        $data .= "          </employee>\n";

    }

    //---------deliverymen------------//
   


    $data .= "      </employees>\n";
    $data .= "  </body>\n";
    $data .=  "</xml>\n";
    echo $data;


?>