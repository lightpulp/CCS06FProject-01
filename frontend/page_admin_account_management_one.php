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
    <title>Account Management</title>
</head>
<style>
    /* Account Management Section */
    .account-mgmt .btn-group .btn {
    min-width: 4.5rem;
    }

    .account-mgmt table#accountTable thead th {
    background: var(--bs-gray-200);
    color: var(--bs-gray-700);
    text-transform: uppercase;
    font-size: 0.75rem;
    }

    .account-mgmt table#accountTable td img.avatar {
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
    margin-right: 0.5rem;
    }

    .account-mgmt .status-badge {
    display: inline-block;
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
    border-radius: var(--bs-border-radius);
    }

    .status-admin   { background: var(--bs-success);      color: var(--bs-white); }
    .status-user    { background: var(--bs-gray-300);    color: var(--bs-gray-700); }
    .status-active  { background: var(--bs-success);      color: var(--bs-white); }
    .status-inactive{ background: var(--bs-gray-300);    color: var(--bs-gray-700); }
    
    .account-mgmt .action-btn {
        background: transparent;
        border: none;
        color: var(--bs-gray-700);
        cursor: pointer;
        margin: 0 0.25rem;
    }

    .account-mgmt .action-btn:hover {
        color: var(--bs-brand-color);
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
            <!-- Dashboard Bar -->
            <li class="sidebar-menu-item">
                <a href="page_user_dashboard.php">
                    <i class="ri-dashboard-line sidebar-menu-item-icon"></i>
                    Dashboard
                </a>
            </li>
            
            <!-- Manage Articles Bar -->
            <li class="sidebar-menu-item">
                <a href="#">
                    <i class="ri-newspaper-line sidebar-menu-item-icon"></i>
                    Manage Articles
                </a>
            </li>

            <!-- Reports Bar -->
            <li class="sidebar-menu-item">
                <a href="#">
                    <i class="ri-bar-chart-2-line sidebar-menu-item-icon"></i>
                    Reports
                </a>
            </li>

            <!-- Activity Logs Bar -->
            <li class="sidebar-menu-item">
                <a href="#">
                    <i class="ri-bar-chart-2-line sidebar-menu-item-icon"></i>
                    Activity Logs
                </a>
            </li>

            <!-- Account Management Bar -->
            <li class="sidebar-menu-item active">
                <a href="#">
                    <i class="ri-group-line sidebar-menu-item-icon"></i>
                    Account Management
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

                    <!-- Settings: Category Management -->
                    <li class="sidebar-dropdown-menu-item">
                        <a href="page_change_password_account.php">
                            Category Management
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="sidebar-overlay"></div>
    <!-- end: Sidebar -->

    <!-- start: Main -->
    <main class="bg-light account-mgmt">
        <div class="px-3 py-3">
            <!-- start: Navbar -->
            <nav class="px-3 py-2 mb-3 border-bottom">
                <i class="ri-menu-line sidebar-toggle me-3 d-block d-md-none"></i>
                <div class="col">
                    <h3 class="fw-bolder me-auto text-muted">Settings</h3>
                    <p class="h6 fst-normal text-body-tertiary mb-2 webPageDesc">Change Password</p>
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
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <!-- Search -->
            <div class="input-group" style="max-width:400px;">
            <input type="text" id="searchBox" class="form-control" placeholder="Search for id, name product">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
            <!-- Controls: Filter, Export, New User -->
            <div class="d-flex align-items-center">
                <!-- Filter Button -->
                <button id="filterBtn" class="btn btn-outline-secondary me-2" data-bs-toggle="modal" data-bs-target="#filterModal">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>

                <!-- Export Dropdown -->
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fas fa-download me-1"></i> Export
                    </button>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" id="exportCsv"><i class="fas fa-file-csv me-1"></i> CSV</a></li>
                    <li><a class="dropdown-item" href="#" id="exportExcel"><i class="fas fa-file-excel me-1"></i> Excel</a></li>
                    <li><a class="dropdown-item" href="#" id="exportPrint"><i class="fas fa-print me-1"></i> Print</a></li>
                    </ul>
                </div>

                <!-- New User Button -->
                <button id="newUserBtn" class="btn btn-primary">
                    <i class="fas fa-user-plus me-1"></i> New User
                </button>
                </div>
        </div>

        <!-- DataTable -->
        <div class="table-responsive">
            <table id="accountTable" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Account Name</th>
                    <th>Username</th>
                    <th>Birth Date</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Role</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Reiji Kawashima</td>
                    <td>reijikawashima_01</td>
                    <td>March 21, 1995</td>
                    <td>Kanagawa, Japan</td>
                    <td>reijikawashima@test.com</td>
                    <td>09170000000</td>
                    <td>Admin</td>
                    <td>Active</td>
                    <td>Actions</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Saori Hayami</td>
                    <td>yumekosaori</td>
                    <td>May 21, 1992</td>
                    <td>Kagoshima, Japan</td>
                    <td>saorihayami@test.com</td>
                    <td>09170000023</td>
                    <td>User</td>
                    <td>Active</td>
                    <td>Actions</td>
                </tr>
            </tbody>
            </table>
        </div>
    </main>

    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <form id="filterForm">
            <div class="modal-header">
            <h5 class="modal-title" id="filterModalLabel">Advanced Filter</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="mb-3">
                <label for="filterRole" class="form-label">Role</label>
                <select id="filterRole" class="form-select">
                <option value="">All</option>
                <option value="Admin">Admin</option>
                <option value="User">User</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="filterActive" class="form-label">Status</label>
                <select id="filterActive" class="form-select">
                <option value="">All</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                </select>
            </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Apply Filter</button>
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
    
    <script>
        $(document).ready(function(){
            var table = $('#accountTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                { extend: 'csv',   className: 'd-none' },
                { extend: 'excel', className: 'd-none' },
                { extend: 'print', className: 'd-none' }
                ],
                pageLength: 10,
                responsive: true,
                lengthChange: false,
                autoWidth: false
            });

            // Export dropdown bindings
            $('#exportCsv').click(function(e){ e.preventDefault(); table.button(0).trigger(); });
            $('#exportExcel').click(function(e){ e.preventDefault(); table.button(1).trigger(); });
            $('#exportPrint').click(function(e){ e.preventDefault(); table.button(2).trigger(); });

            // Search input
            $('#searchBox').on('keyup', function(){ table.search(this.value).draw(); });

            // Filter form submission
            $('#filterForm').submit(function(e){
                e.preventDefault();
                table.column(7).search($('#filterRole').val())
                    .column(8).search($('#filterActive').val())
                    .draw();
                $('#filterModal').modal('hide');
            });

            // New User button
            $('#newUserBtn').click(function(){
                window.location.href = 'page_admin_account_new.php';
            });
        });
    </script>
    <?php include "../components/button_logout.php" ?>

</body>
</html>

