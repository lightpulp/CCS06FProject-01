<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Categories</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>
<body>

    <h2>Category Management</h2>

    <form id="categoryForm">
        <input type="text" id="categoryName" placeholder="Enter new category" required>
        <button type="submit">Add Category</button>
    </form>

    <table id="categoryTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="category-table-body">
            <!-- Filled by JS -->
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="../backend/javascript/admin_categories.js"></script>

</body>
</html>
