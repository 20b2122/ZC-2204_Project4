<?php

$host="localhost";
$user="root";
$password="";
$db="login";

mysql_connect($host,$user,$password);
mysql_select_db($db);

if(isset($_POST['email'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
        
    $sql="select * from loginform where Email='".$email."'AND Pwd='".$password."' limit 1";
    
    $result=mysql_query($sql);
    
    if(mysql_num_rows($result)==1){
        echo " Successfully Logged In";
        exit();
    }
    else{
        echo " Incorrect Password";
        exit();
    }
}

?>

<!DOCTYPE html>
<head>
<title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
<body>
    <div class="logo">
        <img src="UBD.png" alt="Logo">
    </div>
    <div class="loginbox">
        
        <form method="POST" action="#">
            <p>Email</p>
            <input type="text" name="" placeholder="Enter Email">
            <p>Password</p>
            <input type="password" name="" placeholder="Enter Password">
            <input type="submit" name="" value="Login">
            <a href="#">Forgot your password?</a><br>
        </form>
    </div>
</body>
</head>
</html>
