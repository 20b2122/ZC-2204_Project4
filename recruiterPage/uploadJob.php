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

    //below is to assign value to the qualification 
    //this is to make sorting easier.

    if ($minQualification =="Olevel"){
        $minQualificationIndex = 1;
    }
    else if ($minQualification =="Alevel"){
        $minQualificationIndex = 2;
    }
    else if ($minQualification =="Diploma"){
        $minQualificationIndex = 3;
    }
    else if ($minQualification =="Degree"){
        $minQualificationIndex = 4;
    }
    else if ($minQualification =="Master"){
        $minQualificationIndex = 5;
    }
    else if ($minQualification =="PHD"){
        $minQualificationIndex = 6;
    }


    $sql = "INSERT INTO job (jobName, department, quota, jDescription, minQualification,
    numExperience, jRequirements, closeDate, minQualificationIndex)
     VALUES ('$jobName','$department','$quota', '$jDescription', '$minQualification', '$numExperience',
     '$jRequirements', '$closeDate' , '$minQualificationIndex')";


    if (mysqli_query($conn, $sql)) {
        echo "<h1>New record has been added successfully !</h1>";
        echo "</br> This page will redirect you to the job list page in a moment";
     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($con);
     }
     mysqli_close($conn);

    header("Refresh:1; url=mainRecruiterPage.php");
 

?>      