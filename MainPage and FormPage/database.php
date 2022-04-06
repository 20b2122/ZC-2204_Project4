<?php
$host = "localhost";
$user = "root";
$psword = "";
$db_name = "recruitment_ubd";

$conn = mysqli_connect($host, $user, $psword, $db_name);
if (!$conn){
    die("Failed to connect with Mysql: ". mysqli_connect_error());
}
?>