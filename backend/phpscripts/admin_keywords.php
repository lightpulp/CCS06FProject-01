<?php
include "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $word = trim($_POST['fakeWord']);
    $value = intval($_POST['fakeValue']);

    if (!empty($word) && $value >= 1 && $value <= 5) {
        $stmt = $conn->prepare("INSERT INTO fake_kw (fword_word, fword_value) VALUES (?, ?)");
        $stmt->bind_param("si", $word, $value);
        $stmt->execute();
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $conn->query("SELECT * FROM fake_kw WHERE is_active = 1 ORDER BY fword_id DESC");
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
        $stmt = $conn->prepare("UPDATE fake_kw SET is_active = 0 WHERE fword_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
    exit;
}
?>
