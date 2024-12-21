<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="statics/css/abouts.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="statics/css/img/jessabel.png" type="image/x-icon">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand mx-auto" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/final_project/home.php">Home Page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/final_project/contact.php">Contacts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/final_project/aboutpage.php">About Page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/final_project/profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/final_project/portfolio.php">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="/final_project/login.php">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="about-card p-4 shadow rounded bg-light text-center">
        <h1 class="text-primary">About Me</h1>
        <p class="lead mt-3">
            My name is <strong> (YOUR NAME ) </strong>. I am <strong> ( AGE )</strong>, 
            studying at <a href="https://www.facebook.com/LagunaUniversityOfficial/" target="_blank"> ( YOUR UNIVERSITY ) </a>, 
            and currently living in <strong> ( Adress ) </strong>. I am pursuing a 
            <strong> ( COURSE ) </strong> with a specialization in Business Analytics.
        </p>
        <a href="home.php" class="btn btn-secondary mt-3">Back to Home</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
