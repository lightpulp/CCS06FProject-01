<?php
include "config.php"; // Your DB connection
session_start(); // Start session to access user data

// Get current user ID from session (adjust based on your session structure)
$current_user_id = $_SESSION['user_id'] ?? null;

if (!$current_user_id) {
    http_response_code(401); // Unauthorized
    echo json_encode(["error" => "User not authenticated"]);
    exit;
}

// Modified query to filter by user_id
$sql = "SELECT f_words FROM articles WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $current_user_id);
$stmt->execute();
$result = $stmt->get_result();

$keywordCounts = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fWordsJson = $row['f_words'];
        $fWordsArray = json_decode($fWordsJson, true);

        if (is_array($fWordsArray)) {
            foreach (array_keys($fWordsArray) as $word) {
                if (!empty($word)) {
                    $keywordCounts[$word] = ($keywordCounts[$word] ?? 0) + 1;
                }
            }
        }
    }
}

// Sort by frequency descending
arsort($keywordCounts);

// Limit to top 5 keywords
$topKeywords = array_slice($keywordCounts, 0, 5, true);

// Return JSON format
header('Content-Type: application/json');
echo json_encode([
    "labels" => array_keys($topKeywords),
    "data" => array_values($topKeywords)
]);
?>