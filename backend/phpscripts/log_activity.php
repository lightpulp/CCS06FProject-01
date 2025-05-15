<?php
function log_activity($action, $details = null) {
    include "config.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $user_id = $_SESSION['user_id'] ?? 0;
    $page_url = $_SERVER['HTTP_REFERER'] ?? 'unknown';

    $stmt = $conn->prepare("INSERT INTO activity_logs (user_id, action, details, page_url) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $action, $details, $page_url);
    return $stmt->execute();
}

// ✅ Check for POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? 'No Action';
    $details = $_POST['details'] ?? null;

    $success = log_activity($action, $details);

    echo json_encode(['success' => $success]);
    exit;
}
?>
