<?php
session_start();
include('dbcon.php');


if (isset($_POST['login'])) {
    // Sanitize and validate user input
    $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

    // Use prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($con, "SELECT user_id, password FROM users WHERE username=?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($password, $row['password'])) {
        // Store user_id in the session
        $_SESSION['user_id'] = $row['user_id'];

        // Redirect to index.php after successful login
        header('location: index.php');
        exit();
    } else {
        // Display error message if login fails
        $error_message = 'Invalid Username and Password Combination';
        // Use htmlspecialchars to prevent XSS
        echo 'Login failed. ' . htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8');
    }

    mysqli_stmt_close($stmt);
    
// Check if the user is already logged in
if(isset($_SESSION['user_id'])) {
    // If the user is already logged in, redirect to the home page
    header('location: home.php');
    exit();
}
}
?>

<!-- HTML code for login form -->
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style6.css">
</head>
<body>
    <div class="form-wrapper">
        <form action="#" method="post">
            <h3>Login here</h3>
            <?php
            if (isset($error_message)) {
                echo '<div class="error">' . htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8') . '</div>';
            }
            ?>
            <div class="form-item">
                <input type="text" name="user" required="required" placeholder="Username" autofocus required>
            </div>
            <div class="form-item">
                <input type="password" name="pass" required="required" placeholder="Password" required>
            </div>
            <div class="button-panel">
                <input type="submit" class="button" title="Log In" name="login" value="Login">
            </div>
        </form>

        <div class="reminder">
            <p>Not a member? <a href="signup.php">Sign up now</a></p>
            <p><a href="#">Forgot password?</a></p>
        </div>
    </div>
</body>
</html>
