<?php
session_start();
include "./conn.php";

// Enable error display
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Make sure the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get data from form
    $un = $_POST['username'];
    $tn = $_POST['telephone'];
    $ea = $_POST['email'];
    $pw = $_POST['password'];

    // Check if any field is empty
    if (empty($un) || empty($tn) || empty($ea) || empty($pw)) {
        die("All fields are required!");
    }

    // Hash password
    $passHash = md5($pw);

    // SQL INSERT
    $sql = "INSERT INTO users (username, telephone, email, password)
            VALUES ('$un', '$tn', '$ea', '$passHash')";

    $insert = mysqli_query($con, $sql);

    if ($insert) {
        header("Location: login.php");
        exit;
    } else {
        echo "Failed to insert data: " . mysqli_error($con);
    }
}
?>
