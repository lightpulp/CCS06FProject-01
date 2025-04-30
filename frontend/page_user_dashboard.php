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
    <link rel="stylesheet" href="../assets/styles/style_one.css">
    <!-- end: CSS -->
    <title>User Dashboard</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap');
    /* start: Global */
    :root {
        --bs-brand-color: #650021;
        --bs-blue: #0d6efd;
        --bs-indigo: #6610f2;
        --bs-purple: #6f42c1;
        --bs-pink: #d63384;
        --bs-red: #dc3545;
        --bs-orange: #fd7e14;
        --bs-yellow: #ffc107;
        --bs-green: #198754;
        --bs-teal: #20c997;
        --bs-cyan: #0dcaf0;
        --bs-black: #000;
        --bs-white: #fff;
        --bs-gray: #6c757d;
        --bs-gray-dark: #343a40;
        --bs-gray-100: #f8f9fa;
        --bs-gray-200: #e9ecef;
        --bs-gray-300: #dee2e6;
        --bs-gray-400: #ced4da;
        --bs-gray-500: #adb5bd;
        --bs-gray-600: #6c757d;
        --bs-gray-700: #495057;
        --bs-gray-800: #343a40;
        --bs-gray-900: #212529;
        --bs-primary: #0d6efd;
        --bs-secondary: #6c757d;
        --bs-success: #198754;
        --bs-info: #0dcaf0;
        --bs-warning: #ffc107;
        --bs-danger: #dc3545;
        --bs-light: #f8f9fa;
        --bs-dark: #212529;
        --bs-primary-rgb: 13, 110, 253;
        --bs-secondary-rgb: 108, 117, 125;
        --bs-success-rgb: 25, 135, 84;
        --bs-info-rgb: 13, 202, 240;
        --bs-warning-rgb: 255, 193, 7;
        --bs-danger-rgb: 220, 53, 69;
        --bs-light-rgb: 248, 249, 250;
        --bs-dark-rgb: 33, 37, 41;
        --bs-white-rgb: 255, 255, 255;
        --bs-black-rgb: 0, 0, 0;
        --bs-body-color-rgb: 33, 37, 41;
        --bs-body-bg-rgb: 255, 255, 255;
        
        --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
        --bs-body-font-family: var(--bs-font-sans-serif);
        --bs-body-font-size: 1rem;
        --bs-body-font-weight: 400;
        --bs-body-line-height: 1.5;
        --bs-body-color: #212529;
        --bs-body-bg: #fff;
        --bs-border-width: 1px;
        --bs-border-style: solid;
        --bs-border-color: #dee2e6;
        --bs-border-color-translucent: rgba(0, 0, 0, 0.175);
        --bs-border-radius: 0.375rem;
        --bs-border-radius-sm: 0.25rem;
        --bs-border-radius-lg: 0.5rem;
        --bs-border-radius-xl: 1rem;
        --bs-border-radius-2xl: 2rem;
        --bs-border-radius-pill: 50rem;
        --bs-heading-color: ;
        --bs-link-color: #0d6efd;
        --bs-link-hover-color: #0a58ca;
        --bs-code-color: #d63384;
        --bs-highlight-bg: #fff3cd;
    }
    body {
        font-family: 'Open Sans', sans-serif;
    }


    .text-brand:hover,
    .text-brand {
        color: var(--bs-brand-color);
    }

    .bg-indigo {
        background-color: var(--bs-indigo);
    }
    .dropdown-toggle::after {
        display: none;
    }
    .cursor-pointer {
        cursor: pointer;
    }
    .fw-semibold {
        font-weight: 600;
    }
    .fs-7 {
        font-size: .875rem;
    }


    .fx-dropdown-menu {
        min-width: 16rem;
        padding: 0;
        overflow: hidden;
    }
    /* start: Global */



    /* start: Sidebar */
    .sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background-color: rgba(0, 0, 0, .5);
        z-index: 490;
        opacity: 1;
        visibility: visible;
        transition: opacity .2s;
    }
    .sidebar.collapsed ~ .sidebar-overlay {
        opacity: 0;
        visibility: hidden;
    }
    .sidebar.collapsed:hover,
    .sidebar {
        width: 16rem;
        overflow-y: auto;
        transition: width .2s, left .2s;
        left: 0;
        z-index: 500;
    }
    .sidebar.collapsed {
        left: -16rem;
    }
    .sidebar::-webkit-scrollbar {
        width: .25rem;
    }
    .sidebar::-webkit-scrollbar-track {
        background-color: var(--bs-gray-300);
    }
    .sidebar::-webkit-scrollbar-thumb {
        background-color: var(--bs-gray-500);
    }
    .sidebar::-webkit-scrollbar-thumb:hover {
        background-color: var(--bs-gray-600);
    }
    .sidebar-toggle {
        cursor: pointer;
        transition: .2s;
    }
    .sidebar-toggle:hover {
        color: var(--bs-brand-color);
    }
    .sidebar-menu {
        list-style-type: none;
    }
    .sidebar-menu-item {
        margin-bottom: .25rem;
    }
    .sidebar-menu-item a {
        font-weight: 500;
        text-decoration: none;
        display: flex;
        align-items: center;
        color: var(--bs-dark);
        padding: .375rem .75rem;
        border-radius: .375rem;
        font-size: .875rem;
        white-space: nowrap;
    }
    .sidebar-menu-item > a {
        overflow: hidden;
    }
    .sidebar-menu-item.focused > a,
    .sidebar-menu-item > a:hover {
        background-color: var(--bs-gray-200);
    }
    .sidebar-menu-item.active a {
        background-color: var(--bs-brand-color);
        color: var(--bs-light);
        box-shadow: 0 .25rem .25rem rgba(0, 0, 0, 0.175);
    }
    .sidebar-menu-item-icon {
        margin-right: .625rem;
        font-size: 1.25rem;
    }
    .sidebar-menu-item-accordion {
        transition: transform .2s;
    }
    .sidebar-dropdown-menu-item.focused > a .sidebar-menu-item-accordion,
    .sidebar-menu-item.focused > a .sidebar-menu-item-accordion {
        transform: rotateZ(180deg);
    }
    .sidebar.collapsed:hover .sidebar-menu-divider,
    .sidebar-menu-divider {
        font-size: .75rem;
        color: var(--bs-gray-600);
        transition: opacity .2s;
        opacity: 1;
        visibility: visible;
    }
    .sidebar-dropdown-menu-item a {
        padding: .375rem 0;
        padding-right: .75rem;
    }
    .sidebar-dropdown-menu-item.focused > a,
    .sidebar-dropdown-menu-item a:hover {
        color: var(--bs-brand-color);
    }
    .sidebar-dropdown-menu {
        padding-left: 2rem;
    }
    .sidebar-dropdown-menu .sidebar-dropdown-menu {
        padding-left: 1rem;
        list-style-type: circle;
    }
    /* end: Sidebar */



    /* start: Main */
    main {
        padding-left: 0;
        min-height: 100vh;
        font-family: 'Open Sans', sans-serif;
    }



    /* start: Navbar */
    nav {
        display: flex;
        align-items: center;
    }
    .navbar-profile-image {
        width: 2.5rem;
        height: 2.5rem;
        object-fit: cover;
        border-radius: 50%;
    }
    .navbar-link {
        width: 2.5rem;
        height: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: .25rem;
    }
    .navbar-link:hover {
        background-color: var(--bs-gray-200);
    }
    /* end: Navbar */



    /* start: Suummary */
    .summary-icon {
        width: 4rem;
        height: 4rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--bs-light);
        font-size: 1.5rem;
        border-radius: 50%;
    }
    .summary-primary,
    .summary-indigo,
    .summary-success,
    .summary-danger {
        transition: .2s;
    }
    .summary-primary:hover,
    .summary-indigo:hover,
    .summary-success:hover,
    .summary-danger:hover {
        color: var(--bs-light) !important;
    }
    .summary-primary:hover .summary-icon,
    .summary-indigo:hover .summary-icon,
    .summary-success:hover .summary-icon,
    .summary-danger:hover .summary-icon {
        background-color: var(--bs-light) !important;
    }
    .summary-primary:hover .summary-icon {
        color: var(--bs-primary) !important;
    }
    .summary-indigo:hover .summary-icon {
        color: var(--bs-indigo) !important;
    }
    .summary-success:hover .summary-icon {
        color: var(--bs-success) !important;
    }
    .summary-danger:hover .summary-icon {
        color: var(--bs-danger) !important;
    }
    .summary-primary:hover {
        background-color: var(--bs-primary) !important;
    }
    .summary-indigo:hover {
        background-color: var(--bs-indigo) !important;
    }
    .summary-success:hover {
        background-color: var(--bs-success) !important;
    }
    .summary-danger:hover {
        background-color: var(--bs-danger) !important;
    }
    /* end: Suummary */
    /* end: Main */



    /* start: Breakpoints */
    /* X-Small devices (portrait phones, less than 576px) */
    /* No media query for `xs` since this is the default in Bootstrap */

    /* Small devices (landscape phones, 576px and up) */
    @media (min-width: 576px) {
        
    }

    /* Medium devices (tablets, 768px and up) */
    @media (min-width: 768px) {
        /* start: Sidebar */
        .sidebar-overlay {
            opacity: 0;
            visibility: hidden;
        }
        .sidebar.collapsed {
            width: 4.75rem;
            left: 0;
        }
        .sidebar.collapsed .sidebar-logo {
            display: none;
        }
        .sidebar.collapsed:hover .sidebar-logo {
            display: block;
        }
        .sidebar.collapsed:hover .sidebar-toggle {
            margin-left: auto;
            margin-right: 0;
        }
        .sidebar.collapsed .sidebar-toggle {
            margin: 0 auto;
            transform: rotateZ(180deg);
        }
        .sidebar.collapsed:hover .sidebar-menu-divider {
            font-size: .75rem;
            color: var(--bs-gray-600);
            transition: opacity .2s;
            opacity: 1;
            visibility: visible;
        }
        .sidebar.collapsed .sidebar-menu-divider {
            opacity: 0;
            visibility: hidden;
        }
        /* end: Sidebar */



        /* start: Main */
        main {
            transition: padding-left .2s;
            padding-left: 16rem;
        }
        .sidebar.collapsed ~ main {
            padding-left: 4.75rem;
        }
        /* end: Main */
    }

    /* Large devices (desktops, 992px and up) */
    @media (min-width: 992px) {
        
    }

    /* X-Large devices (large desktops, 1200px and up) */
    @media (min-width: 1200px) {
        
    }

    /* XX-Large devices (larger desktops, 1400px and up) */
    @media (min-width: 1400px) {
        
    }
    /* end: Breakpoints */
</style>

<body>

    <!-- start: Sidebar -->
    <div class="sidebar position-fixed top-0 bottom-0 bg-white border-end">
        <div class="d-flex align-items-center p-3">
            <a href="#" class="sidebar-logo text-uppercase fw-bold text-decoration-none text-brand fs-3">TUTUBAN</a>
            <i class="sidebar-toggle ri-arrow-left-circle-line ms-auto fs-5 d-none d-md-block"></i>
        </div>

        <ul class="sidebar-menu p-3 m-0 mb-0">
            <!-- Dashboard Bar -->
            <li class="sidebar-menu-item active">
                <a href="#">
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
                    <i class="ri-history-line sidebar-menu-item-icon"></i>
                    Activity Logs
                </a>
            </li>

            <!-- Account Management Bar -->
            <li class="sidebar-menu-item">
                <a href="page_user_account.php">
                    <i class="ri-group-line sidebar-menu-item-icon"></i>
                    Account Management
                </a>
            </li>

            <!-- Settings Bar -->
            <li class="sidebar-menu-item has-dropdown">
                <a href="#">
                    <i class="ri-settings-2-line sidebar-menu-item-icon"></i>
                    Settings
                    <i class="ri-arrow-down-s-line sidebar-menu-item-accordion ms-auto"></i>
                </a>

                <!-- Dropdown Menu: Settings -->
                <ul class="sidebar-dropdown-menu">

                    <!-- Settings: Update Profile -->
                    <li class="sidebar-dropdown-menu-item">
                        <a href="#">
                            Update Profile
                        </a>
                    </li>

                    <!-- Settings: Category Setting -->
                    <li class="sidebar-dropdown-menu-item">
                        <a href="#">
                            Category Setting
                        </a>
                    </li>
                    <li class="sidebar-dropdown-menu-item has-dropdown">
                        <a href="#">
                            Blog
                            <i class="ri-arrow-down-s-line sidebar-menu-item-accordion ms-auto"></i>
                        </a>
                        <ul class="sidebar-dropdown-menu">
                            <li class="sidebar-dropdown-menu-item">
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li class="sidebar-dropdown-menu-item">
                                <a href="#">
                                    Post
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <!-- Account Management Bar -->
            <li class="sidebar-menu-item">
                <?php include '../components/button_logout.php'; ?>
            </li>
        </ul>
    </div>
    <div class="sidebar-overlay"></div>
    <!-- end: Sidebar -->

    <!-- start: Main -->
    <main class="bg-light">
        <div class="p-2">
            <!-- start: Navbar -->
            <nav class="px-3 py-2 bg-white rounded shadow-sm">
                <i class="ri-menu-line sidebar-toggle me-3 d-block d-md-none"></i>
                <h5 class="fw-bold mb-0 me-auto">Dashboard</h5>
                <div class="dropdown">
                    <div class="d-flex align-items-center cursor-pointer dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <span class="me-2 d-none d-sm-block">John Doe</span>
                        <img class="navbar-profile-image"
                            src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cGVyc29ufGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                            alt="Image">
                    </div>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </nav>
            <!-- end: Navbar -->

            <!-- start: Content -->
            <div class="py-4">
                <!-- start: Summary -->
                <div class="row g-3">
                    <div class="col-12 col-sm-6 col-lg-3">
                        <a href="#"
                            class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-between summary-primary">
                            <div>
                                <i class="ri-shopping-cart-2-line summary-icon bg-primary mb-2"></i>
                                <div>Sales</div>
                            </div>
                            <h4>$435</h4>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <a href="#"
                            class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-between summary-indigo">
                            <div>
                                <i class="ri-shopping-cart-2-line summary-icon bg-indigo mb-2"></i>
                                <div>Sales</div>
                            </div>
                            <h4>$435</h4>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <a href="#"
                            class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-between summary-success">
                            <div>
                                <i class="ri-shopping-cart-2-line summary-icon bg-success mb-2"></i>
                                <div>Sales</div>
                            </div>
                            <h4>$435</h4>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <a href="#"
                            class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-between summary-danger">
                            <div>
                                <i class="ri-shopping-cart-2-line summary-icon bg-danger mb-2"></i>
                                <div>Sales</div>
                            </div>
                            <h4>$435</h4>
                        </a>
                    </div>
                </div>
                <!-- end: Summary -->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assets/script/script.js"></script>
    <!-- end: JS -->

    <script>
      $(document).ready(function(){
          // start: Sidebar
          $('.sidebar-dropdown-menu').slideUp('fast')

          $('.sidebar-menu-item.has-dropdown > a, .sidebar-dropdown-menu-item.has-dropdown > a').click(function(e) {
              e.preventDefault()

              if(!($(this).parent().hasClass('focused'))) {
                  $(this).parent().parent().find('.sidebar-dropdown-menu').slideUp('fast')
                  $(this).parent().parent().find('.has-dropdown').removeClass('focused')
              }

              $(this).next().slideToggle('fast')
              $(this).parent().toggleClass('focused')
          })

          $('.sidebar-toggle').click(function () {
            $('.sidebar').toggleClass('collapsed');
          
            if ($(window).width() < 768) {
              $('.sidebar-overlay').toggleClass('d-none');
            }
          
            $('.sidebar-dropdown-menu').slideUp('fast');
            $('.sidebar-menu-item.has-dropdown, .sidebar-dropdown-menu-item.has-dropdown').removeClass('focused');
          });
          

          $('.sidebar-overlay').click(function() {
              $('.sidebar').addClass('collapsed')

              $('.sidebar-dropdown-menu').slideUp('fast')
              $('.sidebar-menu-item.has-dropdown, .sidebar-dropdown-menu-item.has-dropdown').removeClass('focused')
          })

          if(window.innerWidth < 768) {
              $('.sidebar').addClass('collapsed')
          }
          // end: Sidebar



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
          })
          // end: Charts
      });
    </script>
</body>

</html>