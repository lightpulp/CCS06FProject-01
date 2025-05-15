<?php
header('Content-Type: application/json');
include '../backend/phpscripts/session.php';
include '../backend/phpscripts/account.php';
include '../backend/phpscripts/config.php'; // must define $conn as your mysqli

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success'=>false,'message'=>'Invalid request.']);
    exit;
}

// Sanitize + collect
$user_fname       = trim($_POST['user_fname'] ?? '');
$user_lname       = trim($_POST['user_lname'] ?? '');
$user_name        = trim($_POST['user_name'] ?? '');
$user_pass        = $_POST['user_pass'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';
$user_email       = trim($_POST['user_email'] ?? '');
$birthdate        = $_POST['birthdate'] ?? null;
$address          = trim($_POST['address'] ?? '');
$number           = trim($_POST['number'] ?? '');
$role             = isset($_POST['role']) ? (int) $_POST['role'] : 0;
$active           = isset($_POST['active']) ? (int) $_POST['active'] : 0;

// Basic validation
if (!$user_name || !$user_pass || !$confirm_password || !$user_fname || !$user_lname || !$user_email) {
    echo json_encode(['success'=>false,'message'=>'Please fill in all required fields.']);
    exit;
}
if ($user_pass !== $confirm_password) {
    echo json_encode(['success'=>false,'message'=>'Passwords do not match.']);
    exit;
}
if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success'=>false,'message'=>'Invalid email address.']);
    exit;
}

// Hash password
$password_hash = password_hash($user_pass, PASSWORD_BCRYPT);

// Insert into DB
$sql = "INSERT INTO users
        (user_name,user_pass,user_fname,user_lname,user_email,birthdate,address,`number`,`role`,active)
        VALUES (?,?,?,?,?,?,?,?,?,?)";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param(
      "ssssssssii",
      $user_name,
      $password_hash,
      $user_fname,
      $user_lname,
      $user_email,
      $birthdate,
      $address,
      $number,
      $role,
      $active
    );

    if ($stmt->execute()) {
        echo json_encode(['success'=>true,'message'=>'User created successfully.']);
    } else {
        // duplicate key? 
        if ($stmt->errno === 1062) {
            echo json_encode(['success'=>false,'message'=>'Username or email already exists.']);
        } else {
            echo json_encode(['success'=>false,'message'=>'DB error: '.$stmt->error]);
        }
    }
    $stmt->close();
} else {
    echo json_encode(['success'=>false,'message'=>'DB error: '.$conn->error]);
}
exit;
?>