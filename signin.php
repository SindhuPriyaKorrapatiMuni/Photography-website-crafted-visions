<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate and process the data (you may want to add more validation)
    // For simplicity, we're just echoing the data in this example
    echo "Email: $email <br>";
    echo "Password: $password <br>";

    // Here you can add code to check the credentials against a database or perform other authentication actions
}
?>
