<?php
require 'database.php';
$job = $_GET['jobname'];

$sql_query2 = mysqli_query($conn, "SELECT Full_Name, IC , Email_Address, jobName From applicant 
WHERE Applicant_status='REJECTED' and jobName='".$job."'");
if (mysqli_num_rows($sql_query2)>0){
    while($row = mysqli_fetch_array($sql_query2)){
        
        $to_email = $row['Email_Address'];
        
        $subject = "Your application for the ". $row["jobName"] . " position.";
        $body = "Assalamualaikum and Greetings ". $row['Full_Name'] . ",

        Thank you for taking the time to fill in the application. 
        Unfortunately, we will not be proceeding with your application at this time.

        Best Regards,
        UBDTesting123
        ";

        $headers = "From: ubdTesting123@gmail.com"; 


        if(mail($to_email, $subject, $body, $headers)){
            echo("Email successfully send to $to_email </br>");
        } else {
            echo("Fail sending email");
        }
    }
}

if (mysqli_num_rows($sql_query2)!=0){
    include('deleteApplicant.php?jobName='.$job);            
}

?>

