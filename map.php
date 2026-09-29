<?php
$mapLocationUrl = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d832.4640541598718!2d30.662862332725194!3d-0.6079509307731943!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19d91b922addedc7%3A0xa112619c2ae33477!2sAnnet%20collections!5e1!3m2!1sen!2sug!4v1783645310284!5m2!1sen!2sug";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Our Location</title>
</head>
<body>
    <?php include './navbar.php'; ?>
    <main class="container py-5">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <h1 class="h3 mb-3">Find Us</h1>
                <p class="lead">Visit our office to learn more about SchoolStatus and how we help schools connect with their communities.</p>

                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="h6">Location</h2>
                        <p class="mb-1">Annet collections (approximate)</p>
                        <p class="mb-1">City centre — Kampala, Uganda</p>
                        <p class="mb-0"><a href="mailto:info@schoolstatus.example" class="link-primary">Email us</a> · <a href="telephone.php" class="link-primary">Phone numbers</a></p>
                    </div>
                </div>

                <p class="small text-muted">Use the map on the right to get directions. Click "Open in new tab" to view in Google Maps.</p>
                <a class="btn btn-outline-primary mt-2" href="<?= htmlspecialchars($mapLocationUrl) ?>" target="_blank" rel="noopener">Open map in new tab</a>
            </div>

            <div class="col-lg-6">
                <div class="ratio ratio-16x9 shadow-sm rounded">
                    <iframe src="<?= htmlspecialchars($mapLocationUrl) ?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" title="SchoolStatus location"></iframe>
                </div>
            </div>
        </div>
    </main>

    <?php include './footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>