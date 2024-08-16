<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate and process the data (you may want to add more validation)
    // For simplicity, we're just echoing the data in this example
    echo "Name: $name <br>";
    echo "Email: $email <br>";
    echo "Password: $password <br>";

    // Here you can add code to insert the data into a database or perform other actions
}
?>

