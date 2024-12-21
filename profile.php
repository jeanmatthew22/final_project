<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
include "config.php";

$firstname = $middlename = $lastname = $birthday = $age = $contact_number = $email = "";
$firstname_err = $middlename_err = $lastname_err = $birthday_err = $age_err = $contact_number_err = $email_err = "";
$success_msg = $error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'create') {
        $firstname = trim($_POST["firstname"]);
        if (empty($firstname)) {
            $firstname_err = "Please enter your first name.";
        } elseif (!preg_match('/^[a-zA-Z\s]+$/', $firstname)) {
            $firstname_err = "First name can only contain letters and spaces.";
        }

        $middlename = trim($_POST["middlename"]);
        if (!empty($middlename) && !preg_match('/^[a-zA-Z\s]+$/', $middlename)) {
            $middlename_err = "Middle name can only contain letters and spaces.";
        }

        $lastname = trim($_POST["lastname"]);
        if (empty($lastname)) {
            $lastname_err = "Please enter your last name.";
        } elseif (!preg_match('/^[a-zA-Z\s]+$/', $lastname)) {
            $lastname_err = "Last name can only contain letters and spaces.";
        }

        $birthday = trim($_POST["birthday"]);
        if (empty($birthday)) {
            $birthday_err = "Please enter your birthday.";
        } elseif (strtotime($birthday) > strtotime('today')) {
             $birthday_err = "Birthday cannot be in the future.";
            } else {
                $age = date_diff(date_create($birthday), date_create('today'))->y;
            }
$contact_number = trim($_POST["contact_number"]);
if (empty($contact_number)) {
    $contact_number_err = "Please enter your contact number.";
} elseif (!preg_match('/^\d{11}$/', $contact_number)) {
    $contact_number_err = "Please enter a valid contact number.";
} elseif (preg_match('/(\d)\1{3}/', $contact_number)) { // Check for four consecutive identical digits
    $contact_number_err = "Phone number should not contain consecutive identical digits.";
}


$email = trim($_POST["email"]);

if (empty($email)) {
    $email_err = "Please enter your email.";
} else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Please enter a valid email address.";
    } else {
        if (!preg_match("/^[a-zA-Z0-9@.]+$/", $email)) {
            $email_err = "Email can only contain letters, numbers, @, and .";
        } else {
            $email_domain = substr(strrchr($email, "@"), 1);

            $allowed_domains = ['yahoo.com', 'gmail.com', 'hotmail.com'];

            if (!in_array($email_domain, $allowed_domains)) {
                $email_err = "Please use a valid email address with @yahoo.com, @gmail.com, or @hotmail.com.";
            }
        }
    }
}
        if (empty($firstname_err) && empty($lastname_err) && empty($birthday_err) && empty($contact_number_err) && empty($email_err)) {
            $sql = "INSERT INTO profiles (firstname, middlename, lastname, birthday, age, contact_number, email) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssssiss", $firstname, $middlename, $lastname, $birthday, $age, $contact_number, $email);
                if (mysqli_stmt_execute($stmt)) {
                    $success_msg = "Profile created successfully!";
                } else {
                    $error_msg = "Something went wrong. Please try again.";
                }
                mysqli_stmt_close($stmt);
            }
        }
    }

    if ($action == 'update') {
        $id = $_POST["id"];
        $firstname = trim($_POST["firstname"]);
        $middlename = trim($_POST["middlename"]);
        $lastname = trim($_POST["lastname"]);
        $birthday = trim($_POST["birthday"]);
        $age = date_diff(date_create($birthday), date_create('today'))->y;
        $contact_number = trim($_POST["contact_number"]);
        $email = trim($_POST["email"]);

        if (empty($firstname_err) && empty($lastname_err) && empty($birthday_err) && empty($contact_number_err) && empty($email_err)) {
            $sql = "UPDATE profiles SET firstname=?, middlename=?, lastname=?, birthday=?, age=?, contact_number=?, email=? WHERE id=?";
            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssssissi", $firstname, $middlename, $lastname, $birthday, $age, $contact_number, $email, $id);
                if (mysqli_stmt_execute($stmt)) {
                    $success_msg = "Profile updated successfully!";
                } else {
                    $error_msg = "Something went wrong. Please try again.";
                }
                mysqli_stmt_close($stmt);
            }
        }
    }

    if ($action == 'delete') {
        $id = $_POST["id"];
        $sql = "DELETE FROM profiles WHERE id=?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            if (mysqli_stmt_execute($stmt)) {
                $success_msg = "Profile deleted successfully!";
            } else {
                $error_msg = "Something went wrong. Please try again.";
            }
            mysqli_stmt_close($stmt);
        }
    }
}

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $id = trim($_GET["id"]);
    $sql = "SELECT * FROM profiles WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $firstname = $row["firstname"];
                $middlename = $row["middlename"];
                $lastname = $row["lastname"];
                $birthday = $row["birthday"];
                $age = $row["age"];
                $contact_number = $row["contact_number"];
                $email = $row["email"];
            }
        }
        mysqli_stmt_close($stmt);
    }
}

$sql = "SELECT * FROM profiles";
if ($result = mysqli_query($link, $sql)) {
}
mysqli_close($link);
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding-top: 50px;
        }
        .contact-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 30px;
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
        }
        h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }
        .contact-info {
            margin-top: 20px;
        }
        .contact-info img {
            width: 100px; 
            margin-right: 10px;
        }
        .contact-info .facebook-logo {
            width: 120px;  
        }
        .contact-info a {
            display: block;
            font-size: 20px;
            color: #333;
            text-decoration: none;
            margin: 10px 0;
        }
        .contact-info a:hover {
            text-decoration: underline;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>User Profile</h2>

        <form action="profile.php" method="post">
            <input type="hidden" name="action" value="<?php echo isset($id) ? 'update' : 'create'; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="firstname" class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstname; ?>">
                <span class="invalid-feedback"><?php echo $firstname_err; ?></span>
            </div>
            <div class="form-group">
                <label>Middle Name</label>
                <input type="text" name="middlename" class="form-control" value="<?php echo $middlename; ?>">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lastname" class="form-control <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastname; ?>">
                <span class="invalid-feedback"><?php echo $lastname_err; ?></span>
            </div>
            <div class="form-group">
                <label>Birthday</label>
                <input type="date" name="birthday" class="form-control <?php echo (!empty($birthday_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $birthday; ?>">
                <span class="invalid-feedback"><?php echo $birthday_err; ?></span>
            </div>
            <div class="form-group">
                <label>Contact Number</label>
                <input type="text" name="contact_number" class="form-control <?php echo (!empty($contact_number_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $contact_number; ?>">
                <span class="invalid-feedback"><?php echo $contact_number_err; ?></span>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <a href="manageprofile.php" class="btn btn-secondary mt-3">View All Profiles</a>
    </div>
</body>
</html>
