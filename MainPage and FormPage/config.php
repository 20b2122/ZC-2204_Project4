<?php
$host = "localhost";
$user = "root";
$psword = "";
$db_name = "recruitment_ubd";

$conn = mysqli_connect($host, $user, $psword, $db_name);
if (!$conn){
    die("Connection failed: ". mysqli_connect_error());
}
?>