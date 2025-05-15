<?php
include "config.php"; // Your DB connection

$sql = "SELECT f_words FROM articles";
$result = $conn->query($sql);

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
echo json_encode([
    "labels" => array_keys($topKeywords),
    "data" => array_values($topKeywords)
]);
?>
