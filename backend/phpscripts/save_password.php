<?php
session_start();
include "config.php"; // include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $oldPass = $_POST['user_pass'];
    $newPass = $_POST['new_pass'];

    // Get the user_id from the session
    $user_id = $_SESSION['user_id'];

    // Get the user's current password from the database
    $sql = "SELECT user_pass FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // Verify the old password
        if (password_verify($oldPass, $row['user_pass'])) {
            // Old password is correct, now update with the new password
            $hashedNewPass = password_hash($newPass, PASSWORD_DEFAULT);

            $updateSql = "UPDATE users SET user_pass = ? WHERE user_id = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("si", $hashedNewPass, $user_id);

            if ($updateStmt->execute()) {
                echo "Password successfully changed.";
            } else {
                echo "Error updating password.";
            }
        } else {
            echo "Old password is incorrect.";
        }
    } else {
        echo "User not found.";
    }

    $stmt->close();
    $conn->close();
}
?>
