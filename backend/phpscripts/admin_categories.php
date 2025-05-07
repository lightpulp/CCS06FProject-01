<?php
include "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['categoryName']);
    if (!empty($name)) {
        $stmt = $conn->prepare("INSERT INTO categories (category_name) VALUES (?)");
        $stmt->bind_param("s", $name);
        $stmt->execute();
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $conn->query("SELECT * FROM categories ORDER BY category_id DESC");
    $rows = [];

    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    echo json_encode($rows);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = intval($_DELETE['id'] ?? 0);

    if ($id > 0) {
        $stmt = $conn->prepare("DELETE FROM categories WHERE category_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    exit;
}
?>
