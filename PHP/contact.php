<?php

class ContactFormHandler {
    private $servername;
    private $username;
    private $password;
    private $database;
    private $conn;

    // Constructor to initialize database connection
    public function __construct($servername, $username, $password, $database) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Function to insert contact form data into database
    public function insertContactFormData($fullName, $email, $phoneNumber, $message) {
        // Prepare and execute SQL statement to insert data into the database
        $stmt = $this->conn->prepare("INSERT INTO contact_us (full_name, email, phone_number, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $fullName, $email, $phoneNumber, $message);
        
        if ($stmt->execute()) {
            $response = array('success' => true, 'message' => 'Your message has been sent successfully.');
        } else {
            $response = array('success' => false, 'message' => 'Failed to send message.');
        }

        $stmt->close();
        return $response;
    }

    // Destructor to close database connection
    public function __destruct() {
        $this->conn->close();
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create ContactFormHandler object
    $contactHandler = new ContactFormHandler("localhost", "root", "", "abc_lab");

    // Get form data
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phonenumber'];
    $message = $_POST['message'];

    // Insert contact form data into database
    $response = $contactHandler->insertContactFormData($fullName, $email, $phoneNumber, $message);

    // Return JSON response
    echo json_encode($response);
} else {
    echo "Form submission method not allowed.";
}

?>
