<?php
include "../backend/phpscripts/session.php";
include "../backend/phpscripts/account.php";
include "../backend/phpscripts/config.php";

// Get article ID from URL and validate
$article_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch article details with category name
$sql = "SELECT a.*, u.user_name, u.user_fname, u.user_lname, c.category_name 
        FROM articles a
        JOIN users u ON a.user_id = u.user_id
        JOIN categories c ON a.category_id = c.category_id
        WHERE a.article_id = ? AND a.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $article_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$article = $result->fetch_assoc();

/*
if (!$article) {
    // Article not found or doesn't belong to user
    header("Location: page_user_article_management.php");
    exit();
}
*/

// Format date
$formatted_date = date('M j, Y', strtotime($article['created_at']));

// Determine status display
$status_display = '';
$status_class = '';
switch ($article['status']) {
    case 1:
        $status_display = 'Pending';
        $status_class = 'status-yellow';
        break;
    case 2:
        $status_display = 'Approved';
        $status_class = 'status-active';
        break;
    case 3:
        $status_display = 'Fake';
        $status_class = 'status-red';
        break;
    case 4:
        $status_display = 'Deleted';
        $status_class = 'status-inactive';
        break;
    default:
        $status_display = 'Unknown';
        $status_class = 'status-inactive';
}

// Process flagged words if they exist
$flagged_words = [];
if (!empty($article['f_words'])) {
    $flagged_words = json_decode($article['f_words'], true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        $flagged_words = explode(',', $article['f_words']);
    }
}
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
                    <h3 class="fw-bolder me-auto text-muted">View Article</h3>
                    <p class="h6 fst-normal text-body-tertiary mb-2 webPageDesc">View article details and statistics</p>
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
                                        <span class="badge bg-brand-500 py-2 px-3 fw-bold fs-6"><?php echo htmlspecialchars($article['category_name']); ?></span>
                                        <a href="page_user_article_management.php" class="text-decoration-none text-muted">
                                            <i class="fas fa-arrow-left me-1"></i> Back to Articles
                                        </a>
                                    </div>

                                    <!-- Headline -->
                                    <h2 class="card-title fw-bold mb-2">
                                        <?php echo htmlspecialchars($article['title']); ?>
                                    </h2>

                                    <!-- Author & date -->
                                    <p class="text-muted mb-4">
                                        By <strong><?php echo htmlspecialchars($article['user_fname'] . ' ' . $article['user_lname']); ?></strong> &nbsp;|&nbsp; <?php echo $formatted_date; ?>
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
                                        <a href="<?php echo htmlspecialchars($article['source_url']); ?>" target="_blank" rel="noopener"><?php echo parse_url($article['source_url'], PHP_URL_HOST); ?></a>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar: Article Statistics & Approval -->
                    <div class="col-12 col-md-4 mt-4 mt-md-0">
                        <div class="position-md-sticky" style="top: 1rem;">

                            <!-- Fake News Statistics Card -->
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <div class="pb-3 mb-3 d-flex flex-column justify-content-center align-items-center border-bottom">
                                        <h6 class="text-muted fw-bold fs-5">This article is</h6>
                                        <div id="fakeNewsPercent" class="mb-2"></div>
                                        <h6 class="text-muted fw-bold fs-5">Fake</h6>
                                    </div>
                                    <div class="mb-3 pb-3 border-bottom">
                                        <h6 class="text-muted mb-1 fw-bold fs-6">Total Words Analyzed</h6>
                                        <p class="mb-0 text-muted fw-bolder fs-3"><?php echo !empty($article['total_words']) ? htmlspecialchars($article['total_words']) : 'N/A'; ?></p>
                                    </div>
                                    <div class="mb-3 pb-3 border-bottom">
                                        <h6 class="text-muted mb-1 fw-bold fs-6">Fake News Score</h6>
                                        <p class="mb-0 text-muted fw-bolder fs-3"><?php echo !empty($article['f_score']) ? htmlspecialchars($article['f_score']) : 'N/A'; ?></p>
                                    </div>
                                    <div>
                                        <h6 class="text-muted mb-1 fw-bold fs-6 mb-3">Flagged Keywords</h6>
                                        <?php if (!empty($flagged_words)): ?>
                                            <?php foreach ($flagged_words as $keyword => $score): ?>
                                                <span class="badge rounded-pill bg-brand-500 text-white px-3 py-2 me-1 mb-1 fs-7 fw-semibold">
                                                <?php echo htmlspecialchars($keyword); ?>
                                                </span>
                                            <?php endforeach; ?>
                                            <?php else: ?>
                                            <p class="text-muted small">No flagged keywords found</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Approval Status Card -->
                            <div class="card shadow-sm p-4">
                                <div class="d-flex flex-column justify-content-center align-items-center border-bottom mb-2">
                                    <h6 class="text-muted fw-bold fs-5">Approval Status</h6>
                                    <div class='rounded px-4 py-2 <?php echo $status_class; ?> text-center mb-3 fw-bolder' style='max-width: 120px;'><?php echo $status_display; ?></div>
                                </div>
                                <div class="mb-3 border-bottom">
                                    <h6 class="text-muted fw-bold fs-6">Reason</h6>
                                    <p class="small text-muted mb-3 fs-7">
                                        <?php if ($article['status'] == 1): ?>
                                            Your article is under review and waiting for approval.
                                        <?php elseif ($article['status'] == 2): ?>
                                            Your article has been approved and published.
                                        <?php elseif ($article['status'] == 3): ?>
                                            Your article has been flagged as potentially containing misinformation.
                                        <?php else: ?>
                                            Status information not available.
                                        <?php endif; ?>
                                    </p>
                                </div>

                                <!-- If Article is not showing -->
                                <?php if ($article['status'] != 2): // Only show if NOT published ?>
                                <!-- Edit Article -->
                                <div class="mb-3 border-bottom">
                                    <h6 class="text-muted fw-bold fs-6">Edit Article</h6>
                                    <a href="page_user_edit_article.php?id=<?php echo $article['article_id']; ?>" class="btn btn-primary w-100 mt-3 primaryBtnAnimate fw-semibold py-2 rounded">Edit Article</a>
                                </div>
                                <?php endif; ?>

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
    <script src="https://cdn.jsdelivr.net/npm/progressbar.js"></script>
    <script src="../assets/script/script.js"></script>

    <script>
        $(document).ready(function () {
            var percentage = <?php echo !empty($article['percentage']) ? $article['percentage'] : 0; ?>;
            
            // Only initialize the progress bar if the element exists
            if ($('#fakeNewsPercent').length) {
                var bar = new ProgressBar.Circle('#fakeNewsPercent', {
                    color: percentage > 50 ? '#8B0000' : '#28a745', // Red for high percentage, green for low
                    strokeWidth: 5,
                    trailWidth: 2,
                    easing: 'easeInOut',
                    duration: 1400,
                    text: {
                        autoStyleContainer: false
                    },
                    from: { color: percentage > 50 ? '#8B0000' : '#28a745', width: 5 },
                    to: { color: percentage > 50 ? '#8B0000' : '#28a745', width: 5 },
                    step: function (state, circle) {
                        circle.setText(Math.round(circle.value() * 100) + '%');
                    }
                });

                // Force style overrides
                bar.text.style.position = 'absolute';
                bar.text.style.left = '50%';
                bar.text.style.top = '50%';
                bar.text.style.transform = 'translate(-50%, -50%)';
                bar.text.style.fontFamily = '"Open Sans", sans-serif';
                bar.text.style.fontSize = '1.2rem';
                bar.text.style.fontWeight = 'bold';

                bar.animate(percentage / 100);
            }
        });
    </script>
    
    <?php include "../components/button_logout.php" ?>

</body>
</html>