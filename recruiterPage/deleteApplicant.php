<?php
include('database.php');
$job = $_GET['jobname'];
    
$sql_query = "DELETE FROM applicant WHERE Applicant_status ='REJECTED' AND jobName='".$job."'";

if ($conn->query($sql_query) === TRUE) {
    echo "Record deleted successfully </br>";

} else {
    echo "Error deleting record: " . $conn->error;
    }

?>