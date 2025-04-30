<?php
// Access session data
$user_id = $_SESSION['user_id'];
//added the below session variables
$user_name = $_SESSION['user_name'];
$user_role = $_SESSION['role'];

//connect to database to get the rest of the user's information
include '../backend/phpscripts/config.php';

$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
} else {
    // Handle the case where the user ID is not found.
    echo "User not found"; //Or redirect
    exit();
}
$stmt->close();
$conn->close();
?>