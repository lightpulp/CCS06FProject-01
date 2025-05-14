<?php
include 'config.php';
include 'session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['days'])) {
    $days = intval($_POST['days']);

    if (!in_array($days, [10, 30, 90])) {
        echo "Invalid request.";
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM activity_logs WHERE created_at < NOW() - INTERVAL ? DAY");
    $stmt->bind_param("i", $days);
    
    if ($stmt->execute()) {
        echo "Logs older than $days days have been deleted.";
    } else {
        echo "Error deleting logs.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}
?>
