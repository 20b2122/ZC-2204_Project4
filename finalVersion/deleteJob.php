<?php
include("database.php");
$jobName = $_GET['jobName'];
//first need to email all applicants that they  are all rejected
$sql_query2 = mysqli_query($conn, "SELECT Full_Name, IC , Email_Address, jobName From applies 
WHERE jobName='".$jobName."'");


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
//then delete the job:
if (mysqli_num_rows($sql_query2)>=0){ 
$deleteQuery = "DELETE FROM job WHERE jobName='".$jobName."'";
    if ($conn->query($deleteQuery) === TRUE) {
        echo "All record deleted successfully </br>";

    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

else{
    $deleteQuery = "DELETE job, applies FROM job INNER JOIN applicant on job.jobName= applies.jobName WHERE job.jobName='".$jobName."'";
     if ($conn->query($deleteQuery) === TRUE) {
        echo "All record deleted successfully </br>";

    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

header("Refresh:1; url=mainRecruiterPage.php");



?>