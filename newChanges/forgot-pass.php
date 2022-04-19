<?php

require 'database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="login.css"/>


</head>
<body>
    
<div class="logo">
        <img src="UBD.png" alt="Logo">
    </div>
    <div class="loginbox">
        
        <form method="POST" action="#">
            <p>Email</p>
            <input type="email" name="email" placeholder="Enter Email">
            <input type="submit" value="Get password">
        </form>
    </div>
    
</body>
</html>


<?php

if(isset($_POST['email'])){
    $email = $_POST['email'];

    $sql_query2 = mysqli_query($conn, "SELECT Email, Password, name From recruiter WHERE Email='".$email."'");
        if (mysqli_num_rows($sql_query2)>0){
            while($row = mysqli_fetch_array($sql_query2)){
        
        $to_email = $email;
        
        $subject = "Forgotten Password ";
        $body = "Hi ". $row['name'] . ",
        Your password is ". $row['Password'] . "
        ";

        $headers = "From: ubdTesting123@gmail.com"; 


        if(mail($to_email, $subject, $body, $headers)){
            echo("Your password successfully send to $to_email </br>");
            //header('refresh:1 ; url=login.php');
        } else {
            echo("Email failed to send");
        }
    }
}
else{
    echo "<h1>This email address is not in our system</h1>";
    //header('refresh:1 ; url = login.php');

}
}

?>