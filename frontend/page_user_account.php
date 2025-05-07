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
    <title>Account Profile Setting</title>
</head>

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
                    <p class="h6 fst-normal text-body-tertiary mb-2 webPageDesc">Profile Setting</p>
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
                                    <a class="nav-link fs-7 active" id="home-tab" data-toggle="tab" href="page_user_account.php" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fs-7" id="profile-tab" data-toggle="tab" href="page_change_password_account.php" role="tab" aria-controls="profile" aria-selected="false">Change Password</a>
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
                            <form id="saveAccForm" method="POST">
                                <div class="row">
                                    <!-- First Name -->
                                    <div class="form-group col-md-6">
                                        <label for="user_fname" class="fw-semibold fs-7 mb-2 text-muted">First Name</label>
                                        <input type="text" name="user_fname" id="user_fname" class="form-control" placeholder="Enter your First Name" value="<?php echo isset($user_data['user_fname']) ? htmlspecialchars($user_data['user_fname']) : ''; ?>">
                                    </div>
                                    
                                    <!-- Last Name -->
                                    <div class="form-group col-md-6">
                                        <label for="user_lname" class="fw-semibold fs-7 mb-2 text-muted">Last Name</label>
                                        <input type="text" name="user_lname" id="user_lname" class="form-control" placeholder="Enter your Last Name" value="<?php echo isset($user_data['user_lname']) ? htmlspecialchars($user_data['user_lname']) : ''; ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- User Name -->
                                    <div class="form-group col-md-6">
                                        <label for="user_name" class="fw-semibold fs-7 mb-2 text-muted">Username</label>
                                        <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter your User Name" value="<?php echo isset($user_data['user_name']) ? htmlspecialchars($user_data['user_name']) : ''; ?>">
                                    </div>
                                    
                                    <!-- Email -->
                                    <div class="form-group col-md-6">
                                        <label class="fw-semibold fs-7 mb-2 text-muted">Email</label>
                                        <input type="text" name="user_lname" id="user_lname" class="form-control" value="<?php echo isset($user_data['user_email']) ? htmlspecialchars($user_data['user_email']) : ''; ?>" disabled>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- DOB -->
                                    <div class="form-group col-md-2">
                                        <label for="birthdate" class="fw-semibold fs-7 mb-2 text-muted">Birth Date</label>
                                        <input type="date" name="birthdate" id="birthdate" class="form-control" value="<?php echo isset($user_data['birthdate']) ? htmlspecialchars($user_data['birthdate']) : ''; ?>">
                                    </div>
                                    
                                    <!-- Address -->
                                    <div class="form-group col-md-6">
                                        <label for="address" class="fw-semibold fs-7 mb-2 text-muted">Address</label>
                                        <input type="text" name="address" id="address" class="form-control" value="<?php echo isset($user_data['address']) ? htmlspecialchars($user_data['address']) : ''; ?>">
                                    </div>

                                    <!-- Contact Number -->
                                    <div class="form-group col-md-4">
                                        <label for="number" class="fw-semibold fs-7 mb-2 text-muted">Contact Number</label>
                                        <input type="text" name="number" id="number" class="form-control" maxlength="11" value="<?php echo isset($user_data['number']) ? htmlspecialchars($user_data['number']) : ''; ?>">
                                    </div>
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
    <script src="../backend/javascript/save_account.js"></script>
    <!-- end: JS -->

    <script>
      
    </script>
    <?php include "../components/button_logout.php" ?>

</body>
</html>

