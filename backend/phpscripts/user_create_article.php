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

// Handle article creation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $title = trim($data['title']);
    $content = trim($data['content']);
    $source_url = trim($data['source_url']);
    $category_id = intval($data['category_id']);
    $date_published = $data['date_published'];
    $status = 1; // Pending

    if ($title && $content && $date_published && $category_id) {
        $stmt = $conn->prepare("INSERT INTO articles (user_id, title, content, source_url, category_id, status, date_published)
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssiis", $user_id, $title, $content, $source_url, $category_id, $status, $date_published);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "Failed to insert article."]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Missing required fields."]);
    }

    exit;
}
?>
