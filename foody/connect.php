<?php
    $db_server["host"] = "localhost:3306"; //database server
    $db_server["username"] = "root"; // DB username
    $db_server["password"] = ""; // DB password
    $db_server["database"] = "foody";// database name

    $mysql_con = mysqli_connect($db_server["host"], $db_server["username"], $db_server["password"], $db_server["database"]);
    $mysql_con->query ('SET CHARACTER SET utf8');
    $mysql_con->query ('SET COLLATION_CONNECTION=utf8_general_ci');
?>