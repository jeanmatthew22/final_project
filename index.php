<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Personal Website</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="shortcut icon" href="statics/css/img/jessabel.png" type="image/x-icon">
    <style>
        body {
            background-color: #E6E6FA; 
            color: #4B0082;
            font-family: 'Arial', sans-serif;
            padding-top: 70px;
            text-align: center; 
        }

        nav.navbar {
            background-color: #8A2BE2;
            margin-bottom: 30px;
        }

        nav.navbar a {
            color: #fff !important;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .cover-image {
            width: 100%;
            height: auto;
            max-height: 400px;
            display: block;
            margin: 0 auto; 
        }

        .container {
            text-align: center;
            margin-top: 50px;
        }

        .btn-primary {
            background-color: #8A2BE2; 
            border-color: #8A2BE2;
            margin: 10px;
        }

        .btn-success {
            background-color: #D8BFD8;
            border-color: #D8BFD8;
            margin: 10px;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #8A2BE2; 
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Jessabel's Personal Website</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Sign Up</a></li>
            </ul>
        </div>
    </nav>

    <img src="https://i.pinimg.com/originals/e7/a1/f1/e7a1f10408d696756560b71f807eca24.gif" alt="Cover Image" class="cover-image">

    <div class="container">
        <div class="page-header">
            <h1>Welcome to My Personal Website</h1>
        </div>
        <p>
            <a href="login.php" class="btn btn-primary">Login</a>
            <a href="register.php" class="btn btn-success">Sign Up</a>
        </p>
    </div>

</body>
</html>
