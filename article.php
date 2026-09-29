<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create a post | SchoolStatus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body class="post-page">
    <?php include './navbar.php'; ?>
    <main class="post-shell">
        <section class="post-intro">
            <p class="eyebrow">School communications</p>
            <h1>Create a post your community can trust.</h1>
            <p>Share a clear update with families, educators, and everyone who follows your school.</p>
        </section>

        <section class="post-panel" aria-labelledby="post-form-title">
            <div class="post-panel-heading">
                <div>
                    <h2 id="post-form-title">Post details</h2>
                    <p>Fields marked with <span aria-hidden="true">*</span> are required.</p>
                </div>
                <span class="post-step">1 of 1</span>
            </div>

            <form method="post" action="insertarticle.php" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="school" class="form-label">School name <span aria-hidden="true">*</span></label>
                    <input type="text" class="form-control form-control-lg" id="school" name="school" placeholder="For example, Green Valley Primary School" required>
                    <div class="form-text">Use the official name your community will recognize.</div>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">What would you like to share?</label>
                    <textarea class="form-control" id="description" name="description" rows="6" placeholder="Write your announcement, event details, or school update..."></textarea>
                    <div class="form-text">Keep it simple and useful. You can add dates, locations, and contact details.</div>
                </div>

                <div class="mb-4">
                    <label for="school-image" class="form-label">School image <span aria-hidden="true">*</span></label>
                    <label class="image-upload" for="school-image">
                        <span class="image-upload-icon" aria-hidden="true">+</span>
                        <span><strong>Choose an image</strong><br><small>JPG, PNG, or WebP recommended</small></span>
                        <input type="file" id="school-image" name="img" accept="image/jpeg,image/png,image/webp" required>
                    </label>
                    <div id="image-name" class="form-text">Add a clear school logo or photo.</div>
                    <img id="image-preview" class="image-preview" alt="Selected school image preview">
                </div>

                <div class="post-actions">
                    <a href="index.php" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-primary">Publish post</button>
                </div>
            </form>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        const imageInput = document.getElementById('school-image');
        const imageName = document.getElementById('image-name');
        const imagePreview = document.getElementById('image-preview');

        imageInput.addEventListener('change', () => {
            const file = imageInput.files[0];
            if (!file) return;

            imageName.textContent = file.name;
            imagePreview.src = URL.createObjectURL(file);
            imagePreview.classList.add('is-visible');
        });
    </script>
    <?php include './footer.php'; ?>
</body>
</html>