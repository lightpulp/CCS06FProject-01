<?php
$host = "localhost";
$username = "root";
$password = ""; 
$database = "ccs06";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "<script>alert('Connection Successful!');</script>";
}
?>