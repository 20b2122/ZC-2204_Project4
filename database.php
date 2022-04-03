<?php
    $host = "localhost";
    $user = "root";
    $psword = "";
    $db_name = "recruitment_ubd";

    $con = mysqli_connect($host, $user, $psword, $db_name);
    if(mysqli_connect_errno()){
        die("Failed to connect with Mysql: ".mysqli_connect_errno());
    }
?>