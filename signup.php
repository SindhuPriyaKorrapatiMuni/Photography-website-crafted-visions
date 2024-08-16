<?php session_start(); ?>
<?php include('dbcon.php'); ?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style6.css">
</head>
<body>
    <div class="form-wrapper">
        <form action="#" method="post">
            <h3>Sign Up</h3>
            <div class="form-item">
                <input type="text" name="new_user" required="required" placeholder="New Username" autofocus required>
            </div>
            <div class="form-item">
                <input type="password" name="new_pass" required="required" placeholder="New Password" required>
            </div>
            <div class="button-panel">
                <input type="submit" class="button" title="Sign Up" name="signup" value="Sign Up">
            </div>
        </form>

        <?php
        if (isset($_POST['signup'])) {
            $newUsername = mysqli_real_escape_string($con, $_POST['new_user']);
            $newPassword = mysqli_real_escape_string($con, $_POST['new_pass']);

            // Use prepared statement to prevent SQL injection
            $stmt = mysqli_prepare($con, "INSERT INTO users (username, password) VALUES (?, ?)");
            mysqli_stmt_bind_param($stmt, "ss", $newUsername, $newPassword);

            if (mysqli_stmt_execute($stmt)) {
                echo 'Registration successful!';
                
                // Retrieve user_id of the newly registered user
                $query = mysqli_query($con, "SELECT * FROM users WHERE username='$newUsername'");
                $row = mysqli_fetch_array($query);

                $_SESSION['user_id'] = $row['user_id'];

                // Redirect to home.php after successful signup
                header('location:home.php');
                exit(); // Terminate the script after redirection
            } else {
                echo 'Registration failed.';
            }

            mysqli_stmt_close($stmt);
        }
        ?>

        <div class="reminder">
            <p>Already a member? <a href="index.php">Log in here</a></p>
        </div>
    </div>
</body>
</html>

