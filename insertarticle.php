<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "./conn.php";

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    die("You must be logged in to create an article.");
}

// Get user ID from email
$email = $_SESSION['email'];
$userStmt = $con->prepare("SELECT id FROM users WHERE email = ?");
$userStmt->bind_param("s", $email);
$userStmt->execute();
$userResult = $userStmt->get_result();
$user = $userResult->fetch_assoc();
$userStmt->close();

if (!$user) {
    die("User not found.");
}

$userId = $user['id'];

// Get POST inputs safely
$ca = $_POST['school'] ?? '';
$cr = $_POST['created_at'] ?? date('d-m-Y H:i:s');
$de = $_POST['description'] ?? '';
$cm = $_POST['comments'] ?? '';
$li = $_POST['likes'] ?? '';

// Check required fields
if (empty($ca)) {
    die("Required fields missing.");
}

// Check uploaded image
if (!isset($_FILES['img']) || !file_exists($_FILES['img']['tmp_name'])) {
    die("Image upload failed.");
}

$imageTmpPath = $_FILES['img']['tmp_name'];
$imageContent = file_get_contents($imageTmpPath);
$img = base64_encode($imageContent);

// Set default likes value
$likes = 0;

// Prepare SQL statement
$stmt = $con->prepare("INSERT INTO article (user_id, school, created_at, `description`, img, likes) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssi", $userId, $ca, $cr, $de, $img, $likes);
// Execute
if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Failed to insert data: " . $stmt->error;
}

$stmt->close();
$con->close();
?>
