<?php
include ('database.php');

$jobName = $_GET['jobName'];
$IC = $_GET['IC'];

$sql = "UPDATE applicant SET Applicant_status= 'REJECTED' WHERE IC='".$IC."' AND jobName='".$jobName."'";
if (mysqli_query($conn, $sql)) {
} else {
  echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);

header("Refresh:0; url=viewApplicants.php?jobname=".$jobName);


?>