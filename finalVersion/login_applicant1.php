<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            background: url(wallpaper-1.png) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
    <title>Login Page</title>
    <script src="javascript.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row">
            <div style="width: 50%; background-color: white; opacity: 0.925; margin: 40px auto auto auto; border-radius: 10px;">

                <div style="width: 70%; margin: 20px auto;">
                    
                    <img src="bruneii.png" alt="UBD Logo" style="width: 80%; margin: auto auto auto 30px"><br>
                    
                    <br><h2 style="text-align: center">Login Page</h2><br>
                    
                    <form role="form" method="POST" action="login_applicant_bg1.php" class="main-form needs-validation" enctype="multipart/form-data" novalidate>
                        <div class="form-group">
                            <label>Username:</label>
                            <input type="text" name="username" class="form-control" required>
                            <div class="invalid-feedback">Please enter a valid username.</div>
                        </div>
                        
                        <div class="form-group">
                        <label>Password:</label>
                        <input type="password" name="password_1" class="form-control" required>
                        <div class="invalid-feedback">Please enter a valid password.</div>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="reg_user" class="btn btn-lg btn-success btn-block" value=Submit>
                    </div>
                </form>
                <h6>Don't have an account yet? <a href="register_applicant1.php">Register Here</a></h6><br>
                </div>
            </div>
        </div>
    </div>
</form>

</body>

</html>