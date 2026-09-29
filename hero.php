<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$displayName = '';
if (!empty($_SESSION['username'])) {
  $displayName = $_SESSION['username'];
} elseif (!empty($_SESSION['email'])) {
  $displayName = $_SESSION['email'];
}

if ($displayName !== ''): ?>
<div class="page-hero-banner py-2 border-bottom">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <div class="fw-bold text-primary">Welcome, <?php echo htmlspecialchars($displayName); ?></div>
        <div class="small text-muted">Signed in as your school</div>
      </div>
      <div>
        <a href="users.php" class="btn btn-sm btn-outline-primary">Manage School</a>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
