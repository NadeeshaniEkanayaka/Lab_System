<?php
include('connection.php');  

$username = $_POST['user'];  
$password = $_POST['pass'];  

// To prevent SQL injection  
$username = stripcslashes($username);  
$password = stripcslashes($password);  
$username = mysqli_real_escape_string($con, $username);  
$password = mysqli_real_escape_string($con, $password);  

// Query to check if the provided credentials belong to a technician
$sqlTechnician = "SELECT * FROM technician WHERE username = '$username' AND password = '$password'";  
$resultTechnician = mysqli_query($con, $sqlTechnician);  
$countTechnician = mysqli_num_rows($resultTechnician);  

if($countTechnician == 1) {  
    // Redirect to technician_home.html upon successful login
    header("Location: Technician_home.html");
    exit(); 
} else {  
    // If not a technician, check if it's an admin
    $sqlAdmin = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
    $resultAdmin = mysqli_query($con, $sqlAdmin);
    $countAdmin = mysqli_num_rows($resultAdmin);

    if ($countAdmin == 1) {
        // Redirect to admin_home.html upon successful login
        header("Location: Admin_home.html");
        exit(); 
    } else {
        // If not an admin, assume it's a patient and proceed to check patient details table
        $sqlPatient = "SELECT * FROM signup WHERE username = '$username' AND pass = '$password'";
        $resultPatient = mysqli_query($con, $sqlPatient);
        $countPatient = mysqli_num_rows($resultPatient);

        if ($countPatient == 1) {
            // Redirect to patient_home.html upon successful login
            header("Location: Customer_home.html");
            exit();
        } else {
            echo "<h1> Login failed. Invalid username or password.</h1>";  
        }
    }
}     
?>
