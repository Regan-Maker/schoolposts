<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>About Us | SchoolStatus</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<style>
		.about-hero {
			background: linear-gradient(135deg, #0d6efd, #084298);
			color: #fff;
			padding: 5rem 1.5rem;
		}

		.about-section {
			padding: 4rem 1.5rem;
		}

		.about-card {
			height: 100%;
			border: 0;
			border-top: 4px solid #0d6efd;
			box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
		}
	</style>
</head>
<body class="bg-light">
	<?php include './navbar.php'; ?>
	<main>
		<section class="about-hero text-center">
			<div class="container">
				<p class="text-uppercase mb-2">About SchoolStatus</p>
				<h1 class="display-4 fw-bold">Helping schools stay connected</h1>
				<p class="lead mx-auto mb-0" style="max-width: 760px;">
					We give schools a simple place to share their story, publish important updates, and build stronger relationships with families and their communities.
				</p>
			</div>
		</section>

		<section class="about-section bg-white">
			<div class="container">
				<div class="row align-items-center g-5">
					<div class="col-lg-6">
						<h2 class="fw-bold text-primary mb-3">A clearer way to communicate</h2>
						<p class="lead">SchoolStatus brings school information closer to the people who need it.</p>
						<p>
							Schools can create posts, share updates, answer questions, and keep their communities informed without making communication complicated. Our goal is to make every school’s work easier to discover and easier to trust.
						</p>
						<a href="article.php" class="btn btn-primary">Create a school post</a>
					</div>
					<div class="col-lg-6">
						<img src="images/Pic1.webp" alt="School community communication" class="img-fluid rounded shadow-sm">
					</div>
				</div>
			</div>
		</section>

		<section class="about-section bg-light">
			<div class="container">
				<div class="text-center mb-4">
					<h2 class="fw-bold">What we value</h2>
					<p class="text-muted">A practical foundation for better school communication.</p>
				</div>
				<div class="row g-4">
					<div class="col-md-4">
						<div class="card about-card p-3">
							<div class="card-body">
								<h3 class="h4">Clarity</h3>
								<p class="mb-0">Important school news should be easy to find, understand, and share.</p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card about-card p-3">
							<div class="card-body">
								<h3 class="h4">Community</h3>
								<p class="mb-0">Families, educators, and local communities are stronger when they stay connected.</p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card about-card p-3">
							<div class="card-body">
								<h3 class="h4">Consistency</h3>
								<p class="mb-0">Reliable communication helps schools build confidence over time.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="about-section text-center bg-primary text-white">
			<div class="container">
				<h2 class="fw-bold">Your school has a story worth sharing</h2>
				<p class="lead">Join a platform designed to help your community stay informed.</p>
				<a href="index.php" class="btn btn-light">Explore school posts</a>
			</div>
		</section>
	</main>

	<?php include './footer.php'; ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
