<?php
function logActivity($action, $details = null) {
    include 'config.php';
    include 'session.php';

    if (!isset($_SESSION['user_id'])) {
        return; // Don't log if no user session
    }

    $user_id = $_SESSION['user_id'];
    $page_url = $_SERVER['REQUEST_URI'];

    $stmt = $conn->prepare("INSERT INTO activity_logs 
                          (user_id, action, details, page_url) 
                          VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $action, $details, $page_url);
    $stmt->execute();
}
?>
