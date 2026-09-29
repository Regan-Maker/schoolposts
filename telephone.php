<?php
// Telephone contact page redesigned for accessibility and responsiveness
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>Contact — Phone Numbers</title>
</head>
<body>
  <?php include './navbar.php'; ?>

  <main class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm">
          <div class="card-body">
            <h1 class="h4 mb-3">Reach Us</h1>
            <p class="mb-4">Call any of the numbers below to speak with our team. Tap the number on mobile to call directly.</p>

            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                  <strong>Main Office</strong>
                  <div class="small text-muted">General enquiries</div>
                </div>
                <a href="tel:+256774710709" class="btn btn-sm btn-primary">+256 774 710 709</a>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                  <strong>Support</strong>
                  <div class="small text-muted">Technical support</div>
                </div>
                <a href="tel:+256703799819" class="btn btn-sm btn-primary">+256 703 799 819</a>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                  <strong>Partnerships</strong>
                  <div class="small text-muted">Business inquiries</div>
                </div>
                <a href="tel:+256744137546" class="btn btn-sm btn-primary">+256 744 137 546</a>
              </li>
            </ul>

            <div class="mt-4">
              <a href="email.php" class="btn btn-outline-secondary">Contact via Email</a>
              <a href="map.php" class="btn btn-outline-secondary ms-2">Visit Us</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php include './footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>