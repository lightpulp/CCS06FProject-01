<?php
include 'config.php';

$sql = "SELECT a.article_id, a.title, u.user_name, a.status, c.category_name FROM articles a
        JOIN users u ON a.user_id = u.user_id
        JOIN categories c ON a.category_id = c.category_id
        WHERE a.status != 4";  // Exclude deleted articles

$result = mysqli_query($conn, $sql);

$articles = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $articles[] = $row;
    }
} else {
    echo json_encode(['error' => 'No articles found']);
    exit;
}

echo json_encode($articles);
?>
