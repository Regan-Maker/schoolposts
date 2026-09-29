<?php
session_start();
include "./conn.php";

$articleId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $articleId = isset($_POST['article_id']) ? (int) $_POST['article_id'] : $articleId;

    if (isset($_POST['like']) && $articleId > 0) {
        $stmt = $con->prepare("UPDATE article SET likes = COALESCE(likes, 0) + 1 WHERE id = ?");
        $stmt->bind_param("i", $articleId);
        $stmt->execute();
        $stmt->close();

        header("Location: commenting.php?id=" . $articleId);
        exit;
    }

    if (isset($_POST['comment'])) {
        $commentText = trim($_POST['comment'] ?? '');

        if ($commentText !== '') {
            $checkArticleIdColumn = mysqli_query(
                $con,
                "SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'comment' AND COLUMN_NAME = 'article_id' LIMIT 1"
            );

            if ($checkArticleIdColumn && mysqli_num_rows($checkArticleIdColumn) > 0) {
                $stmt = $con->prepare("INSERT INTO comment (article_id, comments) VALUES (?, ?)");
                $stmt->bind_param("is", $articleId, $commentText);
            } else {
                $stmt = $con->prepare("INSERT INTO comment (comments) VALUES (?)");
                $stmt->bind_param("s", $commentText);
            }

            $stmt->execute();
            $stmt->close();

            header("Location: index.php?id=" . $articleId);
            exit;
        }
    }
}

if ($articleId > 0) {
    $articleResult = $con->query("SELECT * FROM article WHERE id = $articleId LIMIT 1");
} else {
    $articleResult = $con->query("SELECT * FROM article ORDER BY id DESC LIMIT 1");
}

$article = $articleResult ? $articleResult->fetch_assoc() : null;

if (!$article) {
    die("Article not found.");
}

$commentCheck = mysqli_query(
    $con,
    "SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'comment' AND COLUMN_NAME = 'article_id' LIMIT 1"
);

$commentSql = "SELECT * FROM comment ORDER BY id DESC";
if ($commentCheck && mysqli_num_rows($commentCheck) > 0 && $articleId > 0) {
    $commentSql = "SELECT * FROM comment WHERE article_id = $articleId ORDER BY id DESC";
}

$commentsResult = $con->query($commentSql);
$comments = $commentsResult ? $commentsResult->fetch_all(MYSQLI_ASSOC) : [];
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Article Comments</title>
</head>

<body style="background-color: #f5f3f3;">
    <?php include './navbar.php'; ?>
    <div class="container mt-5 mb-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="mb-3" style="text-align: center;"><?= htmlspecialchars($article['school'] ?? 'School Post') ?></h2>

                <?php if (!empty($article['img'])): ?>
                    <img src="data:image/jpeg;base64,<?= $article['img'] ?>" alt="Article image" class="img-fluid rounded mb-3" style="max-height: 500px; object-fit: cover; width: 50%;">
                <?php endif; ?>

                <p class="text-muted"><?= htmlspecialchars($article['created_at'] ?? '') ?></p>
                <p><?= htmlspecialchars($article['description'] ?? 'No description provided.') ?></p>

              <form method="post" action="likes.php" class="d-inline">
                    <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                    <input type="hidden" name="like" value="1">
                    <button type="submit" class="btn btn-outline-primary btn-sm">Like</button>
                  </form>
                  <span class="text-muted"><?= intval($article['likes'] ?? 0) ?> likes</span>

                <h4>Comments</h4>
                <?php if (count($comments) > 0): ?>
                    <?php foreach ($comments as $comment): ?>
                        <div class="border rounded p-3 mb-2 bg-light">
                            <?= htmlspecialchars($comment['comments'] ?? '') ?>
                        </div>

                            <?php include './footer.php'; ?>
                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">No comments yet. Be the first to comment.</p>
                <?php endif; ?>

                <form method="post" action="commenting.php?id=<?= $articleId ?>" class="mt-4">
                    <input type="hidden" name="article_id" value="<?= $articleId ?>">
                    <div class="mb-3">
                        <label for="comment" class="form-label">Write a comment</label>
                        <textarea class="form-control" id="comment" name="comment" rows="4" required placeholder="Leave your comment here..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Post Comment</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <?php include './footer.php'; ?>
</body>

</html>
