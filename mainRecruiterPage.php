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
<body>
    <?php
    include("database.php");
    $selectQuery = "SELECT jobName , quota , closeDate  FROM job";
    $result = $con->query($selectQuery);
    ?>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a href="#" class="navbar-brand">UBD</a>
        <form class="container-fluid justify-content-start">
        <button class="btn btn-light" type="button" onclick="location.href ='main-page.html'">View applicant page</button>
  </form>
    </nav>
    
</br>
<div style="margin-left:20px;">
    <header>
        <h1>
        WELCOME TO THE RECRUITER'S MAIN PAGE
        </h1>
    </header>
    <p>Please click on the job name to view the list of applicants</p>
    <p>List of job currently offered:</p>
    <section>
    <?php if(mysqli_num_rows($result)>0){?>

    <table id="listOfJobs" class="table table-hover" >
        <tr>
            <th>No.</th>
            <th width="400">Name of job offered</th>
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
            ?>
        <tr>  
            <td><?php echo $i+1; ?></td>
            <td><a href="viewApplicants.php?jobname=<?php echo $row["jobName"];?>"><?php echo $row["jobName"];?></a></td>
            <td><?php echo $row["quota"];?></td>
            <td><?php echo $row["closeDate"];?></td>
            <td class="<?php echo $statusStyle; ?>"><?php echo $status;?></td>
            <td><input type="button" class="btn btn-danger" value="Remove" onclick="removeJob(this, <?php $row['jobName'];?>)"></td>
        </tr>
        <?php $i++;}?>
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


<script>
        /*function productUpdate() {
            if ($("#productname").val() != null && $("#productname").val() != '') {
                // Add product to Table
                productAddToTable();
                // Clear form fields
                formClear();
                // Focus to product name field
                $("#productname").focus();
            }
        }*/
        function removeJob(job) {
            var r = confirm("Are you sure you want to remove this job?");
            if (r == true) {
                DeleteJob(job);
            }
        }
        //need to make sure delete from database also
        function DeleteJob(job, jname) { 
            var p=job.parentNode.parentNode;
            p.parentNode.removeChild(p);

            <?php
            //delete data from database as well:
            $sql = "DELETE FROM jobs WHERE jobName= jname";
            if ($conn->query($sql) === TRUE) {
                echo "Record deleted successfully";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
            ?>

        }

        function status(closeDate){
            var today = new Date(y,m,d);
            if (closeDate <= today){
                msg = "OPEN";
                return msg
                $("#productname").focus();
            }
            else{
                
            }
        }
    </script>

</div>
    
</body>
</html>