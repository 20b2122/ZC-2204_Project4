<?php
include("database.php");
$email = $_GET['email'];
$selectQuery = "SELECT * FROM applies WHERE Email_Address='".$email."'";
$result = $conn->query($selectQuery);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
    <style>
        body{
            background: url(wallpaper-1.png) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
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
                <a onclick="location.href='index.php'" class="nav-link">Home</a>
            </li>
        </ul>
    </div>
    </nav>
    <div class="container">
        <div class="row">
            <div style="width: 90%; background-color: white; opacity: 0.925; margin: 40px auto auto auto; border-radius: 10px; padding-bottom:30px;">
                <div style="width: 70%; margin: 20px auto;">
                    <br><h2 style="text-align: center">Applicant profile </h2><br>
                    <img src="profile.jpg" alt="profile" style="width: 18%;margin-left:40%; margin-right: 50%"><br>
                    <p>
                        <h4>Personal details:</h4>
                        <span style="font-weight:bold;">Full Name : </span> <?php echo $row['Full_Name'] ?> </br>
                        <span style="font-weight:bold;">Identity Card number : </span> <?php echo $row['IC'] ?>  </br>
                        <span style="font-weight:bold;">Gender : </span><?php echo $row['Gender'] ?> </br>
                        <span style="font-weight:bold;">Date of Birth : </span><?php echo $row['DOB'] ?> </br>
                        <span style="font-weight:bold;">Email : </span> <?php echo $email ?> </br>
                        <span style="font-weight:bold;">Phone number : </span><?php echo $row['Phone_No'] ?> </br>
                        <span style="font-weight:bold;">Nationality : </span><?php echo $row['Nationality'] ?> </br>
                    </p>
                    </br>
                    <h4>Below are the list of status of the job you have applied</h4>
<?php 
$jobs = "SELECT jobName, Status  FROM applies WHERE Email_Address='".$email."'";
$result1 = $conn->query($jobs);
if(mysqli_num_rows($result1)>0){ ?>

                <table class="table table-hover">
                        <tr>
                            <th></th>
                            <th>Job applied</th>
                            <th>Status</th>
                        </tr>

<?php
    $i=1;
    while($row1 = mysqli_fetch_array($result1)){

?>
                        <tr>
                            <th><?php echo $i ?> </th>
                            <th><?php echo $row1['jobName'] ?> </th>
                            <th><?php echo $row1['Status'] ?></th>
                        </tr>
    <?php 
    $i++;}
    ?>
                    </table>
                    <button onclick="location.href = 'index.php'" type="button" class="btn btn-dark btn-lg" style="float:right;">Back</button>
                </div>
            </div>
        </div>
    </div>
    <?php 
}
else{
    echo "<h4>No job applied</h4>";
}
?>

    <footer class="bg-dark text-center text-white"style="margin-top:50px"> 
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2022 Created by:
        <a class="text-white" href="">Project 4 students</a>
        </div>
        <!-- Copyright -->
    </footer>

</body>
</html>