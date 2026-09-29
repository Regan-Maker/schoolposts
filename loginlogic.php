<?php
session_start();
include './conn.php';

$email = $_POST['email'];
$pass = $_POST['password'];

// var_dump($uname, $pass); return;
//hashing user password
$pashHash = md5($pass);
//checking the supplied creds against the db
$sql = "SELECT * from users where email = '$email'  and password = '$pashHash' ";

$result = mysqli_query($con,$sql);

//check if there atleast one record

$numRows = mysqli_num_rows($result);

if($numRows > 0){
    $user = mysqli_fetch_assoc($result);
    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $email;
    $_SESSION['username'] = $user['username'] ?? $email;
    //redirection
    header("location: index.php");
    exit;
}
else{
    //redirections
    header("Location: login.php?msg=Username or password incorret!");
    exit;
}
?>