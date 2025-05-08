<?php
include "config.php";

// Initialize counters
$total = 0;
$pending = 0;
$approved = 0;
$fake = 0;

// Fetch all non-deleted articles for this user
$stmt = $conn->prepare("SELECT status FROM articles WHERE user_id = ? AND status != 4");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $total++;
    switch ($row['status']) {
        case 1: $pending++; break;
        case 2: $approved++; break;
        case 3: $fake++; break;
    }
}

// Store for later display
$article_counts = [
    'total' => $total,
    'pending' => $pending,
    'approved' => $approved,
    'fake' => $fake
];
?>
