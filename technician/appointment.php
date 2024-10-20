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

    // Function to get all appointments from the database
    public function getAppointments() {
        $sql = "SELECT * FROM appointment";
        $result = $this->conn->query($sql);

        if ($result) {
            return $result;
        } else {
            echo "Error: " . $this->conn->error;
            return false;
        }
    }

    // Destructor to close database connection
    public function __destruct() {
        $this->conn->close();
    }
}

// Create database object
$database = new AppointmentDatabase("localhost", "root", "", "abc_lab");

// Get appointments from the database
$result = $database->getAppointments();

// Display appointments in a table
if ($result) {
    echo '<table><tr>';
    $column_names = $result->fetch_fields();
    foreach ($column_names as $column_name) {
        echo '<th>' . $column_name->name . '</th>';
    }
    echo '</tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        foreach ($row as $value) {
            echo '<td>' . $value . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}
?>
