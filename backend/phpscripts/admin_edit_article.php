<?php
include "config.php";
include "session.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $article_id = intval($data['article_id']);
    $title = trim($data['title']);
    $content = trim($data['content']);
    $source_url = trim($data['source_url']);
    $category_id = intval($data['category_id']);
    $date_published = $data['date_published'];

    // Basic validation
    if ($article_id && $title && $content && $category_id && $date_published) {
        // --- Fake News Analysis ---
        $keywords = [];
        $keywordResult = $conn->query("SELECT fword_word, fword_value FROM fake_kw WHERE is_active = 1");
        while ($row = $keywordResult->fetch_assoc()) {
            $keywords[strtolower($row['fword_word'])] = $row['fword_value'];
        }

        $words = preg_split('/\s+/', strtolower($content));
        $totalWords = count($words);
        $fakeScore = 0;
        $foundKeywords = [];

        foreach ($words as $word) {
            $cleanWord = preg_replace('/[^a-z0-9]/', '', $word);
            if (isset($keywords[$cleanWord])) {
                $fakeScore += $keywords[$cleanWord];
                $foundKeywords[$cleanWord] = $keywords[$cleanWord];
            }
        }

        $fakePercentage = 0.00;
        if ($totalWords > 0) {
            $keywordCount = count($foundKeywords);
            $averageWeight = ($keywordCount > 0) ? ($fakeScore / $keywordCount) : 0;
            $keywordDensity = $keywordCount / $totalWords;

            $fakePercentage = min(100.00,
                (0.5 * ($fakeScore / $totalWords * 100)) +
                (0.3 * ($keywordDensity * 100)) +
                (0.2 * $averageWeight * 20)
            );
        }

        $formattedPercentage = round($fakePercentage, 2);
        $fWordsList = !empty($foundKeywords) ? json_encode($foundKeywords) : null;

        // Update article in database
        $stmt = $conn->prepare("UPDATE articles SET title = ?, content = ?, source_url = ?, category_id = ?, date_published = ?, percentage = ?, f_words = ?, f_score = ?, total_words = ? WHERE article_id = ?");
        $stmt->bind_param("sssisdsiii", $title, $content, $source_url, $category_id, $date_published, $formattedPercentage, $fWordsList, $fakeScore, $totalWords, $article_id);

        if ($stmt->execute()) {
            echo json_encode([
                "success" => true,
                "message" => "Article updated successfully.",
                "fake_analysis" => [
                    "percentage" => $formattedPercentage,
                    "score" => $fakeScore,
                    "found_keywords" => $foundKeywords,
                    "total_words" => $totalWords
                ]
            ]);
        } else {
            echo json_encode(["success" => false, "error" => "Update failed.", "mysql_error" => $conn->error]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Missing or invalid required fields."]);
    }

    exit;
}
?>
