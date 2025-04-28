<?php
include "config.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email exists
    $sql = "SELECT user_id, username, user_pass, role FROM users WHERE user_email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        // User found
        $row = mysqli_fetch_assoc($result);

        // Verify password
        if ($password === $row['user_pass']) { // WARNING: if you later hash passwords, change this to password_verify()
            
            // Correct password, start session
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            echo "Login successful! Welcome, " . htmlspecialchars($row['username']);
            // You can redirect here, like:
            // header("Location: dashboard.php");
            // exit();
        } else {
            echo "Incorrect email or password.";
        }
    } else {
        echo "Incorrect email or password.";
    }
}
?>
