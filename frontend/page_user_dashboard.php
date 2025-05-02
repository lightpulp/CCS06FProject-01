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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <!-- start: Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- start: CSS -->
    <link rel="stylesheet" href="../assets/styles/style.css">
    <!-- end: CSS -->
    <title>User Dashboard</title>
</head>
<body>

    <!-- start: Sidebar -->
    <div class="sidebar position-fixed top-0 bottom-0 bg-white border-end">
        <div class="d-flex align-items-center p-3">
            <a href="#" class="sidebar-logo text-uppercase fw-bold text-decoration-none text-brand fs-4">TUTUBAN</a>
            <i class="sidebar-toggle ri-arrow-left-circle-line ms-auto fs-5 d-none d-md-block"></i>
        </div>

        <ul class="sidebar-menu p-3 m-0 mb-0">
            <!-- User Overview Bar -->
            <li class="sidebar-menu-item active">
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
                    <h3 class="fw-bolder me-auto text-muted">Dashboard</h3>
                    <p class="h6 fst-normal text-body-tertiary mb-2 webPageDesc">Lorem Ipsum</p>
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

            <!-- start: Article Overview Cards -->

            <!-- Card: My Submissions -->
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-3 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <p class="h6 fw-bold text-body-tertiary mb-2">My Submissions</p>
                                    <span class="h2 fw-semibold text-muted mb-0">186</span>
                                </div>
                                <div class="col-auto">
                                    <i class="ri-folder-add-line summary-icon bg-primary mb-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card: Pending Articles -->
                <div class="col-12 col-sm-6 col-lg-3 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <p class="h6 fw-bold text-body-tertiary mb-2">Pending Articles</p>
                                    <span class="h2 fw-semibold text-muted mb-0">186</span>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-regular fa-newspaper summary-icon bg-warning mb-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Card: Approved Articles -->
                <div class="col-12 col-sm-6 col-lg-3 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <p class="h6 fw-bold text-body-tertiary mb-2">Approved Articles</p>
                                    <span class="h2 fw-semibold text-muted mb-0">186</span>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-check-double summary-icon bg-success mb-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card: Fake Articles -->
                <div class="col-12 col-sm-6 col-lg-3 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <p class="h6 fw-bold text-body-tertiary mb-2">Fake Articles</p>
                                    <span class="h2 fw-semibold text-muted mb-0">186</span>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-xmark summary-icon bg-danger mb-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end: Article Overview Cards -->

                <!-- start: Graph -->
                <div class="row g-3 mt-2">
                    <div class="col-12 col-md-7 col-xl-8">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white">
                                Sales
                            </div>
                            <div class="card-body">
                                <canvas id="sales-chart"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <!--
                    <div class="col-12 col-md-5 col-xl-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white">
                                Visitors
                            </div>
                            <div class="card-body">
                                <canvas id="visitors-chart"></canvas>
                            </div>
                        </div>
                    </div>
                    -->
                </div>
                <!-- end: Graph -->
            </div>
            <!-- end: Content -->
        </div>
    </main>
    <!-- end: Main -->

    <!-- start: JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/script/script.js"></script>
    <!-- end: JS -->

    <script>
          // start: Charts
          const labels = [
              'January',
              'February',
              'March',
              'April',
              'May',
              'June',
          ];

          const salesChart = new Chart($('#sales-chart'), {
              type: 'bar',
              data: {
                  labels: labels,
                  datasets: [{
                      backgroundColor: '#6610f2',
                      data: [5, 10, 5, 2, 20, 30, 45],
                  }]
              },
              options: {
                  plugins: {
                      legend: {
                          display: false
                      }
                  }
              }
          })

          const visitorsChart = new Chart($('#visitors-chart'), {
              type: 'doughnut',
              data: {
                  labels: ['Children', 'Teenager', 'Parent'],
                  datasets: [{
                      backgroundColor: ['#6610f2', '#198754', '#ffc107'],
                      data: [40, 60, 80],
                  }]
              }
          });
          // end: Charts
    </script>
    <?php include "../components/button_logout.php" ?>
</body>

</html>