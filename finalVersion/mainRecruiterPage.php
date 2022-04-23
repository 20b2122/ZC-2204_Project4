<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruiter's main page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body style="font-size:15px;">
    <?php
    include("database.php");
    $selectQuery = "SELECT * FROM job ORDER BY closeDate DESC";
    $result = $conn->query($selectQuery);
    ?>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a href="#" class="navbar-brand">UBD</a>
        <form class="container-fluid justify-content-start">
        <button class="btn btn-light" type="button" onclick="viewApplicantPage()">View applicant page</button>
  </form>
    </nav>
    
</br>
<div style="margin-left:20px;">
    <header>
        <h1>
        WELCOME TO THE RECRUITER'S MAIN PAGE
        </h1>
    </header>
    <section>
    <?php if(mysqli_num_rows($result)>0){?>
    <p>Please click on the job name to view the list of applicants</br>
    Click on the delete button to delete the job offered along with the job's applicant </br>
    List of job currently offered:</p>

    <table id="listOfJobs" class="table table-hover" >
        <tr>
            <th>No.</th>
            <th>Name of job offered</th>
            <th>Department</th>
            <th>Quota</th>
            <th>Closing Date</th>
            <th>Status</th>
            <th></th>
        </tr>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($result)){
            $status = "Closed";
            $statusStyle = "status-close";
            if($row["closeDate"] >= date("Y-m-d")){
                $status = "Open";
                $statusStyle = "status-open";
            }
            $job = $row["jobName"];
            $department = $row['department'];
            ?>
        <tr>  
            <td><?php echo $i+1; ?></td>
            <td><a href="viewApplicants.php?jobname=<?php echo $job;?>&department=<?php echo $department?>">
            <?php echo $job;?></a></td>
            <td><?php echo $department;?></td>
            <td><?php echo $row["quota"];?></td>
            <td><?php echo $row["closeDate"];?></td>
            <td class="<?php echo $statusStyle; ?>"><?php echo $status;?></td>
            <td><button type="button" class="btn btn-danger" onclick="deleteJob('<?php echo $job?>')">Delete</button></td>
            <script>
            function deleteJob(job){
            var r = confirm("Are you sure you want to remove this job? \nRemoving this job will delete all other data related to it");
                if (r == true){
                    location.href ='deleteJob.php?job='+job;

                }
            }
            </script>
            
        </tr>
        <?php 
        $i++;}?>
    </table>
    </section>
    <?php
    }
    else{
        echo "There are no jobs offering currently </br>";
    }
    ?>
    </br>
    <button type="button" class="btn btn-secondary btn-sm" onclick="location.href ='uploadJob.html'">
    Upload new job</button>
</div>




<script>
    function viewApplicantPage() {
            var r = confirm("Are you sure you want to leave the recruiter's page? \nLeaving this page will log you off");
            if (r == true) {
                window.location.href = "index.php";
            }
        }
</script>
</body>
</html>