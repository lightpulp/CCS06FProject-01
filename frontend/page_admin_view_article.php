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
    <title>View Article</title>
</head>
<style>
    .aspect-ratio-4-3 {
    position: relative;
    width: 100%;
    padding-top: 56.25%; /* 3/4 = 75% */
    overflow: hidden;
    border-radius: 0.5rem; /* match Bootstrap's .rounded */
}

    .aspect-ratio-4-3 img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
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
                        <div class="my-1">
                            <div class="col-12">
                                <div>
                                    <!-- Top row: category badge + save action -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="badge bg-brand-500 py-2 px-3 fw-bold fs-6">SPORTS</span>
                                        <a href="#" class="text-decoration-none text-muted">
                                        </a>
                                    </div>

                                    <!-- Headline -->
                                    <h2 class="card-title fw-bold mb-2">
                                        Obiena finishes 5th in Shanghai Diamond League, Duplantis on top again
                                    </h2>

                                    <!-- Author & date -->
                                    <p class="text-muted mb-4">
                                        By <strong>John Doe</strong> &nbsp;|&nbsp; Jan 13, 2025
                                    </p>

                                    <!-- Featured image with 4:3 aspect ratio -->
                                    <div class="aspect-ratio-4-3 mb-4" role="button" data-bs-toggle="modal" data-bs-target="#articleImageModal">
                                        <img
                                            src="https://images.unsplash.com/photo-1610792472618-8900baee6882"
                                            alt="Article image"
                                        />
                                    </div>

                                    <!-- Body text -->
                                    <p class="card-text mb-4">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut lacus eros. Cras pretium rhoncus sagittis.
                                        Ut aliquet augue a mauris elementum, eu tempus risus luctus. Suspendisse eget hendrerit sapien. Morbi dignissim velit leo, 
                                        in consequat lectus consequat a. Sed non facilisis lectus. Etiam efficitur ex vel mi faucibus egestas. Morbi ac erat non elit 
                                        sollicitudin lobortis. Suspendisse convallis justo sit amet laoreet mattis. Suspendisse convallis neque ac mi malesuada iaculis. 
                                        Maecenas placerat, felis non sodales suscipit, ligula sem efficitur urna, semper tristique mi turpis et nulla. Nullam consequat 
                                        neque sed est rhoncus dapibus. Donec vestibulum lorem at est finibus, et placerat nisi tempor. Nullam rhoncus dapibus ante ut finibus. 
                                        Curabitur lacinia porttitor urna, eget aliquam diam aliquam sed.


                                    </p>
                                    <p class="card-text mb-4">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut lacus eros. Cras pretium rhoncus sagittis.
                                        Ut aliquet augue a mauris elementum, eu tempus risus luctus. Suspendisse eget hendrerit sapien. Morbi dignissim velit leo, 
                                        in consequat lectus consequat a. Sed non facilisis lectus. Etiam efficitur ex vel mi faucibus egestas. Morbi ac erat non elit 
                                        sollicitudin lobortis. Suspendisse convallis justo sit amet laoreet mattis. Suspendisse convallis neque ac mi malesuada iaculis. 
                                        Maecenas placerat, felis non sodales suscipit, ligula sem efficitur urna, semper tristique mi turpis et nulla. Nullam consequat 
                                        neque sed est rhoncus dapibus. Donec vestibulum lorem at est finibus, et placerat nisi tempor. Nullam rhoncus dapibus ante ut finibus. 
                                        Curabitur lacinia porttitor urna, eget aliquam diam aliquam sed.
                                    </p>
                                    <p class="card-text mb-4">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut lacus eros. Cras pretium rhoncus sagittis.
                                        Ut aliquet augue a mauris elementum, eu tempus risus luctus. Suspendisse eget hendrerit sapien. Morbi dignissim velit leo, 
                                        in consequat lectus consequat a. Sed non facilisis lectus. Etiam efficitur ex vel mi faucibus egestas. Morbi ac erat non elit 
                                        sollicitudin lobortis. Suspendisse convallis justo sit amet laoreet mattis. Suspendisse convallis neque ac mi malesuada iaculis. 
                                        Maecenas placerat, felis non sodales suscipit, ligula sem efficitur urna, semper tristique mi turpis et nulla. Nullam consequat 
                                        neque sed est rhoncus dapibus. Donec vestibulum lorem at est finibus, et placerat nisi tempor. Nullam rhoncus dapibus ante ut finibus. 
                                        Curabitur lacinia porttitor urna, eget aliquam diam aliquam sed.
                                    </p>
                                    <!-- Source footer -->
                                    <p class="mb-0">
                                        <strong>Source:</strong>
                                        <a href="https://rappler.com/sports/pole-vault-results-ej-obiena-shanghai-diamond-league-may-3-2025/" target="_blank" rel="noopener">rappler.com</a>
                                    </p>
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
                                    <h3 class="fw-bold text-danger">75<span class="fs-5">%</span></h3>
                                    <div class='rounded px-2 py-1 status-red text-center' style='max-width: 90px;'>Fake</div>
                                </div>
                                <div class="mb-3 pb-3 border-bottom">
                                    <h6 class="text-muted mb-1 fw-bold fs-6">Total Words Analyzed</h6>
                                    <p class="mb-0 text-muted fw-bolder fs-3">63</p>
                                </div>
                                <div class="mb-3 pb-3 border-bottom">
                                    <h6 class="text-muted mb-1 fw-bold fs-6">Fake News Score</h6>
                                    <p class="mb-0 text-muted fw-bolder fs-3">14</p>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1 fw-bold fs-6 mb-3">Flagged Keywords</h6>
                                    <span class="badge rounded-pill bg-brand-500 text-white px-3 py-2 me-1 mb-1 fs-7 fw-semibold">breaking</span>
                                    <span class="badge rounded-pill bg-brand-500 text-white px-3 py-2 me-1 mb-1 fs-7 fw-semibold">conspiracy</span>
                                    <span class="badge rounded-pill bg-brand-500 text-white px-3 py-2 me-1 mb-1 fs-7 fw-semibold">fake</span>
                                    <span class="badge rounded-pill bg-brand-500 text-white px-3 py-2 me-1 mb-1 fs-7 fw-semibold">miracle</span>
                                    <span class="badge rounded-pill bg-brand-500 text-white px-3 py-2 me-1 mb-1 fs-7 fw-semibold">dayaan</span>
                                </div>
                            </div>
                        </div>

                        <!-- Approval Status Card -->
                        <div class="card shadow-sm">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center border-bottom">
                            <h6 class="text-muted fw-bold fs-5">Approval Status</h6>
                            <div class='rounded px-4 py-2 status-yellow text-center mb-3 fw-bolder' style='max-width: 120px;'>Pending</div>
                            <p class="small text-muted mb-3 fs-6">Would you like to change the approval status of this article?</p>
                            <button class="btn btn-primary rounded fw-semibold py-3 w-100" data-bs-toggle="modal" data-bs-target="#approvalModal">
                            Change Status
                            </button>
                        </div>
                        </div>

                    </div>
                    </div>

                </div>
            </div>

            <!-- Approval Modal -->
            <div class="modal fade" id="approvalModal" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Article Approval Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                    <label for="approvalStatus" class="form-label">Approval Status</label>
                    <select class="form-select" id="approvalStatus">
                        <option selected disabled>Select Approval</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    </div>
                    <div class="mb-3">
                    <label for="approvalReason" class="form-label">Reason</label>
                    <textarea class="form-control" id="approvalReason" rows="4"
                                placeholder="Type your reason for approval/rejection"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Apply Changes</button>
                </div>
                </div>
            </div>
            </div>

<style>
  @media (min-width: 768px) {
    .position-md-sticky {
      position: sticky;
    }
  }
</style>

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
    <script src="../assets/script/script.js"></script>
    
    <?php include "../components/button_logout.php" ?>
    <script src="../backend/javascript/admin_account_table.js"></script>


</body>
</html>