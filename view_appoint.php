<?php
// Database connection parameters
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "abc_lab"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch appointments from the database
$sql = "SELECT * FROM appointment";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display appointments in a styled table
    echo "<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
    </style>";

    echo "<table>
    <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Department</th>
    <th>Phone Number</th>
    <th>Choose Date</th>
    <th>Choose Time</th>
    <th>Description</th>
    </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row["patient_name"] . "</td>
        <td>" . $row["email"] . "</td>
        <td>" . $row["department"] . "</td>
        <td>" . $row["phone_number"] . "</td>
        <td>" . $row["date"] . "</td>
        <td>" . $row["time"] . "</td>
        <td>" . $row["description"] . "</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "No appointments found.";
}

// Close connection
$conn->close();
?>