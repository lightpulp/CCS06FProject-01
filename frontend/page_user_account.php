<?php
include "../backend/phpscripts/session.php";
include "../backend/phpscripts/account.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Account</title>

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

        <h1>ACCOUNT</h1>
        <p><strong>User ID:</strong> <?php echo htmlspecialchars($user_data['user_id']); ?></p>
        <p><strong>User Name:</strong> <?php echo htmlspecialchars($user_data['user_name']); ?></p>
        <p><strong>User Password:</strong> <?php echo htmlspecialchars($user_data['user_pass']); ?></p>
        <p><strong>First Name:</strong> <?php echo htmlspecialchars($user_data['user_fname']); ?></p>
        <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user_data['user_lname']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user_data['user_email']); ?></p>
        <p><strong>Birthdate:</strong> <?php echo htmlspecialchars($user_data['birthdate']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($user_data['address']); ?></p>
        <p><strong>Number:</strong> <?php echo htmlspecialchars($user_data['number']); ?></p>
        <p><strong>Role:</strong> <?php echo htmlspecialchars($user_data['role']); ?></p>
        <p><strong>Created At:</strong> <?php echo htmlspecialchars($user_data['created_at']); ?></p>
        <button onclick="window.location.href='../backend/phpscripts/logout.php'">Logout</button>

    </main>

</body>
</html>

