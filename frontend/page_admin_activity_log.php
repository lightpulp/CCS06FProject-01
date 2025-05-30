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
    <title>Activity Logs</title>
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
                    <h3 class="fw-bolder me-auto text-muted">Activity Logs</h3>
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
            <!-- Controls: responsive row -->
            <div class="row align-items-center gy-2 mb-4">
            <!-- Search box -->
            <div class="col-12 col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control table-search" data-table="#logTable" placeholder="Search for id, account name, username etc.">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
            </div>

            <!-- Button group: Filter, Export, New Account -->
            <div class="col-12 col-md-6">
                <div class="d-flex flex-wrap justify-content-md-end gap-2">
                    <!-- Filter Button -->
                    <button id="filterAccountBtn" class="btn btn-outline-secondary px-4 py-2 fw-semibold" data-bs-toggle="modal" data-bs-target="#filterActivityLogModal">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>

                    <!-- Export Dropdown -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle px-4 py-2 fw-semibold" data-bs-toggle="dropdown">
                            <i class="fas fa-download me-1"></i> Export
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item export-btn" href="#" data-type="csv" data-table="#logTable"><i class="fas fa-file-csv me-1"></i> CSV</a></li>
                            <li><a class="dropdown-item export-btn" href="#" data-type="excel" data-table="#logTable"><i class="fas fa-file-excel me-1"></i> Excel</a></li>
                            <li><a class="dropdown-item export-btn" href="#" data-type="print" data-table="#logTable"><i class="fas fa-print me-1"></i> Print</a></li>
                        </ul>
                    </div>

                    <!-- Clean Logs Button -->
                    <div class="dropdown d-inline-block">
                        <button id="cleanLogsBtn" class="btn btn-primary px-3 py-2 rounded fw-semibold dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-plus me-1"></i> Clean Logs
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item clean-logs-option" data-days="10">Delete past 10 days</a></li>
                            <li><a class="dropdown-item clean-logs-option" data-days="30">Delete past 30 days</a></li>
                            <li><a class="dropdown-item clean-logs-option" data-days="90">Delete past 90 days</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <!-- DataTable -->
        <div class="table-responsive">
        <table id="logTable" class="table table-hover nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Log Id</th>
                    <th>Timestamp</th>
                    <th>Edited By</th>
                    <th>Action</th>
                    <th>Details</th>
                    <th>Page</th>
                </tr>
            </thead>
            <tbody id="user-table-body">
                <!-- Users will be dynamically inserted here -->
            </tbody>
        </table>
        </div>
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
    </main>

    <!-- Filter Modal -->
    <div class="modal fade" id="filterActivityLogModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="filterActivityLogForm">
                    <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Advanced Filter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="filterLogStart" class="form-label">From</label>
                            <input type="date" id="filterLogStart" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="filterLogEnd" class="form-label">To</label>
                            <input type="date" id="filterLogEnd" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="filterLogAction" class="form-label">Action</label>
                            <select id="filterLogAction" class="form-select">
                            <option value="">All</option>
                            <!-- we’ll populate this one dynamically -->
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary py-2 rounded">Apply Filter</button>
                    </div>
                </form>
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
    <script src="../backend/javascript/admin_activity_log.js"></script>
    <script src="../backend/javascript/log_activity.js"></script>

</body>
</html>

