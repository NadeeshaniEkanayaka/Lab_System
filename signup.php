<?php

class Database {
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

    // Function to insert user data into database
    public function insertUser($firstName, $lastName, $address, $telephone, $email, $gender, $birthday, $username, $password) {
        // Prepare and execute SQL statement to insert data into the database
        $stmt = $this->conn->prepare("INSERT INTO signup (firstName, lastName, addres, telephone, email, gender, birthday, username, pass) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisssss", $firstName, $lastName, $address, $telephone, $email, $gender, $birthday, $username, $password);
        
        if ($stmt->execute()) {
            $response = array('success' => true, 'message' => 'Signup successful');
            echo "<script>window.location.href='login.html';</script>";
        } else {
            $response = array('success' => false, 'message' => 'Failed to signup');
        }

        $stmt->close();
    }

    // Destructor to close database connection
    public function __destruct() {
        $this->conn->close();
    }
}

// Create database object
$database = new Database("localhost", "root", "", "abc_lab");

// Get form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$address = $_POST['addres'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$birthday = $_POST['birthday'];
$username = $_POST['username'];
$password = $_POST['pass'];

// Insert user data into database
$database->insertUser($firstName, $lastName, $address, $telephone, $email, $gender, $birthday, $username, $password);

?>
