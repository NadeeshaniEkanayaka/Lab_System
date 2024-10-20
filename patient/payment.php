<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $cardNumber = $_POST['card-number'];
    $expiryDate = $_POST['expiry-date'];
    $cvv = $_POST['cvv'];
    $name = $_POST['name'];

    // Hash sensitive information
    $hashedCardNumber = password_hash($cardNumber, PASSWORD_DEFAULT);
    $hashedCvv = password_hash($cvv, PASSWORD_DEFAULT);
    $hashedName = password_hash($name, PASSWORD_DEFAULT);

    // Perform database connection (replace with your actual database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "abc_lab";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert data into a table (replace 'table_name' with your actual table name)
    $sql = "INSERT INTO payment (card_number, expiry_date, cvv, name) VALUES ('$hashedCardNumber', '$expiryDate', '$hashedCvv', '$hashedName')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>';
echo 'alert("' . $response['message'] . '");';
if ($response['success']) {
    echo 'window.location.href = "payment.html";';
}
echo '</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>