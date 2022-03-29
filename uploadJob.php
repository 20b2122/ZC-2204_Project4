<?php
    include("database.php");

    $jobName = $_POST['jobName'];
    $department = $_POST['department'];
    $quota = $_POST['quota'];
    $jDescription = $_POST['jDescription'];
    $minQualification = $_POST['minQualification'];
    $numExperience =$_POST['numExperience'];
    $jRequirements = $_POST['jRequirements'];
    $closeDate =$_POST['closeDate'];

    $sql = "INSERT INTO Jobs (jobName, department, quota, jDescription, minQualification,
    numExperience, jRequirements, closeDate)
     VALUES ('$jobName','$department','$quota', '$jDescription', '$minQualification', '$numExperience',
     '$jRequirements', '$closeDate')";


    if (mysqli_query($con, $sql)) {
        echo "<h1>New record has been added successfully !</h1>";
     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($con);
     }
     mysqli_close($con);

    header("Refresh:1; url=manageJob.php");
 

?>      