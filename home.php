<?php
session_start();
include('dbcon.php');
include('session.php');

// Check if the session variable is set
if(isset($session_id) && !empty($session_id)) {
    $result = mysqli_query($con, "SELECT * FROM users WHERE user_id='$session_id'") or die('Error In Session');
    $row = mysqli_fetch_array($result);

    // Check if $row is not null before accessing its elements
    if ($row !== null) {
        // Rest of your code
        ?>
        <html>
        <head>
            <link rel="stylesheet" type="text/css" href="style.css">
        </head>
        <body>
            <div class="form-wrapper">
                <center><h3>Welcome to crafted visions  <?php echo $row['name']; ?> </h3></center>
                <div class="reminder">
                    <p><a href="index.html">click here to redirect to home page</a></p>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Error: User not found or session data is invalid.";
    }
} else {
    // Handle the case where the session variable is not set
    echo "Error: Session ID not set.";
}

