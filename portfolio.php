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
    <h1>My Portfolio</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Object Oriented Programming (Python)</h5>
                    <p class="card-text">Activities in OOP Prelim to Finals Activity 1</p>
                    <div class="d-flex justify-content-center">
                        <a href="https://drive.google.com/drive/folders/1nOIdY4OxO8AV-jiP7aTLDnN9aBGj7uLL?usp=sharing" class="btn btn-primary" target="_blank">View Project</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Object Oriented Programming (Python)</h5>
                    <p class="card-text">OOP Final Activity</p>
                    <div class="d-flex justify-content-center">
                        <a href="https://colab.research.google.com/drive/1eFTyJv4XE13TSVerympOkYk1YFCnhtH1?usp=sharing" class="btn btn-primary" target="_blank">View Project</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Integrative Python (Flask)</h5>
                    <p class="card-text">Flask Final Activity</p>
                    <div class="d-flex justify-content-center">
                        <a href="https://drive.google.com/drive/folders/1VB7shyaar3OH2hcapikRJGm7BvLi3LNg?usp=sharing" class="btn btn-primary" target="_blank">View Project</a>
                    </div>
                </div>
            </div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
