<?php
session_start();
include "./conn.php";

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
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

// Get article details
$articleStmt = $con->prepare("SELECT * FROM article WHERE id = ? AND user_id = ?");
$articleStmt->bind_param("ii", $articleId, $userId);
$articleStmt->execute();
$articleResult = $articleStmt->get_result();
$article = $articleResult->fetch_assoc();
$articleStmt->close();

if (!$article) {
    die("Article not found or you don't have permission to edit it.");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Post | SchoolStatus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body class="post-page">
    <?php include './navbar.php'; ?>
    <main class="post-shell">
        <section class="post-intro">
            <p class="eyebrow">School communications</p>
            <h1>Edit your post</h1>
            <p>Update your announcement with families, educators, and your school community.</p>
        </section>

        <section class="post-panel" aria-labelledby="post-form-title">
            <div class="post-panel-heading">
                <div>
                    <h2 id="post-form-title">Post details</h2>
                    <p>Fields marked with <span aria-hidden="true">*</span> are required.</p>
                </div>
                <span class="post-step">1 of 1</span>
            </div>

            <form method="post" action="updatearticle.php" enctype="multipart/form-data">
                <input type="hidden" name="article_id" value="<?= htmlspecialchars($article['id']) ?>">
                
                <div class="mb-4">
                    <label for="school" class="form-label">School name <span aria-hidden="true">*</span></label>
                    <input type="text" class="form-control form-control-lg" id="school" name="school" value="<?= htmlspecialchars($article['school']) ?>" placeholder="For example, Green Valley Primary School" required>
                    <div class="form-text">Use the official name your community will recognize.</div>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">What would you like to share?</label>
                    <textarea class="form-control" id="description" name="description" rows="6" placeholder="Write your announcement, event details, or school update..."><?= htmlspecialchars($article['description']) ?></textarea>
                    <div class="form-text">Keep it simple and useful. You can add dates, locations, and contact details.</div>
                </div>

                <div class="mb-4">
                    <label for="school-image" class="form-label">School image <span aria-hidden="true">*</span> <small>(Leave blank to keep current image)</small></label>
                    <label class="image-upload" for="school-image">
                        <span class="image-upload-icon" aria-hidden="true">+</span>
                        <span><strong>Choose an image</strong><br><small>JPG, PNG, or WebP recommended</small></span>
                        <input type="file" id="school-image" name="img" accept="image/jpeg,image/png,image/webp">
                    </label>
                    <div id="image-name" class="form-text">Current image shown below:</div>
                    <img id="image-preview" class="image-preview" src="data:image/jpeg;base64,<?= $article['img'] ?>" alt="Current school image" style="display: block; margin-top: 10px; max-width: 300px;">
                </div>

                <div class="post-actions">
                    <a href="index.php" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"></script>
    <script>
        const imageInput = document.getElementById('school-image');
        const imageName = document.getElementById('image-name');
        const imagePreview = document.getElementById('image-preview');

        imageInput.addEventListener('change', () => {
            const file = imageInput.files[0];
            if (!file) return;

            imageName.textContent = file.name;
            imagePreview.src = URL.createObjectURL(file);
            imagePreview.style.display = 'block';
        });
    </script>
    <?php include './footer.php'; ?>
</body>
</html>
