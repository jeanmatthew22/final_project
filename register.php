<?php
require_once('config.php');

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (preg_match('/([a-zA-Z0-9])\1{2,}/', trim($_POST["username"]))) {
        $username_err = "Invalid Username.";
    } elseif (preg_match('/(?:1234|abcd|qwerty|password|admin)/', trim($_POST["username"]))) {
        $username_err = "Please enter a valid username.";
    } else {
        $sql = "SELECT id FROM users WHERE username = ?";  
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST["username"]);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } elseif (preg_match('/(.)\1{2,}/', trim($_POST["password"]))) {
        $password_err = "Password is too weak, please try again.";
    } elseif (preg_match('/^(123456|abcdef|password|qwerty|letmein|welcome)$/', trim($_POST["password"]))) {
        $password_err = "Password is too weak. Please choose a different one.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm your password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)"; 
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 

            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="shortcut icon" href="statics/css/img/jessabel.png" type="image/x-icon">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://i.pinimg.com/originals/81/33/33/8133333cfe4e2d38d606123a5fc59eb4.gif') no-repeat center center fixed;
            background-size: cover; 
            color: #4B0082;
            font-family: 'Arial', sans-serif;
            padding-top: 50px; 
        }

        .container {
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0.8); 
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #8A2BE2; 
            border-color: #8A2BE2;
        }

        .btn-primary:hover {
            background-color: #7A1ED1;
            border-color: #7A1ED1;
        }

        .error-message {
            color: #d9534f;
            margin-bottom: 20px;
        }

        .footer-text {
            text-align: center;
        }

        .toggle-password {
            cursor: pointer;
            color: #8A2BE2;
        }

        .toggle-password:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Sign Up</h2>
    <p class="text-center">Please fill this form to create an account.</p>

    <?php
    if (!empty($username_err) || !empty($password_err) || !empty($confirm_password_err)) {
        echo '<div class="error-message">' . $username_err . ' ' . $password_err . ' ' . $confirm_password_err . '</div>';
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" id="password">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" id="confirm_password">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
        
        <div class="form-group">
            <a href="javascript:void(0);" onclick="togglePasswordVisibility()" id="password-toggle">Show Password</a>
        </div>
        
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block" value="Sign Up">
        </div>
        <p class="footer-text">Already have an account? <a href="login.php" style="color: #1877f2;">Login here</a>.</p>
    </form>
</div>

<script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById("password");
        var confirmPasswordField = document.getElementById("confirm_password");
        var toggleText = document.getElementById("password-toggle");
        
        if (passwordField.type === "password" && confirmPasswordField.type === "password") {
            passwordField.type = "text";
            confirmPasswordField.type = "text";
            toggleText.innerHTML = "Hide Password";  
        } else {
            passwordField.type = "password";
            confirmPasswordField.type = "password";
            toggleText.innerHTML = "Show Password";  
        }
    }
</script>

</body>
</html>
