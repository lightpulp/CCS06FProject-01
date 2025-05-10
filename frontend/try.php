<?php
include "../backend/phpscripts/session.php";
include "../backend/phpscripts/account.php";
include "../backend/phpscripts/check_role.php";
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
    <title>Explore Article</title>
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
                    <p class="h6 fst-normal text-body-tertiary mb-2 webPageDesc">Manage accounts information and roles</p>
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
                        <!-- Controls: responsive row -->
                        <div class="row align-items-center mb-4 mx-5">
                            <!-- Search box -->
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="text" class="form-control table-search" data-table="#exploreArticlesTable" placeholder="Search for title, category, content, status">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                        </div>

                        <!-- DataTable -->
                        <div class="table-responsive">
                            <table id="exploreArticlesTable" class="table table-hover nowrap d-none" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Article Title</th>
                                        <th>Content</th>
                                        <th>Author</th>
                                        <th>Category</th>
                                        <th>Source URL</th>
                                        <th>Status</th>
                                        <th>Date Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="admin-article-body">
                                    <!-- Users will be dynamically inserted here -->
                                </tbody>
                            </table>
                        </div>
                        <!-- Card View Container -->
                        <div id="exploreCardViewArticleContainer" class="article-card-wrapper row g-4 mx-5"></div>
                        <!-- custom footer placeholders -->
                        <div class="my-footer row">
                            <div class="col">
                                <div id="infoContainer" class="footer-block"></div>
                                <div id="paginateContainer" class="footer-block"></div>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <div id="lengthContainer" class="footer-block"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar: Article Statistics & Approval -->
                    <div class="col-12 col-md-4 mt-4 mt-md-0">
                        <!-- only show on md+ -->
                        <div class="position-md-sticky d-none d-md-block" style="top: 1rem;">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <div class="mb-3 pb-3 border-bottom">
                                    <h6 class="text-muted mb-1 fw-bold fs-6">Filter Article</h6>
                                        <div id="exploreCategoryFilters">
                                            <!-- checkboxes go here -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <!-- Offcanvas: mobile filter panel -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="mobileFilterCanvas" aria-labelledby="mobileFilterLabel">
        <div class="offcanvas-header">
            <h5 id="mobileFilterLabel" class="offcanvas-title">Filter Article</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div id="exploreCategoryFiltersMobile"></div>
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
    <script src="../backend/javascript/user_explore_article.js"></script>
    
    <?php include "../components/button_logout.php" ?>

    <!-- Floating filter toggle (mobile only) -->
        <button
            class="btn btn-primary position-fixed d-md-none"
            style="bottom: 1rem; right: 1rem; z-index: 1055;"
            data-bs-toggle="offcanvas"
            data-bs-target="#mobileFilterCanvas"
            aria-controls="mobileFilterCanvas"
            >
            <i class="fas fa-filter"></i>
        </button>
</body>
</html>