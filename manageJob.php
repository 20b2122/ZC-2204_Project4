<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Job</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include("database.php");
    $selectQuery = "SELECT jobName , quota , closeDate  FROM jobs";
    $result = $con->query($selectQuery);
    ?>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <a href="#" class="navbar-brand">UBD Recruiter's page</a>
    <aside class="nav navbar-nav navbar-right">
     <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <button type="button" class="btn btn-light" onclick="location.href 
                    = 'RecruiterMainPage.html'">Main page</button>
                </li>
            </ul>
    </aside>
    </nav>
</br>
<section>
    <p>List of job currently offered:</p>
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
    <?php
    }
    else{
        echo "No result found";
    }
    ?>
    </br>
    <button type="button" class="btn btn-secondary btn-sm" onclick="location.href ='uploadJob.html'">
    Upload new job</button>
</section>

    <script>
        function productUpdate() {
            if ($("#productname").val() != null && $("#productname").val() != '') {
                // Add product to Table
                productAddToTable();
                // Clear form fields
                formClear();
                // Focus to product name field
                $("#productname").focus();
            }
        }
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
    
</body>
</html>