<?php
require_once __DIR__ . '/navbar.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Services — SchoolStatus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="home-page services-page">

    <main>
        <section class="services-hero">
            <div class="home-container services-hero-inner">
                <div class="services-copy">
                    <p class="home-kicker">School communication, simplified</p>
                    <h1>Everything your school needs to stay connected and organised.</h1>
                    <p class="services-lead">SchoolStatus helps schools manage attendance, share updates, and keep parents and staff informed through a single, reliable platform.</p>

                    <div class="home-hero-actions">
                        <a href="article.php" class="home-button home-button-primary">Create a post</a>
                        <a href="index.php#schools" class="home-button home-button-quiet">Browse schools</a>
                    </div>

                    <div class="services-metrics" aria-label="System highlights">
                        <div class="service-stat">
                            <strong>Daily</strong>
                            <span>Attendance records</span>
                        </div>
                        <div class="service-stat">
                            <strong>Secure</strong>
                            <span>User access control</span>
                        </div>
                        <div class="service-stat">
                            <strong>Fast</strong>
                            <span>School updates</span>
                        </div>
                    </div>
                </div>

                <div class="services-visual" aria-label="SchoolStatus dashboard preview">
                    <div class="services-visual-panel">
                        <div class="mini-card">
                            <span>School dashboard</span>
                            <strong>92% engagement</strong>
                        </div>

                        <div class="visual-chart" aria-hidden="true">
                            <span class="bar bar-one"></span>
                            <span class="bar bar-two"></span>
                            <span class="bar bar-three"></span>
                            <span class="bar bar-four"></span>
                            <span class="bar bar-five"></span>
                        </div>

                        <div class="stats-row">
                            <div>
                                <small>Present</small>
                                <strong>1,240</strong>
                            </div>
                            <div>
                                <small>Late</small>
                                <strong>96</strong>
                            </div>
                            <div>
                                <small>Absent</small>
                                <strong>38</strong>
                            </div>
                        </div>

                        <ul class="visual-list">
                            <li><i class="bi bi-check-circle-fill"></i> Attendance synced daily</li>
                            <li><i class="bi bi-check-circle-fill"></i> School notices published</li>
                            <li><i class="bi bi-check-circle-fill"></i> Parent updates in one place</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="home-section services-features">
            <div class="home-container">
                <div class="section-heading centered-heading">
                    <p class="home-kicker">What we do</p>
                    <h2>Built for stronger school operations</h2>
                </div>

                <div class="services-grid" aria-label="Services">
                    <article class="svc-card">
                        <div class="svc-header">
                            <div class="svc-icon"><i class="bi bi-calendar-check"></i></div>
                            <h3 class="svc-title">Attendance Tracking</h3>
                        </div>
                        <p class="svc-desc">Track daily attendance, monitor patterns, and maintain accurate records for better school planning and reporting.</p>
                        <a class="svc-cta" href="insert.php">Get Started</a>
                    </article>

                    <article class="svc-card">
                        <div class="svc-header">
                            <div class="svc-icon"><i class="bi bi-shield-lock"></i></div>
                            <h3 class="svc-title">Secure Access</h3>
                        </div>
                        <p class="svc-desc">Manage registrations, logins, and protected account access so only the right users can view or update school data.</p>
                        <a class="svc-cta" href="register.php">Register</a>
                    </article>

                    <article class="svc-card">
                        <div class="svc-header">
                            <div class="svc-icon"><i class="bi bi-megaphone"></i></div>
                            <h3 class="svc-title">Announcements</h3>
                        </div>
                        <p class="svc-desc">Publish updates, events, and important notices to the wider school community with clear, timely communication.</p>
                        <a class="svc-cta" href="email.php">Configure</a>
                    </article>

                    <article class="svc-card">
                        <div class="svc-header">
                            <div class="svc-icon"><i class="bi bi-file-earmark-bar-graph"></i></div>
                            <h3 class="svc-title">Reports & Insights</h3>
                        </div>
                        <p class="svc-desc">Review performance trends and share institutional highlights through clear reports and accessible summaries.</p>
                        <a class="svc-cta" href="users.php">View Reports</a>
                    </article>
                </div>
            </div>
        </section>

        <section class="home-section trust-section services-journey">
            <div class="home-container">
                <div class="section-heading section-heading-row">
                    <div>
                        <p class="home-kicker">How it works</p>
                        <h2>Simple steps for every school</h2>
                    </div>
                </div>

                <div class="trust-grid">
                    <article class="trust-item">
                        <h3>01. Register</h3>
                        <p>Create your school profile and complete your basic details in a few quick steps.</p>
                    </article>
                    <article class="trust-item">
                        <h3>02. Share updates</h3>
                        <p>Post news, announcements, and school highlights for the community to see.</p>
                    </article>
                    <article class="trust-item">
                        <h3>03. Track activity</h3>
                        <p>Monitor engagement and attendance updates through a clean, user-friendly dashboard.</p>
                    </article>
                    <article class="trust-item">
                        <h3>04. Stay connected</h3>
                        <p>Keep parents, staff, and administration aligned around the same information.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="report-section services-cta-panel">
            <div class="home-container report-grid">
                <div class="announcement-copy">
                    <p class="home-kicker">Ready to get started?</p>
                    <h2>Bring your school community together.</h2>
                    <p>With SchoolStatus, managing communication and attendance becomes more organised, transparent, and efficient for everyone.</p>
                    <a href="register.php" class="home-button home-button-primary">Create account</a>
                </div>
                <img src="images/Pic1.webp" alt="SchoolStatus dashboard preview">
            </div>
        </section>
    </main>

<?php require_once __DIR__ . '/footer.php'; ?>
</body>
</html>
