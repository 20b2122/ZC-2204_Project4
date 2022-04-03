<?php
require 'config.php';

$Full_Name = $_POST['Full_Name'];
$IC = $_POST['IC'];
$Phone_No = $_POST['Phone_No'];
$DOB = $_POST['DOB'];
$Gender = $_POST['Gender'];
$Email_Address = $_POST['Email_Address'];
$jobName = $_POST['jobName'];
$Work_Experience = $_POST['Work_Experience'];
$Level_of_Education = $_POST['Level_of_Education'];
$Major = $_POST['Major'];
$CV = $_FILES['CV']['name'];

$sql = "INSERT INTO applicant (Full_Name, IC, Phone_No, DOB, Gender, 
Email_Address, jobName, Work_Experience, Level_of_Education, Major, CV) 
VALUES ('$Full_Name', '$IC', '$Phone_No', '$DOB', '$Gender', '$Email_Address', 
'$jobName', '$Work_Experience', '$Level_of_Education', '$Major', '$CV')";

//creating an upload directory path
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['CV'])){
    $uploadDir = "./documents/";

    if(isset($_FILES['CV']) && $_FILES['CV']['error'] == 0){

        $fileextension = strtolower(pathinfo($CV, PATHINFO_EXTENSION));

        if (!file_exists($uploadDir.$CV)){
            move_uploaded_file($_FILES['CV']['tmp_name'], $uploadDir . $CV);
            $sql = "INSERT INTO applicant (CV) VALUES ('$CV')";
        }
    }
}

if (mysqli_query($conn, $sql)) {
    echo "<h1>Your application has been added successfully !</h1>";
 } else {
    echo "Error: " . $sql . ":-" . mysqli_error($conn);
 }
 mysqli_close($conn);

header("Refresh:1; url=main-page.php");

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['jobName'])){
    $job_options = mysqli_query($conn, "SELECT jobName From job");  // Use select query here 
                                
    while($result = mysqli_fetch_array($job_options))
    {
    echo "<option value='". $result['jobName'] ."'>" .$result['jobName'] ."</option>";  // displaying data in option menu
    }
}

?>