<?php
include "../backend/phpscripts/session.php";
include "../backend/phpscripts/account.php";
include "../backend/phpscripts/config.php";

// Get article ID from URL and validate
$article_id = isset($_GET['article_id']) ? intval($_GET['article_id']) : 0;

if ($article_id <= 0) {
    die("Invalid article ID");
}

// Fetch article details with category name
$sql = "SELECT a.*, u.user_name, u.user_fname, u.user_lname, c.category_name 
        FROM articles a
        JOIN users u ON a.user_id = u.user_id
        JOIN categories c ON a.category_id = c.category_id
        WHERE a.article_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $article_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Article not found");
}

$article = $result->fetch_assoc();

// Format the date if needed
$formatted_date = date('M j, Y', strtotime($article['created_at']));
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- start: Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <!-- start: Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- start: CSS -->
    <link rel="stylesheet" href="../assets/styles/style.css">
    <!-- end: CSS -->
    <title><?php echo htmlspecialchars($article['title']); ?></title>
</head>
<style>
        /* make the sidebar sticky + scrollable */
        .sticky-sidebar {
            position: sticky;
            top: 1rem;
            max-height: calc(100vh - 2rem);
            overflow-y: auto;
            padding-right: .5rem;
        }

        /* optionally limit the comment-list height inside the card */
        .comments-list {
            max-height: 50vh;
            overflow-y: auto;
        }

        /* hide the little scrollbar inside the textarea */
            .comment-auto-resize {
            overflow: hidden;
            resize: none;
        }
</style>
<body>

    <!-- start: Sidebar -->
        <?php include '../components/sidebar.php'; ?>
    <!-- end: Sidebar -->

    <!-- start: Main -->
    <main class="bg-light account-mgmt">
        <div class="px-3 py-3">
            <!-- start: Navbar -->
            <nav class="px-3 py-2 mb-3 border-bottom">
                <i class="ri-menu-line sidebar-toggle me-3 d-block d-md-none"></i>
                <div class="col">
                    <h3 class="fw-bolder me-auto text-muted">Explore Article</h3>
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
            <!-- Updated Article View Page Layout -->
            <div class="container-fluid">
                <div class="row">
                    <!-- Main Article Content -->
                    <div class="col-12 col-md-8">
                        <div class="my-1">
                            <div class="col-12">
                                <div>
                                    <!-- Top row: category badge + save action -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="badge bg-brand-500 py-2 px-3 fw-bold fs-6">
                                            <?php echo htmlspecialchars($article['category_name']); ?>
                                        </span>
                                        <a href="#" class="text-decoration-none text-muted">
                                            <!-- Save button can go here -->
                                        </a>
                                    </div>

                                    <!-- Headline -->
                                    <h2 class="card-title fw-bold mb-2">
                                        <?php echo htmlspecialchars($article['title']); ?>
                                    </h2>

                                    <!-- Author & date -->
                                    <p class="text-muted mb-4">
                                        By <strong><?php echo htmlspecialchars($article['user_name']); ?></strong> 
                                        &nbsp;|&nbsp; <?php echo $formatted_date; ?>
                                    </p>

                                    <!-- Featured image with 4:3 aspect ratio -->
                                    <div class="aspect-ratio-4-3 mb-4" role="button" data-bs-toggle="modal" data-bs-target="#articleImageModal">
                                        <img
                                            src="https://images.unsplash.com/photo-1610792472618-8900baee6882"
                                            alt="Article image"
                                        />
                                    </div>

                                    <!-- Body text -->
                                    <div class="card-text mb-4">
                                        <?php echo nl2br(htmlspecialchars($article['content'], ENT_QUOTES|ENT_SUBSTITUTE)); ?>
                                    </div>

                                    <!-- Source footer -->
                                    <?php if (!empty($article['source_url'])): ?>
                                    <p class="mb-0">
                                        <strong>Source:</strong>
                                        <a href="<?php echo htmlspecialchars($article['source_url']); ?>" target="_blank" rel="noopener">
                                            <?php echo parse_url($article['source_url'], PHP_URL_HOST); ?>
                                        </a>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>                    

                    <!-- Sidebar: Article Statistics & Approval + Comments -->
                    <div class="col-12 col-md-4 mt-4 mt-md-0">
                        <div class="sticky-sidebar">

                            <!-- Comments Card -->
                            <div class="card mb-4 shadow-sm">
                                <div class="px-3 py-3">
                                    <!-- 1) Header -->
                                    <h5 class="fw-bold mb-3">Comments</h5>

                                    <!-- 2) New-comment composer -->
                                    <div class="mb-4 p-3 border rounded comment-form">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="me-1">
                                                <img class="navbar-profile-image" src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f" class="rounded-circle" alt="<?php echo htmlspecialchars($user_data['user_name']); ?>">
                                            </div>
                                            <?php echo htmlspecialchars($user_data['user_name']); ?>
                                        </div>
                                        <textarea class="form-control mb-2 comment-auto-resize" rows="1" placeholder="Add a comment…"></textarea>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-primary px-3 py-2 fw-semibold" id="commentArticle">Comment</button>
                                        </div>
                                    </div>

                                    <!-- 3) List of existing comments (scrollable if too tall) -->
                                    <div class="comments-list px-3">
                                        <!-- Comments will be loaded here via AJAX -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="articleImageModal" tabindex="-1" aria-labelledby="articleImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0">
            <img
                src="https://images.unsplash.com/photo-1610792472618-8900baee6882"
                alt="Full Article Image"
                class="img-fluid rounded"
            />
            </div>
        </div>
    </div>

    <!-- start: JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Buttons extension + Bootstrap 5 styling -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>

    <!-- Optional dependencies for CSV/Excel/PDF/print buttons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <!-- HTML5 export buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/progressbar.js"></script>
    <script src="../assets/script/script.js"></script>
    <script>
        $(function(){
            $('.comment-auto-resize')
            // size to fit any existing text/placeholder:
            .each(function(){
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            })
            // then grow on every input:
            .on('input', function(){
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });
        });
    </script>
    <?php include "../components/button_logout.php" ?>

    <script src="../backend/javascript/user_view_explore_article.js"></script>
    <script src="../backend/javascript/log_activity.js"></script>



</body>
</html>