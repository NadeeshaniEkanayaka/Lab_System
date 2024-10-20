<?php

class AppointmentDatabase {
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

    // Function to insert appointment data into database
    public function insertAppointment($patientName, $email, $department, $phoneNumber, $date, $time, $description) {
        // Prepare and execute SQL statement to insert data into the database
        $stmt = $this->conn->prepare("INSERT INTO appointment (patient_name, email, department, phone_number, date, time, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisss", $patientName, $email, $department, $phoneNumber, $date, $time, $description);
        
        if ($stmt->execute()) {
            $response = array('success' => true, 'message' => 'Appointment saved successfully');
        } else {
            $response = array('success' => false, 'message' => 'Failed to save appointment');
        }

        $stmt->close();
        return $response;
    }

    // Destructor to close database connection
    public function __destruct() {
        $this->conn->close();
    }
}

// Create database object
$database = new AppointmentDatabase("localhost", "root", "", "abc_lab");

// Get form data
$patientName = $_POST['patient_name'];
$email = $_POST['email'];
$department = $_POST['department'];
$phoneNumber = $_POST['phone_number'];
$date = $_POST['date'];
$time = $_POST['time'];
$description = $_POST['description'];

// Insert appointment data into database
$response = $database->insertAppointment($patientName, $email, $department, $phoneNumber, $date, $time, $description);

// Display alert message and redirect to index.html using JavaScript
echo '<script>';
echo 'alert("' . $response['message'] . '");';
echo 'window.location.href = "index.html";'; // Redirect to index.html
echo '</script>';

?>
