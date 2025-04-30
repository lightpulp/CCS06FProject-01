<?php
// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
if (session_destroy()) {
    // Redirect to the login page
    header("Location: ../../frontend/page_login.php"); // Corrected path
    exit;
} else {
     echo "Logout failed";
}
?>
