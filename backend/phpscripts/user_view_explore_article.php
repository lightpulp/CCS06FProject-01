<?php
include "config.php";
include "session.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'post_comment') {
        $article_id = intval($_POST['article_id']);
        $user_id = $_SESSION['user_id']; // assuming you use session
        $comment = trim($_POST['comment']);

        if ($article_id > 0 && !empty($comment)) {
            $stmt = $conn->prepare("INSERT INTO comments (article_id, user_id, comment) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $article_id, $user_id, $comment);
            if ($stmt->execute()) {
                echo json_encode(["status" => "success"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Insert failed"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid input"]);
        }
    }

    if ($action === 'fetch_comments') {
        $article_id = intval($_POST['article_id']);
        $stmt = $conn->prepare("SELECT c.comment, c.created_at, u.user_name 
                                FROM comments c 
                                JOIN users u ON c.user_id = u.user_id 
                                WHERE c.article_id = ? 
                                ORDER BY c.created_at DESC LIMIT 10");
        $stmt->bind_param("i", $article_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $comments = [];
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }

        echo json_encode($comments);
    }
}
?>
