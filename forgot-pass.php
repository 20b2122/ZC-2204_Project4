<?php

require 'database.php';

$sql_query2 = mysqli_query($conn, "SELECT Email, Password, name From recruiter");
if (mysqli_num_rows($sql_query2)>0){
    while($row = mysqli_fetch_array($sql_query2)){
        
        $to_email = $row['Email'];
        
        $subject = "Forgotten Password ";
        $body = "Hi ". $row['name'] . ",
        Your password is ". $row['Password'] . "
        ";

        $headers = "From: ubdTesting123@gmail.com"; 


        if(mail($to_email, $subject, $body, $headers)){
            echo("Email successfully send to $to_email </br>");
        } else {
            echo("Email failed to send");
        }
    }
}

?>
