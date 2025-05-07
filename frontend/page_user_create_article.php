<?php
include "../backend/phpscripts/session.php";
include "../backend/phpscripts/account.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Create New Article</h2>
    <form id="articleForm">
        <div class="mb-3">
            <label for="title" class="form-label">Article Title</label>
            <input type="text" class="form-control" id="title" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label for="source_url" class="form-label">Source URL</label>
            <input type="url" class="form-control" id="source_url">
        </div>

        <div class="mb-3">
            <label for="date_published" class="form-label">Date Published</label>
            <input type="date" class="form-control" id="date_published" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" id="category" required>
                <option value="">Loading categories...</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit Article</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../backend/javascript/user_create_article.js"></script>
</body>
</html>
