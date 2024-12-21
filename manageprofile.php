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

<div class="table-container">
    <h3>All Profiles</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Birthday</th>
                <th>Age</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "config.php";
            $sql = "SELECT * FROM profiles"; 
            if ($result = mysqli_query($link, $sql)) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo "<tr>
                        <td>{$row['firstname']}</td>
                        <td>{$row['middlename']}</td>
                        <td>{$row['lastname']}</td>
                        <td>{$row['birthday']}</td>
                        <td>{$row['age']}</td>
                        <td>{$row['contact_number']}</td>
                        <td>{$row['email']}</td>
                        <td>
                            <a href='profile.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <form action='profile.php' method='post' style='display:inline'>
                                <input type='hidden' name='action' value='delete'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                            </form>
                        </td>
                    </tr>";
                }
                mysqli_free_result($result);
            }
            mysqli_close($link);
            ?>
        </tbody>
    </table>

    <a href="profile.php" class="back-btn">Back to Profile</a>