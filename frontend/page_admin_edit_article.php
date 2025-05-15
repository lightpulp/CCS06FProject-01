<?php
include "../backend/phpscripts/session.php";
include "../backend/phpscripts/account.php";
include "../backend/phpscripts/config.php";

// Get article ID from URL and validate
$article_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch article details
$stmt = $conn->prepare("SELECT * FROM articles WHERE article_id = ?");
$stmt->bind_param("i", $article_id);
$stmt->execute();
$result = $stmt->get_result();
$article = $result->fetch_assoc();

if (!$article) {
    header("Location: page_user_article_management.php");
    exit();
}

// Fetch categories
$categories_result = $conn->query("SELECT category_id, category_name FROM categories ORDER BY category_name ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <title>Edit Article</title>
</head>
<style>
    #editAdminArticleForm label.error {
        font-size: 0.8rem;
        font-weight: 600;
        color: #FB667A;
    }
</style>
<body>
    <!-- start: Sidebar -->
    <?php include '../components/sidebar.php'; ?>
    <!-- end: Sidebar -->

    <!-- start: Main -->
    <main class="bg-light">
        <div class="px-3 py-3">
            <!-- start: Navbar -->
            <nav class="px-3 py-2 mb-3 border-bottom">
                <i class="ri-menu-line sidebar-toggle me-3 d-block d-md-none"></i>
                <div class="col">
                    <h3 class="fw-bolder me-auto text-muted">Edit Article</h3>
                </div>
                <div class="dropdown">
                    <div class="d-flex align-items-center cursor-pointer dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <span class="me-2 d-none d-sm-block">
                            <?php echo isset($user_data['user_fname']) ? htmlspecialchars($user_data['user_fname']) : ''; ?> 
                            <?php echo isset($user_data['user_lname']) ? htmlspecialchars($user_data['user_lname']) : ''; ?>
                        </span>
                        <img class="navbar-profile-image"
                            src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cGVyc29ufGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                            alt="Image">
                    </div>
                    <ul class="dropdown-menu p-3" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item rounded text-center py-2" id="logoutAccount" href="#">Log out</a></li>
                    </ul>
                </div>
            </nav>
            <!-- end: Navbar -->
            
            <!-- Edit Article Form -->
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                        <form id="editAdminArticleForm">
                            <input type="hidden" id="article_id" value="<?php echo $article['article_id']; ?>">
                            
                            <!-- top row: 2 columns -->
                            <div class="row align-stretch">
                                <!-- left column -->
                                <div class="col-md-6">
                                    <!-- Title -->
                                    <div class="form-group mb-3">
                                        <label for="title" class="fw-semibold fs-7 mb-2 text-muted">Title</label>
                                        <input type="text" name="admin_edit_title" id="title" class="form-control" 
                                               value="<?php echo htmlspecialchars($article['title']); ?>" 
                                               placeholder="Enter your Title Here">
                                    </div>

                                    <!-- Category -->
                                    <div class="form-group mb-3">
                                        <label for="category" class="fw-semibold fs-7 mb-2 text-muted">Category</label>
                                        <select id="category" name="admin_edit_category" class="form-select">
                                            <option value="">-- Select Category --</option>
                                            <?php while ($category = $categories_result->fetch_assoc()): ?>
                                                <option value="<?php echo $category['category_id']; ?>"
                                                    <?php echo $category['category_id'] == $article['category_id'] ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($category['category_name']); ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>

                                    <!-- Source URL -->
                                    <div class="form-group mb-3">
                                        <label for="source_url" class="fw-semibold fs-7 mb-2 text-muted">Source URL</label>
                                        <input type="text" name="admin_edit_source_url" id="source_url" class="form-control" 
                                               value="<?php echo htmlspecialchars($article['source_url']); ?>" 
                                               placeholder="Enter your Source URL here">
                                    </div>
                                    
                                    <!-- DATE PUBLISHED -->
                                    <div class="form-group mb-3">
                                        <label for="date_published" class="form-label">Date Published</label>
                                        <input type="date" class="form-control" name="admin_edit_date_published" id="date_published" 
                                               value="<?php echo date('Y-m-d', strtotime($article['date_published'])); ?>" required>
                                    </div>
                                </div>
                                <!-- right column -->
                                <div class="col-md-6 mb-2">
                                    <!-- File Upload Field -->
                                    <label for="articleImage" class="fw-semibold fs-7 mb-2 text-muted">Image</label>
                                    <div class="custom-file-upload position-relative">
                                        <!-- Image upload would go here -->
                                    </div>
                                </div>
                            </div>
                            
                            <!-- full-width content editor -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="content" class="fw-semibold fs-7 mb-2 text-muted">Content</label>
                                    <textarea class="form-control" id="content" name="admin_edit_content"  
                                              placeholder="Enter your content here" 
                                              style="min-height: 200px;"><?php echo htmlspecialchars($article['content']); ?></textarea>
                                </div>
                            </div>
                            
                            <hr class="my-4">
                            <button type="submit" class="btn btn-primary w-100 mt-3 primaryBtnAnimate">Save Article</button>
                            <a href="page_admin_article_management.php" class="btn btn-secondary w-100 mt-3">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/script/script.js"></script>
    
    <script>
    $(document).ready(function () {
        // Handle article update
        $("#editAdminArticleForm").validate({
        rules: {
            admin_edit_title: {
               required: true
            },
            admin_edit_category: {
                required: true
            },
            admin_edit_source_url: {
                required: true
            },
            admin_edit_date_published: {
                required: true,
            },
            admin_edit_content: {
                required: true,
            },
        },
        messages: {
            admin_edit_title: "Please enter your title.",
            admin_edit_category: "Please Select a Category.",
            admin_edit_source_url: "Please enter your source URL.",
            admin_edit_date_published: "Please enter your published date.",
            admin_edit_content: "Please put your article content.",
        },
        submitHandler: function (form, e) {
            e.preventDefault();

            const articleData = {
                article_id: $('#article_id').val(),
                title: $('#title').val(),
                content: $('#content').val(),
                source_url: $('#source_url').val(),
                category_id: $('#category').val(),
                date_published: $('#date_published').val()
            };

            $.ajax({
                url: '../backend/phpscripts/admin_edit_article.php',
                type: 'POST',
                data: JSON.stringify(articleData),
                contentType: 'application/json',
                success: function (response) {
                    const res = JSON.parse(response);
                    if (res.success) {
                        alert('Article updated successfully!');
                        window.location.href = 'page_admin_article_management.php';
                    } else {
                        alert('Error: ' + res.error);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error updating article: ' + error);
                }
            });
        }
    });
    });
    </script>
    
    <?php include "../components/button_logout.php" ?>
</body>
</html>