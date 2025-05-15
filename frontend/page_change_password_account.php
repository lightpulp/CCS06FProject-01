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
    <title>Change Password</title>
</head>
<style>
    #savePassForm label.error {
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

            <!-- start: Content -->
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10 col-xl-8">
                        <div class="my-4">
                            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link fs-7" id="home-tab" data-toggle="tab" href="page_user_account.php" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fs-7 active" id="profile-tab" data-toggle="tab" href="page_change_password_account.php" role="tab" aria-controls="profile" aria-selected="false">Change Password</a>
                                </li>
                            </ul>
                            
                                <div class="row mt-5 align-items-center">
                                    <!-- Avatar Image -->
                                    <div class="col-md-4 text-center mb-5">
                                        <div class="avatar avatar-xl">
                                            <img src="https://static.vecteezy.com/system/resources/previews/009/292/244/non_2x/default-avatar-icon-of-social-media-user-vector.jpg" alt="..." class="avatar-img rounded-circle">
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <!-- Malaking Name -->
                                        <div class="row align-items-center">
                                            <div class="col-md-5">
                                                <h4 class="mb-1 fw-semibold"><?php echo isset($user_data['user_fname']) ? htmlspecialchars($user_data['user_lname']) : ''; ?>, 
                                                <?php echo isset($user_data['user_fname']) ? htmlspecialchars($user_data['user_fname']) : ''; ?></h4>
                                            </div>
                                        </div>

                                        <!-- Copypasta -->
                                        <div class="row">
                                            <div class="col-md-7">
                                                <p class="text-muted fs-7"> Makikita mo 🧐👀👁️👁️👍sa imagine 🤯😱🤔💭 mo sakses📈🪜🍾🙏🥇💯🏆🏅 ka eh💐🥳 , bigla😱😲kang sumakses eh🤑. peru step🪜🦵 by the step🦶pala bago ka sumakses👌🥳💐❤️‍🔥, peru☝️ yong ☝️na imagine 🫨🤔🧐mo biglang kang sumakses🥂📈📈 </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                            <form id="savePassForm" method="POST">
                                <!-- Old Password -->
                                <div class="form-group col-md-12">
                                    <label for="user_pass" class="fw-semibold fs-7 mb-2 text-muted">Old Password</label>
                                    <input type="password" class="form-control py-2" placeholder="Enter your old password here" name="user_pass" id="user_pass">
                                </div>
                                
                                <!-- New Password -->
                                <div class="form-group col-md-12">
                                    <label for="new_pass" class="fw-semibold fs-7 mb-2 text-muted">New Password</label>
                                    <input type="password" class="form-control py-2" placeholder="Enter your new password here" name="new_pass" id="new_pass">
                                </div>

                                <!-- Confirm New Password -->
                                <div class="form-group col-md-12">
                                    <label for="new_passCheck" class="fw-semibold fs-7 mb-2 text-muted">Confirm New Password</label>
                                    <input type="password" class="form-control py-2" placeholder="Confirm your new password here" name="new_passCheck" id="new_passCheck">
                                </div>

                                <hr class="my-4">
                                <button type="submit" class="btn btn-primary w-100 mt-3 primaryBtnAnimate">Save Changes</button>
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
    <script src="../backend/javascript/save_password.js"></script>
    <!-- end: JS -->

    <script>
      
    </script>
    <?php include "../components/button_logout.php" ?>

</body>
</html>

