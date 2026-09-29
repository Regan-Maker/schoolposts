<?php
session_start();

include "./conn.php";


$sql = "SELECT * FROM article ORDER BY id DESC";


$article = mysqli_query($con, $sql);

if ($article) {

  $article = mysqli_fetch_all($article, MYSQLI_ASSOC);

} 
else {
  echo "Failed" . mysqli_error($con);
}


?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>Registered Schools</title>
</head>

<body class="directory-page">

<?php include './navbar.php'; ?>
  <main class="directory-shell">
    <section class="directory-hero">
      <?php include './hero.php'; ?>
      <div>
        <p class="directory-kicker">School community</p>
        <h1>Registered Schools</h1>
        <p>Explore the schools sharing updates and building stronger connections with their communities.</p>
      </div>
      <a href="article.php" class="directory-primary-action">Register your school</a>
    </section>

    <section class="directory-content" aria-labelledby="directory-title">
      <div class="directory-toolbar">
        <div>
          <h2 id="directory-title">School directory</h2>
          <p><strong><?= count($article) ?></strong> registered <?= count($article) === 1 ? 'school' : 'schools' ?></p>
        </div>
        <label class="directory-search">
          <span class="visually-hidden">Search schools</span>
          <input type="search" id="school-search" placeholder="Search schools..." autocomplete="off">
        </label>
      </div>

      <?php if (!empty($article)): ?>
        <div class="school-directory-grid" id="school-directory-grid">
          <?php foreach ($article as $value): ?>
            <article class="directory-card" data-school-name="<?= htmlspecialchars(strtolower($value['school'] ?? '')) ?>">
              <div class="directory-card-image">
                <?php if (!empty($value['img'])): ?>
                  <img src="data:image/jpeg;base64,<?= htmlspecialchars($value['img']) ?>" alt="<?= htmlspecialchars($value['school']) ?>">
                <?php else: ?>
                  <span aria-hidden="true">School</span>
                <?php endif; ?>
              </div>
              <div class="directory-card-body">
                <p class="directory-card-label">Registered school</p>
                <h3><?= htmlspecialchars($value['school'] ?? 'Unnamed school') ?></h3>
                <?php if (!empty($value['description'])): ?>
                  <p><?= htmlspecialchars($value['description']) ?></p>
                <?php else: ?>
                  <p class="directory-muted">No description provided.</p>
                <?php endif; ?>
                <div class="directory-card-footer">
                  <span><?= htmlspecialchars($value['created_at'] ?? '') ?></span>
                  <a href="commenting.php?id=<?= (int) $value['id'] ?>">View post</a>
                </div>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
        <p id="no-school-results" class="directory-empty" hidden>No schools match your search.</p>
      <?php else: ?>
        <div class="directory-empty">No schools have been registered yet.</div>
      <?php endif; ?>
    </section>
  </main>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <?php include './footer.php'; ?>
  <script>
    const schoolSearch = document.getElementById('school-search');
    const schoolCards = document.querySelectorAll('.directory-card');
    const noSchoolResults = document.getElementById('no-school-results');

    schoolSearch?.addEventListener('input', () => {
      const searchTerm = schoolSearch.value.trim().toLowerCase();
      let visibleCards = 0;

      schoolCards.forEach((card) => {
        const matches = card.dataset.schoolName.includes(searchTerm);
        card.hidden = !matches;
        if (matches) visibleCards += 1;
      });

      if (noSchoolResults) noSchoolResults.hidden = visibleCards > 0;
    });
  </script>
</body>

</html>