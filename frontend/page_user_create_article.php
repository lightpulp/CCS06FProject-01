<?php
include "../backend/phpscripts/session.php";
include "../backend/phpscripts/account.php";
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
    <title>Create Article</title>
</head>

<style>
 /* Custom file upload styling */
        .custom-file-upload {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 80%;
            border: 2px dashed #ccc;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            position: relative;
        }

        .row.align-stretch {
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
        }

        .custom-file-upload:hover {
            background: #e9ecef;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .file-text {
            font-weight: 500;
            color: #495057;
            font-size: 1.1rem;
        }

        .custom-file-upload i {
            transition: transform 0.3s ease;
            font-size: 40px;
            color: var(--bs-gray-700);
            margin-bottom: 10px;
        }

        .custom-file-upload:hover i {
            transform: scale(1.1);
            color: var(--bs-brand-color);
        }

        .file-selected {
            border-color: #28a745;
            background: #e7f1ff;
        }

        .file-selected i {
            color: #28a745;
        }

        /* Hide the default input */
        #file-upload {
            display: none;
        }
</style>
<body>

    <!-- start: Sidebar -->
    <div class="sidebar position-fixed top-0 bottom-0 bg-white border-end">
        <div class="d-flex align-items-center p-3">
            <a href="#" class="sidebar-logo text-uppercase fw-bold text-decoration-none text-brand fs-4">TUTUBAN</a>
            <i class="sidebar-toggle ri-arrow-left-circle-line ms-auto fs-5 d-none d-md-block"></i>
        </div>

        <ul class="sidebar-menu p-3 m-0 mb-0">
            <!-- User Overview Bar -->
            <li class="sidebar-menu-item">
                <a href="page_user_dashboard.php">
                    <i class="ri-dashboard-line sidebar-menu-item-icon"></i>
                    User Overview
                </a>
            </li>
            
            <!-- My Articles Bar -->
            <li class="sidebar-menu-item">
                <a href="#">
                    <i class="ri-newspaper-line sidebar-menu-item-icon"></i>
                    My Articles
                </a>
            </li>

            <!-- Explore Article Bar -->
            <li class="sidebar-menu-item">
                <a href="#">
                    <i class="ri-bar-chart-2-line sidebar-menu-item-icon"></i>
                    Explore
                </a>
            </li>

            <!-- Settings Bar -->
            <li class="sidebar-menu-item has-dropdown">
                <a href="#" id="settingBar">
                    <i class="ri-settings-2-line sidebar-menu-item-icon"></i>
                    Settings
                    <i class="ri-arrow-down-s-line sidebar-menu-item-accordion ms-auto"></i>
                </a>

                <!-- Dropdown Menu: Settings -->
                <ul class="sidebar-dropdown-menu">

                   <!-- Settings: Profile Setting -->
                    <li class="sidebar-dropdown-menu-item">
                        <a href="page_user_account.php">
                            Profile Setting
                        </a>
                    </li>

                    <li class="sidebar-dropdown-menu-item">
                        <a href="page_change_password_account.php">
                            Change Password
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="sidebar-overlay"></div>
    <!-- end: Sidebar -->

    <!-- start: Main -->
    <main class="bg-light">
        <div class="px-3 py-3">
            <!-- start: Navbar -->
            <nav class="px-3 py-2 mb-3 border-bottom">
                <i class="ri-menu-line sidebar-toggle me-3 d-block d-md-none"></i>
                <div class="col">
                    <h3 class="fw-bolder me-auto text-muted">Create Article</h3>
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

            <!-- start: Content -->
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                            <form id="articleForm"">
                                <!-- top row: 2 columns -->
                                <div class="row align-stretch">
                                    <!-- left column -->
                                    <div class="col-md-6">
                                        <!-- Title -->
                                        <div class="form-group mb-3">
                                            <label for="createArticleTitle" class="fw-semibold fs-7 mb-2 text-muted">Title</label>
                                            <input type="text" name="createArticleTitle" id="title" class="form-control" placeholder="Enter your Title Here">
                                        </div>

                                        <!-- Title -->
                                        <div class="form-group mb-3">
                                            <label for="category" class="fw-semibold fs-7 mb-2 text-muted">Category</label>
                                            <select id="category" name="createArticleCategory" class="form-select">
                                                <option selected>Select Category</option>
                                            </select>
                                        </div>

                                        <!-- Source URL -->
                                        <div class="form-group mb-3">
                                            <label for="source_url" class="fw-semibold fs-7 mb-2 text-muted">Source URL</label>
                                            <input type="text" name="createSourceURL" id="source_url" class="form-control" placeholder="Enter your Source URL here">
                                        </div>
										
										<div class="mb-3 d-none">
											<label for="date_published" class="form-label">Date Published</label>
											<input type="date" class="form-control" id="date_published" required>
										</div>
                                    </div>
                                    <!-- right column -->
                                    <div class="col-md-6 mb-2">
                                        <!-- File Upload Field -->
                                        <label for="createArticleImage" class="fw-semibold fs-7 mb-2 text-muted">Image</label>
                                        <div class="custom-file-upload position-relative">
                                            <input type="file" id="file-upload" accept=".jpg,.jpeg,.png" required>
                                            <div class="file-text">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                <p>Click to Upload Image</p>
                                            </div>

                                            <!-- Cancel icon -->
                                            <button type="button" class="cancel-upload d-none" aria-label="Cancel upload">
                                                <i class="fas fa-times-circle"></i>
                                            </button>
                                            <div class="invalid-feedback mt-2">Please select a file.</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- full-width content editor -->
                                <div class="row">
                                    <div class="col-md-12">
                                    <label for="createArticleContent" class="fw-semibold fs-7 mb-2 text-muted">Content</label>
                                    <textarea class="form-control" id="createArticleContent" name="createArticleContent" placeholder="Enter your content here" style="min-height: 200px;"></textarea>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <button type="submit" class="btn btn-primary w-100 mt-3 primaryBtnAnimate">Submit Article</button>
                            </form>
                    </div> <!-- /.card-body -->
                </div> <!-- /.col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->
             <!-- end: Content -->
        </div>

    </main>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <!-- HTML5 export buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    
    <!-- Dropzone on CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    
    <script src="../assets/script/script.js"></script>
    <!-- end: JS -->

    <script>
        // File upload input handling
        const fileInput = document.querySelector("#file-upload");
        const fileText = document.querySelector(".file-text");

        fileInput.parentElement.addEventListener("click", () => fileInput.click());

        fileInput.addEventListener("change", function () {
            if (fileInput.files.length > 0) {
                const fileName = fileInput.files[0].name;
                fileText.innerHTML = `<i class="fas fa-check-circle"></i><br>${fileName}`;
                fileInput.closest(".custom-file-upload").classList.add("file-selected");
            } else {
                fileText.innerHTML = `<i class="fas fa-cloud-upload-alt"></i><br>Click to Upload or drag & drop`;
                fileInput.closest(".custom-file-upload").classList.remove("file-selected");
            }
        });
    </script>

    <?php include "../components/button_logout.php" ?>

</body>
</html>

