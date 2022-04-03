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
      
    <title>Form Page</title>
    
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
    </nav> <br/>
    
    <form role="form" action="form-page-bg.php" method="POST" class="main-form needs-validation" enctype="multipart/form-data" novalidate>
        <h5>APPLICANT INFORMATION</h5>
        <div class="form-group">
            <label for="Full_Name">Fullname</label>
            <input type="text" name="Full_Name" id="Full_Name" class="form-control" required>
            <div class="invalid-feedback">Please enter a valid fullname.</div>
        </div>
        
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="IC">IC Number</label>
                    <input type="text" name="IC" id="IC" class="form-control" required>
                    <div class="invalid-feedback">Please enter a valid IC Number.</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="Phone_No">Phone Number</label>
                    <input type="text" name="Phone_No" id="Phone_No" class="form-control" required>
                    <div class="invalid-feedback">Please enter a valid phone number.</div>
                </div>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="DOB">D.O.B</label> <br>
                    <input type="date" id="DOB" name="DOB" class="form-control"  required>
                    <div class="invalid-feedback">Please enter a valid date of birth.</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="Gender">Gender</label>
                    <select name="Gender" id="Gender" class="form-control" required>
                        <option value="choose" selected>-Select-</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label for="Email_Address">Email</label>
            <input type="email" name="Email_Address" id="Email_Address" class="form-control" required>
            <div class="invalid-feedback">Please enter a valid email.</div>
        </div>
        
        <br><hr><br>
        
        <h5>APPLICATION FORM</h5>

        <div class="form-group">
            <label for="jobName">Name of Job</label> 
            <select name="jobName" id="jobName" class="form-control">
                <option disabled selected>-- Select Job --</option>
                <?php
                    include "config.php";  // Using database connection file here
                    $job_options = mysqli_query($conn, "SELECT jobName From job");  // Use select query here 

                    while($results = mysqli_fetch_array($job_options))
                    {
                        echo "<option value='". $results['jobName'] ."'>" .$results['jobName'] ."</option>";  // displaying data in option menu
                    }	
                ?>  
            </select>
        </div>

        <div class="form-group">
            <label for="Level_of_Education">Level of Education</label>
            <select name="Level_of_Education" id="Level_of_Education" class="form-control">
                <option value="choose" selected>-Select-</option>
                <option value="phd">PHD</option>
                <option value="masters">Masters</option>
                <option value="degree">Degree</option>
                <option value="diploma">Diploma</option>
                <option value="alevel">A Level</option>
                <option value="olevel">O Level</option>
            </select>
        </div>

        <div class="form-group">
            <label for="Work_Experience">Years of Experience</label>
            <input type="number" name="Work_Experience" id="Work_Experience" class="form-control" min="0" required>
        </div>

        <div class="form-group">
            <label for="Major">Major</label>
            <input type="text" name="Major" id="Major" class="form-control" required>
        </div>

        <div>
            Please upload your CV here:
            <input type="file" name="CV" id="btn" class="btn">
        </div>
        <br>

        <input type="submit" id="btn" class="btn btn-success" value="Submit" style="float:right">
        <button style="float:left;"  type="button" class="btn btn-light" onclick="cancelUpload()">Cancel</button>
        <br>
    </form>

    <br>
    <br>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

    <script>
        var form = document.querySelector('.needs-validation');

        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        })

        function cancelUpload() {
            var r = confirm("Are you sure you want to cancel?");
            if (r == true) {
                window.location.href = "main-page.php";
            }
        }
    </script>

</body>
</html>

