<?php
include "config.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['user_fname'];
    $lname = $_POST['user_lname'];
    $username = $_POST['user_name'];
    $email = $_POST['user_email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $birthdate = $_POST['birthdate'];
    $address = $_POST['address'];
    $number = $_POST['number'];

    // EMAIL CHECKER STILL NOT WORKING
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {


        exit;
    } else {
        $stmt->close();

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (user_fname, user_lname, user_name, user_email, user_pass, birthdate, address, number, role, created_at) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, NOW())");
        $stmt->bind_param("sssssssi", $fname, $lname, $username, $email, $hashedPassword, $birthdate, $address, $number);
    
        if ($stmt->execute()) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Registration failed."]);
        }
    }

    $stmt->close();
    $conn->close();
}
?>
