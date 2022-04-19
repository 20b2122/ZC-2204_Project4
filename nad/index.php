<?php
require 'database.php';

$today = date("Y-m-d");

$result = mysqli_query($conn, "SELECT * FROM job WHERE closeDate>='".$today."'");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="main.css" />
    <link
    rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous"
    />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <title>Main Page</title>
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
                <a onclick="location.href='login.php'" class="nav-link">Recruiter Page</a>
            </li>
        </ul>
    </div>
    <div class="text-right" >
      <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="btn bg-primary nav-link" href="login_applicant.html">Login</a> 
          </li>
      </ul>
  </div>
    </nav> <br/>

    <h2 style="text-align: center;">Career opportunities in UBD</h2> </br>
        
      
      <div class="bs-example">
      <div class="container">
      <div class="row">
      <div class="col-md-12">
      <div class="page-header clearfix">
      <h3 class="pull-left">Available Jobs</h3>
      </div>


      <?php
      if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_array($result)) {
      ?>
      <table class="table table-bordered">
        <tr>
            <td>
        <div class="container">
            <div class="row">
                <div class="col-11"><h3> <?php echo $row["jobName"];?></h3></div>
                <div class="col-2"><img src="ubdLogo.jpg" alt="ubd logo" class="logo"></div>
                <div class="col-4">
                    <span style="font-weight: bold;">Number of available position : </span><?php echo $row['quota'];?><br>
                    <span style="font-weight: bold;">Average salary :</span> BND <?php echo $row['salary'];?> per annum <br>
                    <span style="font-weight: bold;">Closing Date (yyyy-mm-dd): </span><?php echo $row['closeDate'];?> <br>
                    <span style="font-weight: bold;">Employement type : </span> <?php echo $row['jType'];?> <br>
                    <span style="font-weight: bold;">Working hours : </span> 
                    <?php echo date('H:i',strtotime($row["startTime"]));?> - <?php echo date('H:i',strtotime($row["endTime"]));?>
                    <br>
                    
                </div>
                <div class="col-4">
                    <span style="font-weight: bold;">Category:</span> <?php echo $row['jCategory'];?><br>
                    <span style="font-weight: bold;">Department / Faculty :</span> <?php echo $row['department'];?><br>
                    <span style="font-weight: bold;">Minimum qualification needed :</span> <?php echo $row['minQualification'];?> <br>
                    <span style="font-weight: bold;">Number of years of experience needed : </span> <?php echo $row['numExperience'];?> <br>
                    <br>
                    <button onclick="viewJobDetails('<?php echo $row['jobName'];?>', '<?php echo $row['department'];?>' )" type="button" class="btn btn-primary btn-lg" style="float: right;">
                    View details
                    </button>
                </div>
            </div>
        </div>
      </td>
      </tr>
      
      <?php
      }
      ?>
      </table>
      <?php
      }
      else{
      echo "There is no jobs available at the moment. Please come back again!";
      }
      ?>
      </div>
      </div>        
      </div>
      </div>
      <br>
      <div class="col-md-12 text-center">
      </div>

    <script>
        function viewJobDetails(jobName , department){
            window.location.href = "jobDetails.php?jobName="+jobName+"&department="+department;
        }
    </script>
    
    


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>  

    <footer class="bg-dark text-center text-white">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2022 Created by:
        <a class="text-white" href="">Project 4 students</a>
        </div>
        <!-- Copyright -->
        </footer>
  
  </body>
</html>