<?php
session_start();
include "./conn.php";

// Get current user ID if logged in
$currentUserId = null;
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $userStmt = $con->prepare("SELECT id FROM users WHERE email = ?");
    $userStmt->bind_param("s", $email);
    $userStmt->execute();
    $userResult = $userStmt->get_result();
    $user = $userResult->fetch_assoc();
    if ($user) {
        $currentUserId = $user['id'];
    }
    $userStmt->close();
}

// Debug: Display current user ID
if (isset($_SESSION['email'])) {
    echo "<!-- DEBUG: Current user ID: " . $currentUserId . " | Email: " . htmlspecialchars($_SESSION['email']) . " -->";
}

function columnExists(mysqli $con, string $table, string $column): bool
{
  $result = mysqli_query(
    $con,
    "SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = '$table' AND COLUMN_NAME = '$column' LIMIT 1"
  );

  return $result && mysqli_num_rows($result) > 0;
}

if (columnExists($con, 'article', 'dislikes') === false) {
  mysqli_query($con, "ALTER TABLE article ADD COLUMN dislikes INT DEFAULT 0");
}

if (columnExists($con, 'article', 'user_id') === false) {
  mysqli_query($con, "ALTER TABLE article ADD COLUMN user_id INT DEFAULT 0");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $articleId = isset($_POST['article_id']) ? (int) $_POST['article_id'] : 0;
  $commentText = trim($_POST['comment'] ?? '');

  if (isset($_POST['like']) && $articleId > 0) {
    $likeStmt = $con->prepare("UPDATE article SET likes = COALESCE(likes, 0) + 1 WHERE id = ?");
    $likeStmt->bind_param("i", $articleId);
    $likeStmt->execute();
    $likeStmt->close();
  }

  if (isset($_POST['dislike']) && $articleId > 0) {
    $dislikeStmt = $con->prepare("UPDATE article SET dislikes = COALESCE(dislikes, 0) + 1 WHERE id = ?");
     $dislikeStmt->bind_param("i", $articleId);
    $dislikeStmt->execute();
    $dislikeStmt->close();
  }

  if ($commentText !== '' && $articleId > 0) {
    if (columnExists($con, 'comment', 'article_id')) {
      $commentStmt = $con->prepare("INSERT INTO comment (article_id, comments) VALUES (?, ?)");
      $commentStmt->bind_param("is", $articleId, $commentText);
    } else {
      $commentStmt = $con->prepare("INSERT INTO comment (comments) VALUES (?)");
      $commentStmt->bind_param("s", $commentText);
    }

    $commentStmt->execute();
    $commentStmt->close();
  }

  if (!empty($_POST['like']) || !empty($_POST['dislike']) || $commentText !== '') {
    header("Location: index.php");
    exit;
  }
}

$sql = "SELECT * FROM article ORDER BY id DESC";
$res = mysqli_query($con, $sql);

if ($res) {
  $res = mysqli_fetch_all($res, MYSQLI_ASSOC);
} else {
  echo "Failed: " . mysqli_error($con);
}

$commentCounts = [];
$commentPreviews = [];
$articleHasCommentId = columnExists($con, 'comment', 'article_id');

if (!empty($res)) {
  $articleIds = array_map('intval', array_column($res, 'id'));

  if ($articleHasCommentId && !empty($articleIds)) {
    $articleIdList = implode(',', $articleIds);

    $commentCountSql = "SELECT article_id, COUNT(*) AS total FROM comment WHERE article_id IN ($articleIdList) GROUP BY article_id";
    $commentCountResult = mysqli_query($con, $commentCountSql);

    if ($commentCountResult) {
      while ($row = mysqli_fetch_assoc($commentCountResult)) {
        $commentCounts[(int) $row['article_id']] = (int) $row['total'];
      }
    }

    $previewSql = "SELECT article_id, comments FROM comment WHERE article_id IN ($articleIdList) ORDER BY id DESC";
    $previewResult = mysqli_query($con, $previewSql);

    if ($previewResult) {
      while ($row = mysqli_fetch_assoc($previewResult)) {
        $articleId = (int) $row['article_id'];
        if (!isset($commentPreviews[$articleId])) {
          $commentPreviews[$articleId] = [];
        }

        if (count($commentPreviews[$articleId]) < 3) {
          $commentPreviews[$articleId][] = trim($row['comments'] ?? '');
        }
      }
    }
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="style.css">
  <title>Homepage</title>
</head>

<body class="home-page">
  <?php include './navbar.php'; ?>
  <a href="https://wa.me/256703799819?text=Hello%20SchoolStatus" class="whatsapp-float" target="_blank" rel="noopener noreferrer" aria-label="Chat with us on WhatsApp">
    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
      <path fill="currentColor" d="M16.002 3.005c-7.18 0-13.002 5.82-13.002 13 0 2.29.598 4.54 1.73 6.52L3 29l6.64-1.74a12.95 12.95 0 0 0 6.36 1.68h.01c7.18 0 13-5.82 13-13s-5.82-13-13-13zm0 23.6h-.01a10.56 10.56 0 0 1-5.39-1.48l-.39-.23-3.94 1.03 1.05-3.84-.25-.39A10.56 10.56 0 0 1 5.4 16.005c0-5.83 4.75-10.58 10.6-10.58 2.83 0 5.5 1.1 7.5 3.1a10.54 10.54 0 0 1 3.1 7.5c0 5.83-4.75 10.58-10.6 10.58zm5.82-7.92c-.32-.16-1.88-.93-2.17-1.03-.29-.11-.5-.16-.71.16s-.82 1.03-1 1.25-.36.25-.68.08c-.32-.16-1.34-.5-2.56-1.58-.95-.84-1.58-1.88-1.77-2.2-.18-.32-.02-.5.14-.66.14-.14.32-.36.48-.54.16-.18.21-.32.32-.53.11-.21.05-.39-.03-.54-.08-.16-.71-1.71-.97-2.34-.26-.62-.52-.54-.71-.54h-.61c-.21 0-.54.08-.82.39s-1.08 1.06-1.08 2.58 1.1 3 1.26 3.2c.16.21 2.17 3.32 5.26 4.66.73.32 1.3.5 1.75.64.73.23 1.4.2 1.93.12.59-.09 1.88-.77 2.15-1.51.26-.74.26-1.38.18-1.51-.08-.13-.29-.21-.61-.36z"/>
    </svg>
  </a>

  <main>
    <section class="home-hero">
      <div class="home-container home-hero-grid">
        <div class="home-hero-copy">
          <p class="home-kicker">School communication, made clearer</p>
          <h1>Register Your School To Be Visisble To The World With Us</h1>
          <p>SchoolStatus saves time and simplifies how you connect with your school community.</p>
          <div class="home-hero-actions">
            <a href="documents/SchoolStatus_User_Guide.pdf" class="home-button home-button-primary" download>Download User Guide (PDF)</a>
            <a href="users.php" class="home-button home-button-quiet">Explore schools</a>
          </div>
        </div>
        <div class="home-hero-media">
          <img src="images/Pic1.webp" alt="SchoolStatus community communication">
          <div class="home-hero-note"><strong>One connected community</strong><span>Updates, stories, and conversations in one place.</span></div>
        </div>
      </div>
    </section>

    <section id="schools" class="home-section schools-section">
      <div class="home-container">
        <div class="section-heading section-heading-row">
          <div><p class="home-kicker">Discover your community</p><h2>LIST OF SCHOOLS</h2></div>
          <a href="article.php" class="home-button home-button-primary">Create Post For Your School</a>
        </div>
        <div class="school-feed">
          <?php foreach ($res as $article) { ?>
            <?php $commentTotal = $commentCounts[(int) $article['id']] ?? 0; ?>
            <?php $isOwner = $currentUserId && (int)$article['user_id'] === $currentUserId; ?>
            <!-- DEBUG: Article ID: <?= $article['id'] ?> | user_id: <?= $article['user_id'] ?? 'NOT SET' ?> | currentUserId: <?= $currentUserId ?> | isOwner: <?= $isOwner ? 'true' : 'false' ?> -->
            <article class="school-card">
              <div class="school-card-image"><img src="data:image/jpeg;base64,<?= $article['img'] ?>" alt="<?= htmlspecialchars($article['school']) ?>"></div>
              <div class="school-card-content">
                <div class="school-card-meta"><span>School post</span><time><?= htmlspecialchars($article['created_at']) ?></time>
                  <?php if ($isOwner): ?>
                    <div class="card-actions" style="display: inline-block; margin-left: 10px;">
                      <a href="edit_article.php?id=<?= $article['id'] ?>" class="btn btn-sm btn-warning" style="padding: 2px 8px; font-size: 12px;">Edit</a>
                      <a href="deletearticle.php?id=<?= $article['id'] ?>" class="btn btn-sm btn-danger" style="padding: 2px 8px; font-size: 12px;" onclick="return confirm('Are you sure you want to delete this article? This action cannot be undone.');">Delete</a>
                    </div>
                  <?php endif; ?>
                </div>
                <h3><?= htmlspecialchars($article['school']) ?></h3>
                <p class="school-description"><?= !empty($article['description']) ? htmlspecialchars($article['description']) : '<em>No description provided</em>' ?></p>
                <div class="school-card-actions">
                  <a href="commenting.php?id=<?= $article['id'] ?>" class="interaction-link">
                    <i class="bi bi-chat-dots"></i>
                    <span><?= $commentTotal ?> comments</span>
                  </a>

                  <?php
                    $currentReaction = $_SESSION['article_reactions'][ (int) $article['id'] ] ?? null;
                    $likeActiveClass = $currentReaction === 'like' ? 'active' : '';
                    $dislikeActiveClass = $currentReaction === 'dislike' ? 'active' : '';
                  ?>

                  <form method="post" action="likes.php" class="reaction-form">
                    <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                    <input type="hidden" name="action" value="<?= $currentReaction === 'like' ? 'unlike' : 'like' ?>">
                    <button type="submit" class="interaction-button <?= $likeActiveClass ?>" aria-label="Like article">
                      <i class="bi bi-hand-thumbs-up<?= $currentReaction === 'like' ? '-fill' : '' ?>"></i>
                      <span><?= intval($article['likes'] ?? 0) ?></span>
                    </button>
                  </form>

                  <form method="post" action="likes.php" class="reaction-form">
                    <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                    <input type="hidden" name="action" value="<?= $currentReaction === 'dislike' ? 'undislike' : 'dislike' ?>">
                    <button type="submit" class="interaction-button <?= $dislikeActiveClass ?> dislike" aria-label="Dislike article">
                      <i class="bi bi-hand-thumbs-down<?= $currentReaction === 'dislike' ? '-fill' : '' ?>"></i>
                      <span><?= intval($article['dislikes'] ?? 0) ?></span>
                    </button>
                  </form>
                </div>
                <?php $previewComments = $commentPreviews[(int) $article['id']] ?? []; ?>
                <?php if (!empty($previewComments)): ?>
                  <div class="recent-comments"><span>Recent comments</span><?php foreach ($previewComments as $previewComment): ?><p><?= htmlspecialchars($previewComment) ?></p><?php endforeach; ?></div>
                <?php else: ?><p class="empty-comments">No comments yet.</p><?php endif; ?>
              </div>
            </article>
          <?php } ?>
        </div>
      </div>
    </section>

    <section id="about" class="home-section announcement-section">
      <div class="home-container announcement-grid">
        <div class="announcement-copy"><p class="home-kicker">A new chapter</p><h2>SchoolNow has joined <span>SchoolStatus</span></h2><p>We have a new name: SchoolStatus Sites! Same powerful, ADA-compliant, no-code school and district website. As part of the SchoolStatus suite of solutions, we’re now able to help educators better connect with families and engage the entire community.<br>Current customers can still log in as usual.</p><a href="#services" class="home-button home-button-light">Click Here To Learn More About School Status Sites</a></div>
        <img src="images/Pic1.webp" alt="SchoolStatus school community">
      </div>
    </section>

    <section id="services" class="home-section trust-section">
      <div class="home-container">
        <div class="section-heading centered-heading"><p class="home-kicker">Why SchoolStatus</p><h2>Build trust with consistency</h2><p>SchoolStatus saves time and simplifies how you connect with your school community, combining all your communications into one easy-to-use platform.</p></div>
        <div class="trust-grid"><div class="trust-item"><h3>District and schools</h3><p>Unified platform eliminates the need for multiple vendors</p><p>Encourage school-level communication that builds trust</p><p>Consistent, professional branding and digital design</p></div><div class="trust-item"><h3>Families and community</h3><p>Broad digital reach that engages the entire school community</p><p>Connect all the ways and just how parents prefer</p><p>Eliminate the many barriers to effective engagement</p></div></div>
      </div>
    </section>

    <section class="report-section"><div class="home-container report-grid"><img src="images/Pic2.webp" alt="New Customer Chronic Absenteeism Improvement Report"><div><p class="home-kicker">SchoolStatus report</p><h2>We give schools a simple place to share their story, publish important updates, and build stronger relationships with families and their communities. </h2><p>School posts can mean updates shared on social media by educational centers, or job openings and staff positions within academic institutions</p><p>For official employment opportunities in the region, check notices via the Education Service Commission. For national guidelines,</p><a href="https://www.schoolstatus.com/resource/new-customer-chronic-absenteeism-improvement-report" class="report-link">Read More &gt;&gt;&gt;</a></div></div></section>
  </main>

  <?php include './footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>


