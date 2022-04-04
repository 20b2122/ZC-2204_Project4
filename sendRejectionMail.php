<?php
require 'database.php';

$sql_query1 = mysqli_query($conn, "SELECT jobName From job");
$sql_query2 = mysqli_query($conn, "SELECT Full_Name, Email_Address From applicant");
$data1 = mysqli_fetch_array($sql_query1);
$data2 = mysqli_fetch_array($sql_query2);

$to_email = $data2['Email_Address'];

$subject = "Your application for the ". $data1["jobName"] . " position.";
$body = "Assalamualaikum and Greetings ". $data2['Full_Name'] . ",

Thank you for taking the time to fill in the application. 
Unfortunately, we will not be proceeding with your application at this time.

Best Regards,
UBDTesting123
";

$headers = "From: ubdTesting123@gmail.com"; //change in the php.ini


if(mail($to_email, $subject, $body, $headers)){
    echo("Email successfully send to $to_email");
} else {
    echo("Fail sending email");
}
//header("Refresh:1; url=#"); //page u want to direct to
?>