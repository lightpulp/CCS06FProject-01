<?php

use Dba\Connection;
$host = "localhost";
$username = "root";
$password = ""; 
$database = "ccs05";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
    }
?>