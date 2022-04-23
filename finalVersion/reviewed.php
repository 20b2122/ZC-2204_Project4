<?php
include ('database.php');

$jobName = $_GET['jobName'];
$IC = $_GET['IC'];
$department = $_GET['department'];

$sql = "UPDATE applies SET Status= 'REVIEWED' WHERE IC='".$IC."' AND jobName='".$jobName."'";
if (mysqli_query($conn, $sql)) {
} else {
  echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);

header("Refresh:0; url=viewApplicants.php?jobname=".$jobName."&department=".$department);


?>