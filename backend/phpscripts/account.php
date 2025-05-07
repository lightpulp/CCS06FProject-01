<?php
// THIS IS TO GET USER ACCOUNT DETAILS

include 'config.php';

$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
} else {
    echo '<script>alert("Something is wrong, please try logging in again");</script>';
    $_SESSION = array();
    header("Location: ../index.php");
    exit();
}
$stmt->close();
$conn->close();
?>