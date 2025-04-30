<?php
session_start();

// Optional: Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php"); // adjust path as needed
    exit();
}

// Access session data
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_role = $_SESSION['role'];

?>