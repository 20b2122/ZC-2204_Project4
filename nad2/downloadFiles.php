<?php
include ('database.php');

$jobName = $_GET['jobName'];
$department = $_GET['department'];

$reviewedQuery = "SELECT * FROM applies WHERE jobName='".$jobName."' ORDER BY Level_of_Education_Index DESC , Work_Experience DESC";
$reviewed = $conn->query($reviewedQuery);

    $zipname = 'applicants_'.$jobName.'_.zip';
    $zip = new ZipArchive();
    $zip->open($zipname, ZipArchive::CREATE);

if(mysqli_num_rows($reviewed)>0){
    while($row = mysqli_fetch_array($reviewed)){

      //national id or passport:
      $Id_Passport = $row['File_Location'].$row['Id_Passport'];
      $ext_IdP = pathinfo($Id_Passport, PATHINFO_EXTENSION);
      //allowed extentsions for id or passport:
      $allowed_ext_IdP = array('doc', 'docx', 'pdf', 'png', 'jpeg', 'jpg');
      //cv:
      $cv = $row['File_Location'].$row['CV'];
      $ext_cv = pathinfo($cv, PATHINFO_EXTENSION);
      //cover letter:
      $cover_letter = $row['File_Location'].$row['Cover_Letter'];
      $ext_cl = pathinfo($cover_letter, PATHINFO_EXTENSION);
      //Qualifications:
      $qualification = $row['File_Location'].$row['Qualifications'];
      $ext_q = pathinfo($qualification, PATHINFO_EXTENSION);
      //allowed extensions for other files:
      $allowedfileExtensions2 = array('ppt', 'pptx', 'xls', 'xlsx', 'doc', 'docx', 'pdf');

        if($zip->open($zipname, ZipArchive::CREATE)===True){

          //adding in the id and passport in the zip file according to their extension:
          for ($i=0 ; $i < sizeof($allowed_ext_IdP); $i++){
            if($ext_IdP == $allowed_ext_IdP[$i]){
            $zip->addFile($Id_Passport , $row['Full_Name'].'_ID_Passport.'.$allowed_ext_IdP[$i]);
            }
          }
          //adding cv:
          for ($i=0 ; $i < sizeof($allowedfileExtensions2); $i++){
            if($ext_cv == $allowedfileExtensions2[$i]){
            $zip->addFile($cv , $row['Full_Name'].'_CV.'.$allowedfileExtensions2[$i]);
            }
          }
          //adding cover letter:
          for ($i=0 ; $i < sizeof($allowedfileExtensions2); $i++){
            if($ext_cl == $allowedfileExtensions2[$i]){
            $zip->addFile($cover_letter , $row['Full_Name'].'_Cover_Letter.'.$allowedfileExtensions2[$i]);
            }
          }
          //adding qualification:
            for ($i=0 ; $i < sizeof($allowedfileExtensions2); $i++){
            if($ext_q == $allowedfileExtensions2[$i]){
            $zip->addFile($qualification , $row['Full_Name'].'_qualification.'.$allowedfileExtensions2[$i]);
            }
          }
        }
    }
    
}
$zip->close();

if (mysqli_query($conn, $reviewedQuery)) {
} else {
  echo "Error updating record: " . mysqli_error($conn);
}

header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$zipname);
header('Content-Length: ' . filesize($zipname));
readfile($zipname);

header("Refresh:0; url=viewApplicants.php?jobname=".$jobName."&department=".$department);

?>