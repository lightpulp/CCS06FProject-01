<?php
 include "config.php";
 include "session.php";

 // Get categories for dropdown
 if ($_SERVER['REQUEST_METHOD'] === 'GET') {
     $result = $conn->query("SELECT category_id, category_name FROM categories ORDER BY category_name ASC");
     $categories = [];

     while ($row = $result->fetch_assoc()) {
         $categories[] = $row;
     }

     echo json_encode($categories);
     exit;
 }

 // Handle article creation with fake news analysis
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $data = json_decode(file_get_contents("php://input"), true);

     $title = trim($data['title']);
     $content = trim($data['content']);
     $source_url = trim($data['source_url']);
     $category_id = intval($data['category_id']);
     $date_published = $data['date_published'];
     $status = 1; // Pending

     if ($title && $content && $date_published && $category_id) {
         // --- Fake News Analysis ---
         // Get fake keywords from database
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
             // Remove punctuation from word
             $cleanWord = preg_replace('/[^a-z0-9]/', '', $word);

             if (isset($keywords[$cleanWord])) {
                 $fakeScore += $keywords[$cleanWord];
                 $foundKeywords[$cleanWord] = $keywords[$cleanWord];
             }
         }

         // Calculate fake percentage (more robust version)
         $fakePercentage = 0.00;
         if ($totalWords > 0) {
             $keywordCount = count($foundKeywords);
             $averageWeight = ($keywordCount > 0) ? ($fakeScore / $keywordCount) : 0;
             $keywordDensity = $keywordCount / $totalWords;

             // Weighted calculation for fake percentage
             $fakePercentage = min(100.00,
                 (0.5 * ($fakeScore / $totalWords * 100)) +   // Overall impact of fake words
                 (0.3 * ($keywordDensity * 100)) +        // How prevalent fake words are
                 (0.2 * $averageWeight * 20)             // Severity based on average weight (scaled)
             );
         }
         $formattedPercentage = round($fakePercentage, 2);
         $fWordsList = !empty($foundKeywords) ? json_encode($foundKeywords) : null;

         // Insert article data including fake news analysis results
         $stmt = $conn->prepare("INSERT INTO articles (user_id, title, content, source_url, category_id, status, date_published, percentage, f_words, f_score, total_words)
                                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
         $stmt->bind_param("isssiisdsii", $user_id, $title, $content, $source_url, $category_id, $status, $date_published, $formattedPercentage, $fWordsList, $fakeScore, $totalWords);

         if ($stmt->execute()) {
             echo json_encode(["success" => true, "fake_analysis" => ["percentage" => $formattedPercentage, "score" => $fakeScore, "found_keywords" => $foundKeywords, "total_words" => $totalWords]]);
         } else {
             echo json_encode(["success" => false, "error" => "Failed to insert article.", "mysql_error" => $conn->error]);
         }
     } else {
         echo json_encode(["success" => false, "error" => "Missing required fields."]);
     }

     exit;
 }
 ?>