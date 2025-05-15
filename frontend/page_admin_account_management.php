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
    <title>Accounts Management</title>
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
                    <h3 class="fw-bolder me-auto text-muted">Account Management</h3>
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
            <!-- Controls: responsive row -->
            <div class="row align-items-center gy-2 mb-4">
            <!-- Search box -->
            <div class="col-12 col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control table-search" data-table="#accountTable" placeholder="Search for id, account name, username etc.">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
            </div>

            <!-- Button group: Filter, Export, New Account -->
            <div class="col-12 col-md-6">
                <div class="d-flex flex-wrap justify-content-md-end gap-2">
                    <!-- Filter Button -->
                    <button id="filterAccountBtn" class="btn btn-outline-secondary px-4 py-2 fw-semibold" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>

                    <!-- Export Dropdown -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle px-4 py-2 fw-semibold" data-bs-toggle="dropdown">
                            <i class="fas fa-download me-1"></i> Export
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item export-btn" href="#" data-type="csv" data-table="#accountTable"><i class="fas fa-file-csv me-1"></i> CSV</a></li>
                            <li><a class="dropdown-item export-btn" href="#" data-type="excel" data-table="#accountTable"><i class="fas fa-file-excel me-1"></i> Excel</a></li>
                            <li><a class="dropdown-item export-btn" href="#" data-type="print" data-table="#accountTable"><i class="fas fa-print me-1"></i> Print</a></li>
                        </ul>
                    </div>

                    <!-- New Account Button -->
                    <button id="newAccountBtn" class="btn btn-primary px-3 py-2 rounded fw-semibold">
                        <i class="fas fa-user-plus me-1"></i> New Account
                    </button>
                </div>
            </div>
        </div>

        <!-- DataTable -->
        <div class="table-responsive">
        <table id="accountTable" class="table table-hover nowrap" style="width:100%">
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
                <button type="submit" class="btn btn-primary py-2 rounded">Apply Filter</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Create User Modal -->
    <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <form id="createUserForm" autocomplete="off">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserLabel">Create New User</h5>
                    <button type="button" class="btn-close" id="createUserFormClose" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- First Name -->
                    <div class="form-group col-md-12">
                        <label for="user_fname" class="fw-semibold fs-7 mb-2 text-muted">First Name</label>
                        <input type="text" name="user_fname" id="userFname" class="form-control" placeholder="Enter your First Name">
                    </div>

                    <!-- Last Name -->
                    <div class="form-group col-md-12">
                        <label for="user_lname" class="fw-semibold fs-7 mb-2 text-muted">Last Name</label>
                        <input type="text" name="user_lname" id="userLname" class="form-control" placeholder="Enter your Last Name">
                    </div>

                    <!-- User Name -->
                    <div class="form-group col-md-12">
                        <label for="userUsername" class="fw-semibold fs-7 mb-2 text-muted">User Name</label>
                        <input type="text" name="user_name" id="userUsername" class="form-control" placeholder="Enter your username">
                    </div>

                    <!-- Password -->
                    <div class="form-group col-md-12">
                        <label for="userPassword" class="fw-semibold fs-7 mb-2 text-muted">Password</label>
                        <div class="input-group">
                        <input type="password" class="form-control py-2" name="user_pass" id="userPassword" placeholder="Enter your password here">

                        <!-- Password Visibility -->
                        <span class="input-group-text toggle-password"><i class="fa-solid fa-eye"></i></span>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group col-md-12">
                        <label for="userConfirmPassword" class="fw-semibold fs-7 mb-2 text-muted">Confirm Password</label>
                        <div class="input-group">
                        <input type="password" class="form-control py-2" name="confirm_password" id="userConfirmPassword" placeholder="Confirm password">

                        <!-- Password Visibility -->
                        <span class="input-group-text toggle-password"><i class="fa-solid fa-eye"></i></span>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group col-md-12">
                        <label for="userEmail" class="fw-semibold fs-7 mb-2 text-muted">Email</label>
                        <input type="email" name="user_email" id="userEmail" class="form-control" placeholder="example@gmail.com">
                    </div>

                    <!-- Birthdate -->
                    <div class="form-group col-md-12">
                        <label for="userBirthdate" class="fw-semibold fs-7 mb-2 text-muted">Birthdate</label>
                        <input type="date" class="form-control" id="userBirthdate" name="birthdate">
                    </div>

                    <!-- Address -->
                    <div class="form-group col-md-12">
                        <label for="userAddress" class="fw-semibold fs-7 mb-2 text-muted">Address</label>
                        <input type="text" name="address" id="userAddress" class="form-control" placeholder="Enter your Address.">
                    </div>

                    <!-- Address -->
                    <div class="form-group col-md-12">
                        <label for="userAddress" class="fw-semibold fs-7 mb-2 text-muted">Address</label>
                        <input type="text" name="address" id="userAddress" class="form-control" placeholder="Enter your Address.">
                    </div>

                    <!-- Address -->
                    <div class="form-group col-md-12">
                        <label for="userNumber" class="fw-semibold fs-7 mb-2 text-muted">Phone Number</label>
                        <input type="text" name="number" id="userNumber" class="form-control" placeholder="09xxxxxxxxx">
                    </div>

                    <!-- Role -->
                    <div class="form-group col-md-12">
                        <label for="userRole" class="fw-semibold fs-7 mb-2 text-muted">Role</label>
                        <select class="form-select" id="userRole" name="role">
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>

                     <!-- Active -->
                    <div class="form-group col-md-12">
                        <label for="userActive" class="fw-semibold fs-7 mb-2 text-muted">Role</label>
                        <select class="form-select" id="userActive" name="active">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                <button type="submit" class="btn btn-primary py-2 rounded">Create User</button>
                </div>
            </form>
            </div>
        </div>
    </div>


    <!-- start: JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
        $(document).ready(function () {
            $('#newAccountBtn').on('click', function () {
                $('#createUserModal').modal('show');
            });

              // initialize validation
            $('#createUserForm').validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                highlight(el) {
                    $(el).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight(el) {
                    $(el).addClass('is-valid').removeClass('is-invalid');
                },
                // << add this block >>
                errorPlacement(error, element) {
                    // if the element is wrapped by .input-group, insert after the group
                    if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                    } else {
                    error.insertAfter(element);
                    }
                },
                // validation rules
                rules: {
                    user_fname: { required: true },
                    user_lname: { required: true },
                    user_name:  { required: true },
                    user_pass:  { required: true },
                    confirm_password: { required: true, equalTo: '#userPassword' },
                    user_email: { required: true, email: true },
                    birthdate:  { date: true },
                    address:    { required: true },
                    number: { 
                        required: true, 
                        digits: true, 
                        minlength: 11, 
                        maxlength: 11 
                        },
                    role:       { required: true },
                    active:     { required: true }
                },

                // optional custom messages
                messages: {
                    confirm_password: {
                        equalTo: 'Passwords must match.'
                    },
                    number: {
                        minlength: 'Enter an 11-digit phone number, e.g. 09171234567',
                        maxlength: 'Enter an 11-digit phone number, e.g. 09171234567'
                    }
                },
                submitHandler: function (form, e) {
                    e.preventDefault();
                    $.ajax({
                        url: '../backend/phpscripts/admin_create_user.php',
                        type: 'POST',
                        data: $(form).serialize(),
                        dataType: 'json',
                        success: function(response) {
                        if (response.success) {
                            $('#createUserModal').modal('hide');
                            $('#createUserForm')[0].reset();
                            if (typeof loadUsers === 'function') loadUsers();
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                        },
                        error: function(xhr, status, error) {
                        console.error(error);
                        alert('An unexpected error occurred.');
                        }
                    });
                }
            });

            // 2) reset on close
            $('#createUserModal').on('hidden.bs.modal', function(){
                $('#createUserForm')[0].reset();
                validator.resetForm();
                $('#createUserForm').find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
            });

            $('#createUserModal').on('shown.bs.modal', function () {
                $('#userFname').trigger('focus');
            });
        });
    </script>
    <?php include "../components/button_logout.php" ?>

</body>
</html>