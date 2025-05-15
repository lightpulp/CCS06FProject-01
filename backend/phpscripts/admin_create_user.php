<?php
header('Content-Type: application/json');
ob_start();

// 1) INCLUDES: adjust paths to match your folder structure
include "config.php";

// 2) ONLY allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

// 3) COLLECT & SANITIZE
$user_fname       = trim($_POST['user_fname'] ?? '');
$user_lname       = trim($_POST['user_lname'] ?? '');
$user_name        = trim($_POST['user_name'] ?? '');
$user_pass        = $_POST['user_pass'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';
$user_email       = filter_var($_POST['user_email'] ?? '', FILTER_VALIDATE_EMAIL);
$birthdate        = $_POST['birthdate'] ?? null;
$address          = trim($_POST['address'] ?? '');
$number           = trim($_POST['number'] ?? '');
$role             = isset($_POST['role']) ? (int)$_POST['role'] : 0;
$active           = isset($_POST['active']) ? (int)$_POST['active'] : 1;

// 5) HASH PASSWORD
$hashed_pass = password_hash($user_pass, PASSWORD_DEFAULT);

// 6) CHECK UNIQUE USERNAME & EMAIL
// assuming $conn is a mysqli instance; if PDO, adapt accordingly
$stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE user_name = ? OR user_email = ?");
$stmt->bind_param('ss', $user_name, $user_email);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

if ($count > 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Username or email already exists.'
    ]);
    exit;
}

// 7) INSERT
$sql = "INSERT INTO users
    (user_name, user_pass, user_fname, user_lname, user_email, birthdate, address, number, role, active)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    'ssssssssii',
    $user_name,
    $hashed_pass,
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
    echo json_encode([
        'success' => true,
        'message' => 'Account created successfully.',
        'user_id' => $stmt->insert_id
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $stmt->error
    ]);
}

$stmt->close();
$conn->close();
exit;
