<?php  
    include "connect.php";

    if(isset($_POST["id"]))  
    {  
      $output = '';  

      $sql = "SELECT * FROM orders WHERE id = '".$_POST["id"]."' AND orders.status = 0";  
      $result = $mysql_con->query($sql);
      $count=mysqli_num_rows($result);

      if($count == 0) {
        $output = "Μόλις ολοκληρώθηκε.";
        echo $output;
        echo("<script>window.location = 'inprogress.php';</script>");
        return;
      }

      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      { 
           $output .= '  
                <tr>  
                     <td width="30%"><label>Όνομα</label></td>  
                     <td width="70%">'.$row["fname"].'</td>  
                </tr>  
                <tr>  
                <td width="30%"><label>Επίθετο</label></td>  
                <td width="70%">'.$row["lname"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Διεύθυνση</label></td>  
                     <td width="70%">'.$row["address_cust"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Όροφος</label></td>  
                     <td width="70%">'.$row["floor"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Τηλέφωνο</label></td>  
                     <td width="70%">'.$row["phone"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Συνολικό Κόστος</label></td>  
                     <td width="70%">'.$row["totalcost"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Διανομέας</label></td>  
                     <td width="70%">'.$row["deliveryman"].'</td>  
                </tr>
                ';  
      }  
      $output .= "</table></div>";  
      echo $output;  
    }  
 ?>