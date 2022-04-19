<?php
include ('database.php');

$jobName = $_GET['jobName'];
$department = $_GET['department'];

$reviewedQuery = "SELECT Full_Name,  CV , File_Location FROM applies WHERE jobName='".$jobName."' AND Status='PENDING' ORDER BY Level_of_Education_Index DESC , Work_Experience DESC";
$reviewed = $conn->query($reviewedQuery);

    $zipname = 'applicants_'.$jobName.'_CV.zip';
    $zip = new ZipArchive();
    $zip->open($zipname, ZipArchive::CREATE);

if(mysqli_num_rows($reviewed)>0){
    while($row = mysqli_fetch_array($reviewed)){
        $file = $row['File_Location'].$row['CV'];
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if($zip->open($zipname, ZipArchive::CREATE)===True){
          if($ext == 'pdf'){
            $zip->addFile($file , $row['Full_Name'].'_'.$jobName.'.pdf');
          }
          if($ext == 'ppt'){
            $zip->addFile($file , $row['Full_Name'].'_'.$jobName.'.ppt');
          }
          if($ext == 'pptx'){
            $zip->addFile($file , $row['Full_Name'].'_'.$jobName.'.pptx');
          }
          if($ext == 'xls'){
            $zip->addFile($file , $row['Full_Name'].'_'.$jobName.'.xls');
          }
          if($ext == 'xlsx'){
            $zip->addFile($file , $row['Full_Name'].'_'.$jobName.'.xlsx');
          }
          if($ext == 'doc'){
            $zip->addFile($file , $row['Full_Name'].'_'.$jobName.'.doc');
          }
          if($ext == 'docx'){
            $zip->addFile($file , $row['Full_Name'].'_'.$jobName.'.docx');
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