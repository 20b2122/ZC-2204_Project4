<?php 

session_start();

include 'database.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password_1 = $_POST['password_1'];
$password_2 = $_POST['password_2'];

$message = [];

if (isset($_POST['reg_user']) && $_POST['reg_user'] == 'Submit') {
  
  //Checking if user already exist in the database
  $user_check = "SELECT * FROM applicant WHERE username ='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($conn, $user_check);
  $user = mysqli_fetch_assoc($result);
  
  if(empty($username) || empty($email) || empty($password_1) || empty($password_2)){
  $message[] = "Please fill in all fields";
  } else if ($user) {
    if ($user['username'] === $username) {
      $message[] = "Username already exists, please go back and register a new one";
    }
    if ($user['email'] === $email) {
      $message[] = "email already exists, please go back and register a new one";
    }
  } else if ($password_1 != $password_2){
    $message[] = "Please enter the same password";
  }
  
}



echo "<h3 style='text-align: center; margin-top: 10px;'>" . implode(", ", $message) . "</h3>";

$_SESSION['message'] = $message;

if (count($message) == 0){
  $sql = "INSERT INTO applicant (username, email, password_1, password_2) VALUES 
  ('$username', '$email', '$password_1','$password_2')";
  
  if (mysqli_query($conn, $sql)) {
    header("location: login_applicant.html");
  } else {
    echo "Error: " . $sql . ":-" . mysqli_error($conn);
  }
  mysqli_close($conn);
}

header("refresh: 5; location: register_applicanttion.html");


?>

<p style="text-align:center;"><button><a href="register_applicanttion.html?logout='1'">Back</a></button></p>