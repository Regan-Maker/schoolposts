<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Connect your school community with SchoolStatus. Discover school updates or create an account for your school.">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="style.css">
  <title>Welcome | SchoolStatus</title>
</head>

<body class="dashboard-page">
  <main>
    <section class="dashboard-hero">
      <div class="dashboard-container dashboard-hero-grid">
        <div class="dashboard-hero-copy">
          <p class="home-kicker"><i class="bi bi-stars" aria-hidden="true"></i> School communication, made clearer</p>
          <h1>Bring your school community closer.</h1>
          <p>Share important updates, discover school stories, and keep families connected — all in one welcoming place.</p>
          <div class="dashboard-hero-actions">
            <a href="register.php" class="home-button home-button-primary">Create your school account <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
            <a href="login.php" class="home-button home-button-quiet">Sign in</a>
          </div>
          <p class="dashboard-reassurance"><i class="bi bi-check-circle-fill" aria-hidden="true"></i> New to SchoolStatus? Getting started is simple.</p>
        </div>

        <div class="dashboard-hero-visual">
          <img src="images/Pic1.webp" alt="School community sharing updates and staying connected">
          <div class="dashboard-update-card">
            <span class="dashboard-update-icon"><i class="bi bi-megaphone" aria-hidden="true"></i></span>
            <span><strong>One connected community</strong><small>Updates, stories, and conversations in one place.</small></span>
          </div>
          <div class="dashboard-orbit dashboard-orbit-one" aria-hidden="true"></div>
          <div class="dashboard-orbit dashboard-orbit-two" aria-hidden="true"></div>
        </div>
      </div>
    </section>

    <section class="dashboard-start-section" aria-labelledby="dashboard-start-title">
      <div class="dashboard-container">
        <div class="dashboard-section-heading">
          <p class="home-kicker">Your next step</p>
          <h2 id="dashboard-start-title">A good place to start</h2>
          <p>Whether you’re here to keep up or share an update, you’re in the right place.</p>
        </div>

        <div class="dashboard-action-grid">
          <article class="dashboard-action-card">
            <span class="dashboard-action-icon"><i class="bi bi-compass" aria-hidden="true"></i></span>
            <p class="dashboard-card-step">01 / Explore</p>
            <h3>Discover school updates</h3>
            <p>Browse posts from schools and see what’s happening in your community.</p>
            <a href="users.php">Explore schools <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
          </article>

          <article class="dashboard-action-card dashboard-action-card-featured">
            <span class="dashboard-action-icon"><i class="bi bi-building-add" aria-hidden="true"></i></span>
            <p class="dashboard-card-step">02 / Join</p>
            <h3>Set up your school</h3>
            <p>Create an account for your school and start sharing news with the people who matter.</p>
            <a href="register.php">Create an account <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
          </article>

          <article class="dashboard-action-card">
            <span class="dashboard-action-icon"><i class="bi bi-person-check" aria-hidden="true"></i></span>
            <p class="dashboard-card-step">03 / Welcome back</p>
            <h3>Sign in to your account</h3>
            <p>Already part of SchoolStatus? Sign in to continue managing your school presence.</p>
            <a href="login.php">Sign in <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
          </article>
        </div>
      </div>
    </section>

    <section class="dashboard-community">
      <div class="dashboard-container dashboard-community-inner">
        <div>
          <p class="home-kicker">Stronger together</p>
          <h2>Every school has a story worth sharing.</h2>
          <p>SchoolStatus gives schools a simple way to publish updates and helps families stay informed and connected.</p>
        </div>
        <a href="about.php" class="home-button home-button-light">Get to know us <i class="bi bi-arrow-up-right" aria-hidden="true"></i></a>
      </div>
    </section>
  </main>

  <?php include './footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>