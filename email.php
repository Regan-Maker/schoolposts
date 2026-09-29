<?php
// Email contact page — redesigned for clarity and accessibility
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>Contact — Email</title>
</head>
<body>
  <?php include './navbar.php'; ?>
  <main class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm">
          <div class="card-body">
            <h1 class="h4 mb-3">Official Email</h1>
            <p class="mb-4">Send us an email and we'll get back to you within 1-2 business days.</p>

            <div class="d-flex align-items-center mb-3">
              <div class="me-3">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                  <path d="M3 8.5V18a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8.5" stroke="#0d6efd" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M21 6.5V7l-9 6-9-6v-.5A2 2 0 0 1 4 4h16a2 2 0 0 1 1 2.5z" stroke="#0d6efd" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
              <div>
                <h2 class="h6 mb-0">schoolpostss@gmail.com</h2>
                <div class="small text-muted">General enquiries</div>
              </div>
            </div>

            <div class="mb-3">
              <a href="mailto:schoolpostss@gmail.com?subject=Inquiry%20from%20site" class="btn btn-primary">Send Email</a>
              <a href="telephone.php" class="btn btn-outline-secondary ms-2">View Phone Numbers</a>
              <a href="map.php" class="btn btn-outline-secondary ms-2">Visit Us</a>
            </div>

            <hr>
            <p class="small text-muted mb-0">If you are reporting abuse or an urgent issue, please call one of our support numbers.</p>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php include './footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>