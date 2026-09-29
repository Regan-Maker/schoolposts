<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "./conn.php";

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    die("You must be logged in to delete an article.");
}

// Get article ID
$articleId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($articleId <= 0) {
    die("Invalid article ID.");
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
    die("You do not have permission to delete this article.");
}
$checkStmt->close();

// Delete associated comments
$deleteCommentsStmt = $con->prepare("DELETE FROM comment WHERE article_id = ?");
$deleteCommentsStmt->bind_param("i", $articleId);
$deleteCommentsStmt->execute();
$deleteCommentsStmt->close();

// Delete the article
$deleteStmt = $con->prepare("DELETE FROM article WHERE id = ? AND user_id = ?");
$deleteStmt->bind_param("ii", $articleId, $userId);

if ($deleteStmt->execute()) {
    header("Location: index.php?msg=Article deleted successfully");
    exit;
} else {
    echo "Failed to delete article: " . $deleteStmt->error;
}

$deleteStmt->close();
$con->close();
?>
