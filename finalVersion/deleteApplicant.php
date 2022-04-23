<?php
include('database.php');
    
$sql_query = "DELETE FROM applies WHERE Status ='REJECTED' AND jobName='".$jobName."'";

if ($conn->query($sql_query) === TRUE) {
    echo "Record deleted successfully </br>";

} else {
    echo "Error deleting record: " . $conn->error;
    }
header("Refresh:0; url=viewApplicants.php?jobname=".$jobName);
?>