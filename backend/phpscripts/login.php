<?php
include "config.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_email = $_POST['user_email'];
    $user_pass = $_POST['user_pass'];

    // Check if email exists
    $sql = "SELECT user_id, user_name, user_pass, role FROM users WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        // User found
        $row = mysqli_fetch_assoc($result);

        // Verify password using password_verify()
        if (password_verify($user_pass, $row['user_pass'])) {
            // Correct password, start session
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['role'] = $row['role'];

            echo "Login successful! Welcome, " . htmlspecialchars($row['user_name']);
            header("Location: ../../frontend/page_user_dashboard.php");
            exit();
        } else {
            echo "Incorrect email or password.";
        }
    } else {
        echo "Incorrect email or password.";
    }
}
?>