<?php
require_once('config.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        $param_username = $username;

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $db_username, $hashed_password);

                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($password, $hashed_password)) {
                        $_SESSION['username'] = $db_username;
                        $_SESSION['id'] = $id;
                        $_SESSION['loggedin'] = true; 

                        header("Location: home.php");
                        exit(); 
                    } else {
                        $error_message = "Invalid username or password.";
                    }
                }
            } else {
                $error_message = "Invalid username or password.";
            }
        } else {
            $error_message = "Oops! Something went wrong. Please try again later.";
        }
        mysqli_stmt_close($stmt);
    }
}
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="statics/css/img/jessabel.png" type="image/x-icon">
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
    <h2 class="text-center">Login</h2>

    <?php
    if (!empty($error_message)) {
        echo '<div class="error-message">' . $error_message . '</div>';
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="form-group">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="form-group">
            <span onclick="togglePassword()" class="toggle-password" id="password-toggle-text">Show Password</span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block" value="Log In">
        </div>
    </form>

    <p class="footer-text">Don't have an account? <a href="register.php" style="color: #1877f2;">Sign up now</a>.</p>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
    function togglePassword() {
        var passwordField = document.getElementById("password");
        var passwordToggle = document.getElementById("password-toggle-text");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            passwordToggle.textContent = "Hide Password";
        } else {
            passwordField.type = "password";
            passwordToggle.textContent = "Show Password";
        }
    }
</script>

</body>
</html>