<?php
include("database.php");

if(isset($_POST['email'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
        
    $sql="SELECT * from recruiter where Email='".$email."'AND Password='".$password."' limit 1";
    
    $result=mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result)==1){
        echo " <h1> Successfully Logged In </h1> </br> You will be directed to the recruiter page momentarily";
        header("refresh:2 ; url = 'mainRecruiterPage.php'");
        exit();
    }
    else{
        echo " Incorrect Password </br> This page will  redirect you back to the login page.";
        header("refresh:1 ; url='login.php'");
        exit();
    }

}

?>

<!DOCTYPE html>
<head>
<title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="login.css"/>
<body>
    <div class="logo">
        <img src="UBD.png" alt="Logo">
    </div>
    <div class="loginbox">
        
        <form method="POST" action="#">
            <p>Email</p>
            <input type="text" name="email" placeholder="Enter Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter Password">
            <p><a href="forgot-pass.php">Forgot Password?</a></p>
            <input type="submit" value="Login">
        </form>
    </div>


</body>
</head>
</html>
