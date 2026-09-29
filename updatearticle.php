<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "./conn.php";

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    die("You must be logged in to update an article.");
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request method.");
}

// Get POST inputs
$articleId = isset($_POST['article_id']) ? (int)$_POST['article_id'] : 0;
$school = $_POST['school'] ?? '';
$description = $_POST['description'] ?? '';

if ($articleId <= 0 || empty($school)) {
    die("Invalid article data.");
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

// Verify user owns this article
$checkStmt = $con->prepare("SELECT id FROM article WHERE id = ? AND user_id = ?");
$checkStmt->bind_param("ii", $articleId, $userId);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows === 0) {
    die("You do not have permission to update this article.");
}
$checkStmt->close();

// Handle image update if provided
$updateQuery = "UPDATE article SET school = ?, description = ?";
$params = [$school, $description];
$types = "ss";

if (isset($_FILES['img']) && file_exists($_FILES['img']['tmp_name'])) {
    $imageTmpPath = $_FILES['img']['tmp_name'];
    $imageContent = file_get_contents($imageTmpPath);
    $img = base64_encode($imageContent);
    $updateQuery .= ", img = ?";
    $params[] = $img;
    $types .= "s";
}

$updateQuery .= " WHERE id = ? AND user_id = ?";
$params[] = $articleId;
$params[] = $userId;
$types .= "ii";

$stmt = $con->prepare($updateQuery);
$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    header("Location: index.php?msg=Article updated successfully");
    exit;
} else {
    echo "Failed to update article: " . $stmt->error;
}

$stmt->close();
$con->close();
?>
