<?php

session_start();
$jobName = $_GET['jobName'];

include('database.php');

$username = $_POST['username'];
$password = $_POST['password_1'];

$message = [];

if (isset($_POST['reg_user']) && $_POST['reg_user'] == 'Submit') {

    // check if the username field is empty
    if (empty($username)) {
        $message[] = "Username is required";
    }

    // check if the password field is empty
    if (empty($password)) {
        $message[] = "Password is required";
    }

    //Checking password
    //retireve from the row then compare from the user input to database
    if(count($message) == 0){
        $sql = "SELECT * FROM applicant WHERE username='$username' AND password_1='$password' ";
        $results = mysqli_query($conn, $sql);

        if (mysqli_num_rows($results)) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "Logged in successfully";
            echo "<h1 style='text-align: center; margin-top: 10px;'>Welcome " . $username . "!</h1>";
            header('location: testing.php?jobName='.$jobName);
        } else {
            $message[] = "Wrong username/password combination, please try again";
        }
    }
}

echo "<h3 style='text-align: center; margin-top: 10px;'>" . implode(", ", $message) . "</h3>";

$_SESSION['message'] = $message;

if (isset($_GET['logout'])){

    session_destroy();
    unset($_SESSION['username']);
    header('location: login_applicant.php?jobName='.$jobName);

}

?>

<p style="text-align:center;"><button><a href="login_applicant.php?logout='1'&jobName=<?php echo $jobName?>">Back</a></button></p>