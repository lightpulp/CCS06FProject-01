<?php
include "config.php";
include "session.php";

// Set header for JSON response
header('Content-Type: application/json');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die(json_encode(['success' => false, 'error' => 'Method not allowed']));
}

// Get article ID from POST data
$article_id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($article_id <= 0) {
    http_response_code(400);
    die(json_encode(['success' => false, 'error' => 'Invalid article ID']));
}

try {
    // Verify article exists and belongs to user (or admin has permission)
    $stmt = $conn->prepare("SELECT article_id FROM articles WHERE article_id = ? AND (user_id = ? OR ? = 1)");
    $admin_role = $_SESSION['role'] ?? 0; // Assuming 1 is admin role
    $stmt->bind_param("iii", $article_id, $_SESSION['user_id'], $admin_role);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        http_response_code(403);
        die(json_encode(['success' => false, 'error' => 'Article not found or unauthorized']));
    }

    // Soft delete by setting status to 4
    $update_stmt = $conn->prepare("UPDATE articles SET status = 4 WHERE article_id = ?");
    $update_stmt->bind_param("i", $article_id);
    
    if ($update_stmt->execute()) {
        // Log the deletion activity
        include "log_activity.php";
        log_activity("Article Deleted", "Soft-deleted article ID: $article_id");
        
        echo json_encode(['success' => true]);
    } else {
        throw new Exception("Failed to update article status: " . $conn->error);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>