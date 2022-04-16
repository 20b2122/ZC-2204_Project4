<?php
include("database.php");
$job = $_GET['jobName'];
$department = $_GET['department'];
$selectQuery = "SELECT * FROM job WHERE jobName='".$job."' AND department='".$department."'";
$result = $conn->query($selectQuery);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job details for <?php echo $job ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="main.css" />
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
      <a href="#" class="navbar-brand">UBD</a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a onclick="location.href='index.php'" class="nav-link">Main Page</a>
            </li>
        </ul>
    </div>
    <div class="text-right" >
      <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="btn bg-primary nav-link" href="login.php">Login</a> <!-- must change the location, this was for testing purposes-->
          </li>
      </ul>
    </div>
    </nav> <br/>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12" style="padding-bottom: 20px;"><h2> <?php echo $row["jobName"];?></h2></div>
                <div class="col-2"><img src="ubdLogo.jpg" alt="ubd logo" class="logo"></div>
                <div class="col-4">
                    <span style="font-weight: bold;">Number of available position : </span><?php echo $row['quota'];?><br>
                    <span style="font-weight: bold;">Average salary :</span> BND <?php echo $row['salary'];?> per annum <br>
                    <span style="font-weight: bold;">Closing Date </span> (yyyy-mm-dd) : <?php echo $row['closeDate'];?> <br>
                    <span style="font-weight: bold;">Employement type : </span> <?php echo $row['jType'];?> <br>
                    <span style="font-weight: bold;">Working hours : </span> 
                    <?php echo date('H:i',strtotime($row["startTime"]));?> - <?php echo date('H:i',strtotime($row["endTime"]));?>
                    <br>
                    
                </div>
                <div class="col-4">
                    <span style="font-weight: bold;">Department / Faculty :</span> <?php echo $row['department'];?><br>
                    <span style="font-weight: bold;">Minimum qualification needed :</span> <?php echo $row['minQualification'];?> <br>
                    <span style="font-weight: bold;">Number of years of experience needed : </span> <?php echo $row['numExperience'];?> <br>
                    <br>
                </div>
            </div>
        </div>
<br>
<hr>
<br>
        <div class="container">
            <div class="row">
                <div class="col-12" style="padding-bottom: 20px; text-align:center;"><h3>Job Details</h3></div>
                <div class="col-12">
                    <h4>Job description:</h4>
                    <?php echo $row['jDescription'];?>
                </div>  
                <div class="col-12">
                    <br>
                    <h4>Job requirements:</h4>
                    <?php echo $row['jRequirements'];?>
                </div>    
            </div>
        </div>

        <?php

        $selectQuery1 = "SELECT * FROM manages WHERE jobName='".$job."' AND department='".$department."'";
        $result1 = $conn->query($selectQuery1);
        $row1 = mysqli_fetch_assoc($result1);

        ?>
<br>
<hr>
        <div class="container">
            <div class="row">
                <div class="col-12" style="padding-bottom: 20px;"><h4>Job enquiries</h4></div>
                <div class="col-12">
                    <p>If you have any enquiries about the vacancy, shortlisting and interviews, please contact:</p>
                    <p> Name : <?php echo $row1['recName'];?> <br>
                     Email : <?php echo $row1['recEmail'];?> </p>
                    <input type="button" id="btn" class="btn btn-success" value="Apply Job" style="float:right; margin-bottom: 20px;">
                    <br>

                </div>    
            </div>
        </div>


    <footer class="bg-dark text-center text-white">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2022 Created by:
        <a class="text-white" href="">Project 4 students</a>
        </div>
        <!-- Copyright -->
        </footer>


    

    </section>

    
</body>
</html>