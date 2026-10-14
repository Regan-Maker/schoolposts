<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$loggedInUserName = '';
if (isset($_SESSION['username']) && $_SESSION['username'] !== '') {
  $loggedInUserName = $_SESSION['username'];
} elseif (isset($_SESSION['email'])) {
  $loggedInUserName = $_SESSION['email'];
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand schoolpost-brand" href="index.php" aria-label="Schoolpost home">
      <img src="images/schoolpost-logo.png" alt="Schoolpost. Connect. Learn. Communicate.">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation" aria-controls="mainNavigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNavigation">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item fw-bold"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item fw-bold"><a class="nav-link" href="about.php">About Us</a></li>
        <li class="nav-item fw-bold"><a class="nav-link" href="services.php">Services</a></li>
        <li class="nav-item dropdown fw-bold">
          <a class="nav-link dropdown-toggle" href="#" id="contactMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">Contact Us</a>
          <ul class="dropdown-menu" aria-labelledby="contactMenu">
            <li><a class="dropdown-item fw-bold" href="telephone.php">Telephone Numbers</a></li>
            <li><a class="dropdown-item fw-bold" href="email.php">Email Address</a></li>
            <li><a class="dropdown-item fw-bold" href="map.php">Map Location</a></li>
          </ul>
        </li>
        <li class="nav-item fw-bold"><a class="nav-link" href="article.php">Create Post</a></li>
        <li class="nav-item fw-bold"><a class="nav-link" href="users.php">Registered Schools</a></li>
      </ul>
      <?php if ($loggedInUserName !== ''): ?>
        <span class="navbar-text me-3 text-primary fw-bold">Welcome, <?php echo htmlspecialchars($loggedInUserName); ?></span>
      <?php endif; ?> <br>
    </div>
  </div>
</nav>
