<?php
$jobName = $_GET['jobname'];
$department = $_GET['department'];
include("database.php");
$selectQuery = "SELECT * FROM job WHERE jobName='".$jobName."' AND department='".$department."'";
$result = $conn->query($selectQuery);
$getRowAssoc = mysqli_fetch_assoc($result);

$minQualification = $getRowAssoc['minQualification'];
$numExperience = $getRowAssoc['numExperience'];
$closeDate = $getRowAssoc['closeDate'];

$pendingQuery = "SELECT * FROM applies WHERE jobName='".$jobName."'"
."AND Status='PENDING' ORDER BY Level_of_Education_Index DESC , Work_Experience DESC";
$pending = $conn->query($pendingQuery);

$rejectedQuery = "SELECT * FROM applies WHERE jobName='".$jobName."'"
."AND Status='REJECTED' ORDER BY Level_of_Education_Index DESC , Work_Experience DESC";
$rejected = $conn->query($rejectedQuery);

$reviewedQuery = "SELECT * FROM applies WHERE jobName='".$jobName."'"
."AND Status='REVIEWED' ORDER BY Level_of_Education_Index DESC , Work_Experience DESC";
$reviewed = $conn->query($reviewedQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View applicants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <a href="#" class="navbar-brand">UBD Recruiter's page</a>
    <aside class="nav navbar-nav navbar-right">
     <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <button type="button" class="btn btn-light" onclick="location.href 
                    = 'mainRecruiterPage.php'">Main page</button>
                </li>
            </ul>
    </aside>
    </nav>
    <section>
</br>
    <h2>List of applicants for <?php echo $jobName ?> </h2>
    <p>This table is sorted according to the highest qualification and years of experience.</br>
    The minimum qualification for this job is <span style="font-weight: bold;"><?php echo $minQualification?></span>
    and the minimum years of experience needed are <span style="font-weight: bold;">
    <?php echo $numExperience ?> years.</span></p>
    <!--List of reviewed applicants-->
    <?php if(mysqli_num_rows($reviewed)>0){?>
        <h4>List of reviewed applicants</h4>
        <p>These applicants are reviewed and is eligible to go through the next process
        </p>
        <table id="listOfReviewedApplicants" class="table table-success">
        <tr>
            <th>No.</th>
            <th>IC number</th>
            <th>Applicant's Details</th>
            <th>Downloadable files</th>
            <th>Contact</th>
            <th>Qualification & Experience</th>
            <th></th>
        </tr>

        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($reviewed)){
            ?>
        <tr>
            <td><?php echo $i+1; ?></td>
            <td><?php echo $row["IC"];?></td>
            <td>
                <p><span style="font-weight: bold;"> Name : </span><?php echo $row["Full_Name"];?></br>
                <span style="font-weight: bold;">DOB : </span><?php echo $row["DOB"];?></br>
                <span style="font-weight: bold;">Gender : </span><?php echo $row["Gender"];?></br>
                <span style="font-weight: bold;">Nationality : </span><?php echo $row["Nationality"];?></p>
            </td>
            <td>
                <p>
                <a href="<?php echo $row['File_Location'].$row['Id_Passport'];?>" target="_blank">National ID/Passport</a></br>
                <a href="<?php echo $row['File_Location'].$row['CV'];?>" target="_blank">CV</a></br>
                <a href="<?php echo $row['File_Location'].$row['Cover_Letter'];?>" target="_blank">Cover letter</a></br>
                <a href="<?php echo $row['File_Location'].$row['Qualifications'];?>" target="_blank">Qualifications Details</a></br>
                <a href="<?php echo $row['File_Location'].$row['School_Details'];?>" target="_blank">School details</a>
                </p>
            </td>
            <td>
                <p>
                <span style="font-weight: bold;">Email :</span> <?php echo $row["Email_Address"];?></br>
                <span style="font-weight: bold;">Phone :</span> <?php echo $row["Phone_No"];?>
                </p>
            </td>
            <td>
                <p>
                <span style="font-weight: bold;">Highest Qualification: </span><?php echo $row["Level_Of_Education"];?></br>
                <span style="font-weight: bold;">Years of experience: </span><?php echo $row["Work_Experience"];?></p>
            </td>
            <td><button type="button" class="btn btn-danger" onclick="rejectConfirmation('<?php echo $row['IC'];?>')">Reject</button></td>

        </tr>
        <?php
        $i++;}}
        ?>
    </table>
    <hr>
    <!-- TABLE OF PENDING-->
    <?php if(mysqli_num_rows($pending)>0){?>
        <h4>List of pending applicants</h4>
        <p>Please click on the reviewed button if applicant have met all criteria needed
        or reject button to reject the applicant.</br>
        To download all cvs please click on this button</p>
        <button type="button" class="btn btn-dark" onclick='downloadCV()'>Download CVs</button>

        <table id="listOfPendingApplicants" class="table table-hover" style="margin-top:5px">
        <tr>
            <th>No.</th>
            <th>IC number</th>
            <th>Applicant's Details</th>
            <th>Downloadable files</th>
            <th>Contact</th>
            <th>Qualification & Experience</th>
            <th></th>
            <th></th>
        </tr>

        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($pending)){
            ?>
        <tr>
            <td><?php echo $i+1; ?></td>
            <td><?php echo $row["IC"];?></td>
            <td>
                <p><span style="font-weight: bold;"> Name : </span><?php echo $row["Full_Name"];?></br>
                <span style="font-weight: bold;">DOB : </span><?php echo $row["DOB"];?></br>
                <span style="font-weight: bold;">Gender : </span><?php echo $row["Gender"];?></br>
                <span style="font-weight: bold;">Nationality : </span><?php echo $row["Nationality"];?></p>
            </td>
            <td>
                <p>
                <a href="<?php echo $row['File_Location'].$row['Id_Passport'];?>" target="_blank">National ID/Passport</a></br>
                <a href="<?php echo $row['File_Location'].$row['CV'];?>" target="_blank">CV</a></br>
                <a href="<?php echo $row['File_Location'].$row['Cover_Letter'];?>" target="_blank">Cover letter</a></br>
                <a href="<?php echo $row['File_Location'].$row['Qualifications'];?>" target="_blank">Qualifications Details</a></br>
                <a href="<?php echo $row['File_Location'].$row['School_Details'];?>" target="_blank">School details</a>
                </p>
            </td>
            <td>
                <p>
                <span style="font-weight: bold;">Email :</span> <?php echo $row["Email_Address"];?></br>
                <span style="font-weight: bold;">Phone :</span> <?php echo $row["Phone_No"];?>
                </p>
            </td>
            <td>
                <p>
                <span style="font-weight: bold;">Highest Qualification: </span><?php echo $row["Level_Of_Education"];?></br>
                <span style="font-weight: bold;">Years of experience: </span><?php echo $row["Work_Experience"];?></p>
            </td>
            <td><button type="button" class="btn btn-danger" onclick="rejectConfirmation('<?php echo $row['IC'];?>')">Reject</button></td>
            <td><button type="button" class="btn btn-success" onclick="reviewedConfirmation('<?php echo $row['IC'];?>')">Reviewed</button></td>

        </tr>
        <?php
        $i++;}?>
    </table>
    
    <?php
    }
    else{
        echo "<h4>No pending applicant found</h4>";
    }
    ?>
    <hr>
    <!-- TABLE OF AUTO REJECTED PEOPLE-->
    <?php if(mysqli_num_rows($rejected)>0){?>
        <h4>List of rejected applicants</h4>
        <p>Below are a table of applicants that will be <span style="font-weight: bold;">rejected</span> as they do not meet the requirements
        or were manually rejected.</br>
        These applicants will receive a rejection email and this table will be cleared 7 days after the closing date.</br>
        <p>Click on the retrieve button to retrieve the applicant from the rejected table.</p>
        <table id="listOfApplicants" class="table table-danger">
        <tr>
            <th>No.</th>
            <th>IC number</th>
            <th>Applicant's Details</th>
            <th>Downloadable files</th>
            <th>Contact</th>
            <th>Qualification & Experience</th>
            <th></th>
        </tr>

        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($rejected)){
            ?>
        <tr>
            <td><?php echo $i+1; ?></td>
            <td><?php echo $row["IC"];?></td>
            <td>
                <p><span style="font-weight: bold;"> Name : </span><?php echo $row["Full_Name"];?></br>
                <span style="font-weight: bold;">DOB : </span><?php echo $row["DOB"];?></br>
                <span style="font-weight: bold;">Gender : </span><?php echo $row["Gender"];?></br>
                <span style="font-weight: bold;">Nationality : </span><?php echo $row["Nationality"];?></p>
            </td>
            <td>
                <p>
                <a href="<?php echo $row['File_Location'].$row['Id_Passport'];?>" target="_blank">National ID/Passport</a></br>
                <a href="<?php echo $row['File_Location'].$row['CV'];?>" target="_blank">CV</a></br>
                <a href="<?php echo $row['File_Location'].$row['Cover_Letter'];?>" target="_blank">Cover letter</a></br>
                <a href="<?php echo $row['File_Location'].$row['Qualifications'];?>" target="_blank">Qualifications Details</a></br>
                <a href="<?php echo $row['File_Location'].$row['School_Details'];?>" target="_blank">School details</a>
                </p>
            </td>
            <td>
                <p>
                <span style="font-weight: bold;">Email :</span> <?php echo $row["Email_Address"];?></br>
                <span style="font-weight: bold;">Phone :</span> <?php echo $row["Phone_No"];?>
                </p>
            </td>
            <td>
                <p>
                <span style="font-weight: bold;">Highest Qualification: </span><?php echo $row["Level_Of_Education"];?></br>
                <span style="font-weight: bold;">Years of experience: </span><?php echo $row["Work_Experience"];?></p>
            </td>
            <td><button type="button" class="btn btn-danger" onclick="retrieveConfirmation('<?php echo $row['IC'];?>')">Retrieve</button></td>
        </tr>
        <?php
        $i++;}
        }?>
    </table>

    <!--create a php function that compares the date and auto delete the applicants and send reject emails to applicants after a certain date-->
    <?php 
    $today = date("Y-m-d");
    $closeDate = date($closeDate);//initialize closing date
    $rejectDate = strtotime("+7 day", strtotime($closeDate));//add 7 days into closing date to make rejection date
    $rejectDate = date("Y-m-d", $rejectDate); 

    if ($rejectDate < $today){
    include("sendRejectionMail.php");
    }
    ?>
    </section>

    <script>
        function retrieveConfirmation(IC) {
            var r = confirm("Are you sure you want to retrieve this applicant?");
            if (r == true) {
            location.href = 'retrieveApplicant.php?IC='+IC+'&jobName=<?php echo $jobName;?>&department=<?php echo $department?>';
            } 
        }  

        function rejectConfirmation(IC) {
            var r = confirm("Are you sure you want to reject this applicant?");
            if (r == true) {
                location.href = 'rejected.php?IC='+IC+'&jobName=<?php echo $jobName;?>&department=<?php echo $department?>';
            } 
        }  
        function reviewedConfirmation(IC) {
            var r = confirm("This applicant will be marked reviwed and will go through the next stage. \nPlease click ok to proceed and cancel to exit.");
            if (r == true) {
                location.href = 'reviewed.php?IC='+IC+'&jobName=<?php echo $jobName;?>&department=<?php echo $department?>';
            } 
        }  

        function downloadCV(){
            location.href='downloadCV.php?jobName=<?php echo $jobName?>&department=<?php echo $department?>';
            //location.href='index.php';
        }
    </script>
</body>

</html>