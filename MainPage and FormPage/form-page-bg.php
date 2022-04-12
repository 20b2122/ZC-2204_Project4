<?php
include ('database.php');

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
$File_Location = './uploads/'; 

//renameing the filename
$fileName = $_FILES['CV']['name']; 
$fileNameCmps = explode(".", $fileName);
$fileExtension = strtolower(end($fileNameCmps));
$Full_Name_New = implode("", array_map("trim", explode(" ", $Full_Name)));
//final naming
$CV = $Full_Name_New . md5(time()) . '.' . $fileExtension;

//initializing Level of education index:
if ($Level_of_Education == "Olevel"){
    $Level_of_Education_Index = 1;
}
else if ($Level_of_Education == "Alevel"){
    $Level_of_Education_Index = 2;
}
else if ($Level_of_Education == "Diploma"){
    $Level_of_Education_Index = 3;
}
else if ($Level_of_Education == "Degree"){
    $Level_of_Education_Index = 4;
}
else if ($Level_of_Education == "Masters"){
    $Level_of_Education_Index = 5;
}
else if ($Level_of_Education == "PHD"){
    $Level_of_Education_Index = 6;
}

//initialiizing status by comparing it with the job requirements extracted from the job table:

$selectQuery = "SELECT * FROM job WHERE jobName='".$jobName."'";
$result = $conn->query($selectQuery);
$getRowAssoc = mysqli_fetch_assoc($result);

$minQualificationIndex = $getRowAssoc['minQualificationIndex'];
$numExperience = $getRowAssoc['numExperience'];

$Status = 'REJECTED';

if ($Level_of_Education_Index >= $minQualificationIndex && $Work_Experience >= $numExperience){
    $Status = 'PENDING';
}


$sql = "INSERT INTO applicant (Full_Name, IC, Phone_No, DOB, Gender, Email_Address, jobName, 
Work_Experience, Level_of_Education, Major, CV, Level_of_Education_Index , Applicant_status , File_Location ) 
VALUES ('$Full_Name', '$IC', '$Phone_No', '$DOB', '$Gender', '$Email_Address', '$jobName', '$Work_Experience', 
'$Level_of_Education', '$Major', '$CV', '$Level_of_Education_Index' , '$Status' , '$File_Location')";


$message = ''; 

if (isset($_POST['Submit']) && $_POST['Submit'] == 'Submit Form') {
  if (isset($_FILES['CV']) && $_FILES['CV']['error'] === UPLOAD_ERR_OK) {
    // uploaded file details
    $fileTmpPath = $_FILES['CV']['tmp_name'];
    $fileSize = $_FILES['CV']['size'];
    $fileType = $_FILES['CV']['type'];

    // file extensions allowed
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc', 'pdf');

    if (in_array($fileExtension, $allowedfileExtensions)) {
      // directory where file will be moved
      $uploadFileDir = './uploads/';
      $dest_path = $uploadFileDir . $CV;

      if(move_uploaded_file($fileTmpPath, $dest_path)) {
        $message = 'File uploaded successfully.';
      } else {
        $message = 'An error occurred while uploading the file to the destination directory. Ensure that the web server has access to write in the path directory.';
      }

    } else {
      $message = 'Upload failed as the file type is not acceptable. The allowed file types are:' . implode(',', $allowedfileExtensions);
    }

  } else {
    $message = 'Error occurred while uploading the file.<br>';
    $message .= 'Error:' . $_FILES['CV']['error'];
  }
}

$_SESSION['message'] = $message;


if (mysqli_query($conn, $sql)) {
    echo "<h1 style='text-align: center; margin-top: 10px;'>Your application has been added successfully!</h1>";
 } else {
    echo "Error: " . $sql . ":-" . mysqli_error($conn);
 }
 mysqli_close($conn);

header("Refresh:1; url=main-page.php");

?>