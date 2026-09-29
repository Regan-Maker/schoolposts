<?php
session_start();
include "./conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $articleId = isset($_POST['article_id']) ? (int) $_POST['article_id'] : 0;
    $action = $_POST['action'] ?? '';

    if ($articleId > 0 && in_array($action, ['like', 'unlike', 'dislike', 'undislike'], true)) {
        if (!isset($_SESSION['article_reactions']) || !is_array($_SESSION['article_reactions'])) {
            $_SESSION['article_reactions'] = [];
        }

        $currentReaction = $_SESSION['article_reactions'][$articleId] ?? null;
        $likeDelta = 0;
        $dislikeDelta = 0;

        if ($action === 'like') {
            if ($currentReaction === 'like') {
                $likeDelta = -1;
                unset($_SESSION['article_reactions'][$articleId]);
            } else {
                if ($currentReaction === 'dislike') {
                    $dislikeDelta = -1;
                }
                $_SESSION['article_reactions'][$articleId] = 'like';
                $likeDelta = 1;
            }
        }

        if ($action === 'dislike') {
            if ($currentReaction === 'dislike') {
                $dislikeDelta = -1;
                unset($_SESSION['article_reactions'][$articleId]);
            } else {
                if ($currentReaction === 'like') {
                    $likeDelta = -1;
                }
                $_SESSION['article_reactions'][$articleId] = 'dislike';
                $dislikeDelta = 1;
            }
        }

        if ($likeDelta !== 0) {
            $stmt = $con->prepare("UPDATE article SET likes = GREATEST(COALESCE(likes, 0) + ?, 0) WHERE id = ?");
            $stmt->bind_param("ii", $likeDelta, $articleId);
            $stmt->execute();
            $stmt->close();
        }

        if ($dislikeDelta !== 0) {
            $stmt = $con->prepare("UPDATE article SET dislikes = GREATEST(COALESCE(dislikes, 0) + ?, 0) WHERE id = ?");
            $stmt->bind_param("ii", $dislikeDelta, $articleId);
            $stmt->execute();
            $stmt->close();
        }
    }

    header("Location: index.php");
    exit;
}

$articleId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($articleId <= 0) {
    header("Location: index.php");
    exit;
}

$stmt = $con->prepare("SELECT id, school, img, likes, dislikes FROM article WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $articleId);
$stmt->execute();
$article = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$article) {
    http_response_code(404);
    exit("Post not found.");
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
	<title>React to post</title>
</head>
<body style="background-color: whitesmoke;">
	<?php include './navbar.php'; ?>
	<main class="container mt-5">
		<div class="card shadow-sm mx-auto" style="max-width: 600px;">
			<?php if (!empty($article['img'])): ?>
				<img src="data:image/jpeg;base64,<?= htmlspecialchars($article['img']) ?>" alt="<?= htmlspecialchars($article['school']) ?>" class="card-img-top" style="max-height: 400px; object-fit: cover;">
			<?php endif; ?>
			<div class="card-body text-center">
				<h1 class="h3"><?= htmlspecialchars($article['school']) ?></h1>
				<form method="post" action="likes.php">
					<input type="hidden" name="article_id" value="<?= $article['id'] ?>">
					<input type="hidden" name="action" value="<?= (($_SESSION['article_reactions'][$articleId] ?? null) === 'like') ? 'unlike' : 'like' ?>">
					<button type="submit" class="btn btn-primary"><?= (($_SESSION['article_reactions'][$articleId] ?? null) === 'like') ? 'Unlike' : 'Like' ?></button>
					<span class="ms-2 text-muted"><?= (int) $article['likes'] ?> likes</span>
				</form>
				<form method="post" action="likes.php" class="mt-3">
					<input type="hidden" name="article_id" value="<?= $article['id'] ?>">
					<input type="hidden" name="action" value="<?= (($_SESSION['article_reactions'][$articleId] ?? null) === 'dislike') ? 'undislike' : 'dislike' ?>">
					<button type="submit" class="btn btn-outline-danger"><?= (($_SESSION['article_reactions'][$articleId] ?? null) === 'dislike') ? 'Undislike' : 'Dislike' ?></button>
					<span class="ms-2 text-muted"><?= (int) $article['dislikes'] ?> dislikes</span>
				</form>
                <a href="index.php" class="btn btn-link mt-3">Back to posts</a>
			</div>
		</div>
	</main>
	<?php include './footer.php'; ?>
</body>
</html>
