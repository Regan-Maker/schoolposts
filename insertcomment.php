<?php
session_start();
include "./conn.php";

$comments = $_POST['comments'];

$sql = "INSERT INTO comment (comments) VALUES (?)";

$stmt = $con->prepare($sql);
$stmt->bind_param("s", $comments);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Failed to insert data: " . $stmt->error;
}

$stmt->close();
$con->close();
?>