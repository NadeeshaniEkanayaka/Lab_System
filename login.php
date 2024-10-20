
<?php
// Define the correct email and password
$correct_email = "admin@gmail.com";
$correct_password = "password123"; // You should replace this with the actual correct password

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["username"]; // Changed to match the input name
    $password = $_POST["password"];

    // Check if email and password match
    if ($email === $correct_email && $password === $correct_password) {
        // Successful login, redirect to admin.html
        header("Location: admin.html");
        exit;
    } else {
        // Unsuccessful login, display error message
        echo "Incorrect email or password. Please try again.";
    }
}
?>