<?php
$job = $_GET['jobname'];
include("database.php");
$selectQuery = "SELECT * FROM job WHERE jobName='".$job."'";
$result = $conn->query($selectQuery);
$getRowAssoc = mysqli_fetch_assoc($result);

$minQualification = $getRowAssoc['minQualification'];
$numExperience = $getRowAssoc['numExperience'];
$closeDate = $getRowAssoc['closeDate'];

$selectQuery1 = "SELECT * FROM applicant WHERE jobName='".$job."'"
."AND Applicant_status='PENDING' ORDER BY Level_of_Education_Index DESC , Work_Experience DESC";
$pending = $conn->query($selectQuery1);
$selectQuery2 = "SELECT * FROM applicant WHERE jobName='".$job."'"
."AND Applicant_status='REJECTED' ORDER BY Level_of_Education_Index DESC , Work_Experience DESC";
$rejected = $conn->query($selectQuery2);
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
    <h2>List of applicants for <?php echo $job ?> </h2>
    <p>This table is sorted according to the highest qualification and years of experience.</br>
    The minimum qualification for this job is <span style="font-weight: bold;"><?php echo $minQualification?></span>
    and the minimum years of experience needed are <span style="font-weight: bold;">
    <?php echo $numExperience ?> years.</span></p>
    <?php if(mysqli_num_rows($pending)>0){?>
        <p>Please click on the reject button to reject the applicant </p>
        <table id="listOfApplicants" class="table table-hover">
        <tr>
            <th>No.</th>
            <th>IC number</th>
            <th>Name of applicant</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Downloadable files</th>
            <th>Email</th>
            <th>Highest Qualification</th>
            <th>Year of experience </th>
            <th></th>
        </tr>

        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($pending)){
            ?>
        <tr>
            <td><?php echo $i+1; ?></td>
            <td><?php echo $row["IC"];?></td>
            <td><?php echo $row["Full_Name"];?></td>
            <td><?php echo $row["Gender"];?></td>
            <td><?php echo $row["DOB"];?></td>
            <td><?php echo $row["CV"];?></td>
            <td><?php echo $row["Email_Address"];?></td>
            <td><?php echo $row["Level_of_Education"];?></td>
            <td><?php echo $row["Work_Experience"];?></td>
            <td><button type="button" class="btn btn-danger" onclick="rejectConfirmation()">Reject</button></td>

            <script>
            function rejectConfirmation() {
                var r = confirm("Are you sure you want to reject this applicant?");
                if (r == true) {
                    location.href = 'rejected.php?IC=<?php echo $row["IC"]?>&jobName=<?php echo $job?>'
                } 
            }  
            </script>

        </tr>
        <?php
        $i++;}?>
    </table>
    <?php
    }
    else{
        echo "No applicant found";
    }
    ?>
    <!-- TABLE OF AUTO REJECTED PEOPLE-->
    <h2>List of rejected applicants</h2>
    <p>Below are a table of applicants that will be <span style="font-weight: bold;">rejected</span> as they do not meet the requirements
    or were manually rejected.</br>
    These applicants will receive a rejection email and this table will be cleared 7 days after the closing date.</br>
    <?php if(mysqli_num_rows($rejected)>0){?>

        <p>Please click on the retrieve button to retrieve the applicant from the rejected table</p>
        <table id="listOfApplicants" class="table table-danger">
        <tr>
            <th>No.</th>
            <th>IC number</th>
            <th>Name of applicant</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Downloadable files</th>
            <th>Email</th>
            <th>Highest Qualification</th>
            <th>Year of experience </th>
            <th></th>
        </tr>

        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($rejected)){
            ?>
        <tr>
            <td><?php echo $i+1; ?></td>
            <td><?php echo $row["IC"];?></td>
            <td><?php echo $row["Full_Name"];?></td>
            <td><?php echo $row["Gender"];?></td>
            <td><?php echo $row["DOB"];?></td>
            <td><?php echo $row["CV"];?></td>
            <td><?php echo $row["Email_Address"];?></td>
            <td><?php echo $row["Level_of_Education"];?></td>
            <td><?php echo $row["Work_Experience"];?></td>
            <td><button type="button" class="btn btn-danger" onclick="retrieveConfirmation()">Retrieve</button></td>

            <script>
            function retrieveConfirmation() {
                var r = confirm("Are you sure you want to retrieve this applicant?");
                if (r == true) {
                    location.href = 'retrieveApplicant.php?IC=<?php echo $row["IC"]?>&jobName=<?php echo $job?>'
                } 
            }  
            </script>



        </tr>
        <?php
        $i++;}?>
    </table>
    <?php
    }
    else{
        echo "No rejected applicant found";
    }
    ?>

    <!--create a php function that compares the date and auto delete the applicants and send reject emails to applicants after a certain date-->
    <?php 
    $today = date("Y-m-d");
    $closeDate = date($closeDate);//initialize closing date
    $rejectDate = strtotime("+7 day", strtotime($closeDate));//add 7 days into closing date to make rejection date
    $rejectDate = date("Y-m-d", $rejectDate); 

    if ($rejectDate == $today){
      include ('sendRejectionMail.php');
    }
    ?>
    </section>
</body>

</html>