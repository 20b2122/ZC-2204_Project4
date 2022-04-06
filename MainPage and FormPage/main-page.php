<?php
require 'database.php';

$result = mysqli_query($conn, "SELECT * FROM job");
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
      });
    </script>

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
                <a onclick="location.href='main-page.php'" class="nav-link">Main Page</a>
            </li>
        </ul>
    </div>
    <div class="text-right" >
      <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="btn bg-primary nav-link" href="login.html">Login</a>
          </li>
      </ul>
  </div>
    </nav> <br/>

    <h2 style="text-align: center;">Welcome to the Main Page</h2> </br>
        
      
      <div class="bs-example">
      <div class="container">
      <div class="row">
      <div class="col-md-12">
      <div class="page-header clearfix">
      <h3 class="pull-left">Available Jobs</h3>
      </div>


      <?php
      if (mysqli_num_rows($result) > 0) {
      ?>
      <table class='table table-bordered table-striped' style="text-align: center;">
      <tr class="table-active" style="font-weight:bold;">
      <td>Job Title</td>
      <td>Department</td>
      <td>Quota</td>
      <td>Description</td>
      <td>Minimum Qualification</td>
      <td>Years of Experience</td>
      <td>Requirements</td>
      <td>Close Date</td>
      </tr>

      <?php
      $i=0;
      while($row = mysqli_fetch_array($result)) {
      ?>
      <tr>
      <td><?php echo $row["jobName"]; ?></td>
      <td><?php echo $row["department"]; ?></td>
      <td><?php echo $row["quota"]; ?></td>
      <td><?php echo $row["jDescription"]; ?></td>
      <td><?php echo $row["minQualification"]; ?></td>
      <td><?php echo $row["numExperience"]; ?></td>
      <td><?php echo $row["jRequirements"]; ?></td>
      <td><?php echo $row["closeDate"]; ?></td>
      </tr>
      <?php
      $i++;
      }
      ?>
      </table>
      <?php
      }
      else{
      echo "No result found";
      }
      ?>
      </div>
      </div>        
      </div>
      </div>
      <br>
      <div class="col-md-12 text-center">
        <button onclick="location.href = 'form-page.php'" type="button" class="btn btn-primary btn-lg">
          Apply
        </button>
      </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>  
  
  </body>
</html>
