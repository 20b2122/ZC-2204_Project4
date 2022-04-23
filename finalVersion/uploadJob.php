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
    $jCategory = $_POST['jCategory'];
    $jType = $_POST['jType'];
    $salary = $_POST['salary'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];

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

    $sql_uploadJob = "INSERT INTO job (jobName, department, quota, jCategory , jType , salary , startTime , endTime , jDescription, minQualification,
    numExperience, jRequirements, closeDate, minQualificationIndex)
     VALUES ('$jobName','$department','$quota', '$jCategory' , '$jType' , '$salary' , '$startTime' , '$endTime' , '$jDescription', '$minQualification', '$numExperience',
     '$jRequirements', '$closeDate' , '$minQualificationIndex')";


    if (mysqli_query($conn, $sql_uploadJob)) {
        echo "<h1>New record has been added successfully !</h1>";
     } else {
        echo "Error: " . $sql_uploadJob . ":-" . mysqli_error($con);
     }
    

    header("Refresh:1; url=mainRecruiterPage.php");
 

?>      