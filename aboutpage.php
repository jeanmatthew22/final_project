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
    <link href="statics/css/homes.css" rel="stylesheet">
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
    <div class="skills-card p-4 shadow rounded bg-light">
        <h1 class="text-primary text-center">My Skills</h1>
        <div class="row mt-4">
            <div class="col-md-4 text-center">
                <img src="https://cdn-icons-png.flaticon.com/512/1199/1199128.png" alt="MySQL Logo" class="img-fluid" style="width: 150px; height: 150px;">
                <h4 class="mt-3">MySQL</h4>
            </div>
            <div class="col-md-4 text-center">
                <img src="https://i.etsystatic.com/16262948/r/il/51da06/2457202393/il_fullxfull.2457202393_fp8g.jpg" alt="HTML Logo" class="img-fluid" style="width: 150px; height: 150px;">
                <h4 class="mt-3">HTML</h4>
            </div>
            <div class="col-md-4 text-center">
                <img src="https://cdn-icons-png.flaticon.com/512/5968/5968350.png" alt="Python Logo" class="img-fluid" style="width: 150px; height: 150px;">
                <h4 class="mt-3">Python</h4>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="home.php" class="btn btn-secondary">Back to Home</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
