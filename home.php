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
    <link rel="shortcut icon" href="statics/css/img/jessabel.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="profile-card p-4 shadow rounded bg-light">
        <div class="row align-items-center">
            <div class="col-md-4 text-center">
                <img src="https://scontent.fmnl16-1.fna.fbcdn.net/v/t39.30808-6/467397863_591656679884693_727511731449072983_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeHJF_JRU49ceRcRw2u4Q6w91xrW6yasHy_XGtbrJqwfLxCIKPNFaOzFPFwjH7ZooQ5fOMJ8FYaPufhSArh34JyB&_nc_ohc=FaXVA3Ky-vsQ7kNvgEjxeej&_nc_zt=23&_nc_ht=scontent.fmnl16-1.fna&_nc_gid=Ahu_WQ_SH7KlKLgHxvBdukv&oh=00_AYBsuvi-8a3Ub762mFgmJUTwmAC-ebd3ncM2DapUAFuhGg&oe=675CCCB9" alt="Jessabel's photo" class="img-fluid rounded-circle">
            </div>
            <div class="col-md-8 text-center text-md-start">
                <h1>Welcome to my website!</h1>
                <p class="lead">My name is ( YOUR NAME ). Click the button below to get to know me!</p>
                <a href="aboutme.php" class="btn btn-primary">Get to Know More About Me</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
