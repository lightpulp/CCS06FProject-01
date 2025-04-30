<?php


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../assets/styles/page_user_dashboard.css" rel="stylesheet"/>
</head>
    
<body>
    <div class="bg-light border-end" style="width: 250px;">
        <div class="p-3 text-center fs-5 fw-bold border-bottom">Dashboard</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="page_user_dashboard.php"></> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"></i> Manage Articles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"></i> Reports</a>
            </li>   
            <li class="nav-item">
                <a class="nav-link" href="page_user_account.php"></i> Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"></i> Export Data</a>
            </li>
        </ul>
    </div>

    <main class="flex-grow-1 p-3 overflow-auto">
        
    <h1>DASHBOARD</h1>
        <?php include '../components/button_logout.php'; ?>
    </main>

</body>
</html>

