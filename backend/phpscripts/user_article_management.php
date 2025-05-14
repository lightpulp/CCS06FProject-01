<?php
include 'config.php';
include 'session.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT a.article_id, a.title, a.content, u.user_name, a.source_url, a.status, c.category_name, a.created_at 
        FROM articles a
        JOIN users u ON a.user_id = u.user_id
        JOIN categories c ON a.category_id = c.category_id
        WHERE a.status != 4 AND a.user_id = $user_id";  // Exclude deleted articles

$result = mysqli_query($conn, $sql);

$articles = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc(result: $result)) {
        $articles[] = $row;
    }
} else {
    echo json_encode(['error' => 'No articles found']);
    exit;
}

echo json_encode($articles);
?>
