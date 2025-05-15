<?php
include "config.php";
include "session.php";

// Set header to ensure JSON response
header('Content-Type: application/json');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die(json_encode(["success" => false, "error" => "Method not allowed"]));
}

try {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Invalid JSON input");
    }

    $user_id = intval($data['user_id'] ?? 0);
    $user_fname = trim($data['user_fname'] ?? '');
    $user_lname = trim($data['user_lname'] ?? '');
    $user_name = trim($data['user_name'] ?? '');
    $user_email = trim($data['user_email'] ?? '');
    $birthdate = trim($data['birthdate'] ?? '');
    $number = trim($data['number'] ?? '');
    $address = trim($data['address'] ?? '');
    $role = intval($data['role'] ?? 0);
    $active = intval($data['active'] ?? 0);

    // Basic validation
    if (empty($user_fname) || empty($user_lname) || empty($user_name) || empty($user_email)) {
        throw new Exception("Required fields are missing");
    }

    // Check if username already exists (excluding current user)
    $check_stmt = $conn->prepare("SELECT user_id FROM users WHERE user_name = ? AND user_id != ?");
    $check_stmt->bind_param("si", $user_name, $user_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        throw new Exception("Username already exists");
    }

    // Update user data
    $stmt = $conn->prepare("UPDATE users SET 
                          user_fname = ?,
                          user_lname = ?,
                          user_name = ?,
                          user_email = ?,
                          birthdate = ?,
                          number = ?,
                          address = ?,
                          role = ?,
                          active = ?
                          WHERE user_id = ?");
    $stmt->bind_param("sssssssiii", 
        $user_fname, $user_lname, $user_name, $user_email,
        $birthdate, $number, $address, $role, $active, $user_id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        throw new Exception("Failed to update account: " . $conn->error);
    }

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>