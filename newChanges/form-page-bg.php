<?php
include ('database.php');

$jobName = $_GET['jobName'];

// Personal
$Full_Name = $_POST['Full_Name'];
$Email_Address = $_POST['Email_Address'];
$IC = $_POST['IC'];
$Phone_No = $_POST['Phone_No'];
$DOB = $_POST['DOB'];
$Gender = $_POST['Gender'];
$Nationality = $_POST['Nationality'];

// Education / Employment
$Work_Experience = $_POST['Work_Experience'];
$Other_Qualification = $_POST['Other_Qualification'];
$Level_Of_Education = $_POST['Level_Of_Education']; // why is the data not posted in database??
$File_Location = './uploads/'; 

// Rename Id_Passport File
$Id_PassportFile = $_FILES['Id_Passport']['name']; 
$Id_PassportFileCmps = explode(".", $Id_PassportFile);
$Id_PassportFileExtension = strtolower(end($Id_PassportFileCmps));
$Id_Passport_Full_Name_New = implode("", array_map("trim", explode(" ", $Full_Name)));
$Id_Passport = $Id_Passport_Full_Name_New . ' Id_Passport.' . $Id_PassportFileExtension;

// Rename Qualifications File
$QualificationsFile = $_FILES['Qualifications']['name']; 
$QualificationsFileCmps = explode(".", $QualificationsFile);
$QualificationsFileExtension = strtolower(end($QualificationsFileCmps));
$Qualifications_Full_Name_New = implode("", array_map("trim", explode(" ", $Full_Name)));
$Qualifications = $Qualifications_Full_Name_New . ' Qualification.' . $QualificationsFileExtension;

// Rename School Details File
$School_DetailsFile = $_FILES['School_Details']['name'];
$School_DetailsFileCmps = explode(".", $School_DetailsFile);
$School_DetailsFileExtension = strtolower(end($School_DetailsFileCmps));
$School_Details_Full_Name_New = implode("", array_map("trim", explode(" ", $Full_Name)));
$School_Details = $School_Details_Full_Name_New . ' School Details.' . $School_DetailsFileExtension;

// Rename CV File
$CVFile = $_FILES['CV']['name']; 
$CVFileCmps = explode(".", $CVFile);
$CVFileExtension = strtolower(end($CVFileCmps));
$CV_Full_Name_New = implode("", array_map("trim", explode(" ", $Full_Name)));
$CV = $CV_Full_Name_New . ' CV.' . $CVFileExtension;

// Rename Cover_Letter File
$Cover_LetterFile = $_FILES['Cover_Letter']['name']; 
$Cover_LetterFileCmps = explode(".", $Cover_LetterFile);
$Cover_LetterFileExtension = strtolower(end($Cover_LetterFileCmps));
$Cover_Letter_Full_Name_New = implode("", array_map("trim", explode(" ", $Full_Name)));
$Cover_Letter = $Cover_Letter_Full_Name_New . ' Cover Letter.' . $Cover_LetterFileExtension;

//initializing Level of education index:
if ($Level_Of_Education == "Olevel"){
  $Level_Of_Education_Index = 1;
}
else if ($Level_Of_Education == "Alevel"){
  $Level_Of_Education_Index = 2;
}
else if ($Level_Of_Education == "Diploma"){
  $Level_Of_Education_Index = 3;
}
else if ($Level_Of_Education == "Degree"){
  $Level_Of_Education_Index = 4;
}
else if ($Level_Of_Education == "Masters"){
  $Level_Of_Education_Index = 5;
}
else if ($Level_Of_Education == "PHD"){
  $Level_Of_Education_Index = 6;
}

//initialiizing status by comparing it with the job requirements extracted from the job table:
$selectQuery = "SELECT * FROM job WHERE jobName='".$jobName."'";
$result = $conn->query($selectQuery);
$getRowAssoc = mysqli_fetch_assoc($result);

$minQualificationIndex = $getRowAssoc['minQualificationIndex'];
$numExperience = $getRowAssoc['numExperience'];

$Status = 'REJECTED';

if ($Level_Of_Education_Index >= $minQualificationIndex && $Work_Experience >= $numExperience){
    $Status = 'PENDING';
}

$sql = "INSERT INTO applies (Full_Name, Email_Address, IC, Phone_No, DOB, Gender, Nationality, Id_Passport, 
Work_Experience, Level_Of_Education, Qualifications, School_Details, Other_Qualification, 
CV, Cover_Letter,
Level_Of_Education_Index , Status , File_Location) 
VALUES ('$Full_Name', '$Email_Address', '$IC', '$Phone_No', '$DOB', '$Gender', '$Nationality', '$Id_Passport', 
'$Work_Experience', '$Level_Of_Education', '$Qualifications', '$School_Details', '$Other_Qualification', 
'$CV', '$Cover_Letter',
'$Level_Of_Education_Index' , '$Status' , '$File_Location')";



$message = ''; 

if (isset($_POST['Submit']) && $_POST['Submit'] == 'Submit Form') {
  $uploadLocation = './uploads/';
  // this is for the national ic/passport
  $allowedfileExtensions1 = array('doc', 'docx', 'pdf', 'png', 'jpeg', 'jpg');

  // file extensions allowed
  $allowedfileExtensions2 = array('ppt', 'pptx', 'xls', 'xlsx', 'doc', 'docx', 'pdf');

  // Id_Passport 
  if(isset($_FILES['Id_Passport'])){
    $Id_Passport_size = $_FILES['Id_Passport']['size'];
    $Id_Passport_tmp = $_FILES['Id_Passport']['tmp_name'];

    if (in_array($Id_PassportFileExtension, $allowedfileExtensions1)) {
      $dest_path = $uploadLocation . $Id_Passport;

      if(move_uploaded_file($Id_Passport_tmp, $dest_path)) { 
        $message = 'File uploaded successfully.';
      } else {
        $message = 'An error occurred while uploading the file to the destination directory. Ensure that the web server has access to write in the path directory.';
      }
    } else {
      $message = 'Upload failed as the file type is not acceptable. The allowed file types are:' . implode(',', $allowedfileExtensions1);
    }
  } else {
    $message = 'Error occurred while uploading the file.<br>';
    $message .= 'Error:' . $_FILES['Id_Passport']['error'];
  }

  // Qualifications 
  if(isset($_FILES['Qualifications'])){
    $Qualifications_size = $_FILES['Qualifications']['size'];
    $Qualifications_tmp = $_FILES['Qualifications']['tmp_name'];

    if (in_array($QualificationsFileExtension, $allowedfileExtensions2)) { 
      $dest_path = $uploadLocation . $Qualifications; 

      if(move_uploaded_file($Qualifications_tmp, $dest_path)) { 
        $message = 'File uploaded successfully.';
      } else {
        $message = 'An error occurred while uploading the file to the destination directory. Ensure that the web server has access to write in the path directory.';
      }
    } else {
      $message = 'Upload failed as the file type is not acceptable. The allowed file types are:' . implode(',', $allowedfileExtensions2);
    }
  } else {
    $message = 'Error occurred while uploading the file.<br>';
    $message .= 'Error:' . $_FILES['Qualifications']['error']; 
  }

  // School_Details
  if(isset($_FILES['School_Details'])){
    $School_Details_size = $_FILES['School_Details']['size'];
    $School_Details_tmp = $_FILES['School_Details']['tmp_name'];

    if (in_array($School_DetailsFileExtension, $allowedfileExtensions2)) { 
      $dest_path = $uploadLocation . $School_Details; // change $Cover_Letter

      if(move_uploaded_file($School_Details_tmp, $dest_path)) { 
        $message = 'File uploaded successfully.';
      } else {
        $message = 'An error occurred while uploading the file to the destination directory. Ensure that the web server has access to write in the path directory.';
      }
    } else {
      $message = 'Upload failed as the file type is not acceptable. The allowed file types are:' . implode(',', $allowedfileExtensions2);
    }
  } else {
    $message = 'Error occurred while uploading the file.<br>';
    $message .= 'Error:' . $_FILES['School_Details']['error']; 
  }
  

  // CV
  if(isset($_FILES['CV'])){
    $CVsize = $_FILES['CV']['size'];
    $CVtmp = $_FILES['CV']['tmp_name'];

    if (in_array($CVFileExtension, $allowedfileExtensions2)) {
      $dest_path = $uploadLocation . $CV;

      if(move_uploaded_file($CVtmp, $dest_path)) {
        $message = 'File uploaded successfully.';
      } else {
        $message = 'An error occurred while uploading the file to the destination directory. Ensure that the web server has access to write in the path directory.';
      }
    } else {
      $message = 'Upload failed as the file type is not acceptable. The allowed file types are:' . implode(',', $allowedfileExtensions2);
    }
  } else {
    $message = 'Error occurred while uploading the file.<br>';
    $message .= 'Error:' . $_FILES['CV']['error'];
  }
  
  // COVER LETTER
  if(isset($_FILES['Cover_Letter'])){
    $Cover_Letter_size = $_FILES['Cover_Letter']['size'];
    $Cover_Letter_tmp = $_FILES['Cover_Letter']['tmp_name'];

    if (in_array($Cover_LetterFileExtension, $allowedfileExtensions2)) { //change $Cover_LetterFileExtension
      $dest_path = $uploadLocation . $Cover_Letter; // change $Cover_Letter

      if(move_uploaded_file($Cover_Letter_tmp, $dest_path)) {  // change $Cover_Letter_tmp
        $message = 'File uploaded successfully.';
      } else {
        $message = 'An error occurred while uploading the file to the destination directory. Ensure that the web server has access to write in the path directory.';
      }
    } else {
      $message = 'Upload failed as the file type is not acceptable. The allowed file types are:' . implode(',', $allowedfileExtensions2);
    }
  } else {
    $message = 'Error occurred while uploading the file.<br>';
    $message .= 'Error:' . $_FILES['Cover_Letter']['error']; //change Cover_Letter
  }

}

$_SESSION['message'] = $message;


if (mysqli_query($conn, $sql)) {
    echo "<h1 style='text-align: center; margin-top: 10px;'>Your application has been added successfully!</h1>";
 } else {
    echo "Error: " . $sql . ":-" . mysqli_error($conn);
 }
 mysqli_close($conn);

// header("Refresh:1; url=main-page.php");

?>
