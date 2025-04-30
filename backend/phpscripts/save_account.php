<?php
include "config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $fname = $_POST['user_fname'];
    $lname = $_POST['user_lname'];
    $username = $_POST['user_name'];
    $birthdate = $_POST['birthdate'];
    $address = $_POST['address'];
    $number = $_POST['number'];

    $stmt = $conn->prepare("UPDATE users SET user_fname=?, user_lname=?, user_name=?, birthdate=?, address=?, number=? WHERE user_id=?");
    $stmt->bind_param("ssssssi", $fname, $lname, $username, $birthdate, $address, $number, $user_id);

    if ($stmt->execute()) {
        echo "success"; // No JSON, no whitespace
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
}
?>