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
        
        <form id="saveAccForm"method="POST">

            <div class="mb-3">
                <label class="form-label fw-bold">First Name</label>
                <input type="text" class="form-control py-2" placeholder="Enter your first name here" name="user_fname" id="user_fname" value="<?php echo isset($user_data['user_fname']) ? htmlspecialchars($user_data['user_fname']) : ''; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Last Name</label>
                <input type="text" class="form-control py-2" placeholder="Enter your last name here" name="user_lname" id="user_lname" value="<?php echo isset($user_data['user_lname']) ? htmlspecialchars($user_data['user_lname']) : ''; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Username</label>
                <input type="text" class="form-control py-2" placeholder="Enter your username here" name="user_name" id="user_name" value="<?php echo isset($user_data['user_name']) ? htmlspecialchars($user_data['user_name']) : ''; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input class="form-control" type="text" value="<?php echo isset($user_data['user_email']) ? htmlspecialchars($user_data['user_email']) : ''; ?>" disabled>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Date of Birth</label>
                <input type="date" class="form-control py-2" name="birthdate" id="birthdate" value="<?php echo isset($user_data['birthdate']) ? htmlspecialchars($user_data['birthdate']) : ''; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Address</label>
                <input type="text" class="form-control py-2" placeholder="Enter your Address Here" name="address" id="address" value="<?php echo isset($user_data['address']) ? htmlspecialchars($user_data['address']) : ''; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Phone Number</label>
                <div class="input-group">
                    <input type="text" class="form-control py-2" placeholder="Enter your Address Here" name="number" id="number" maxlength="11" value="<?php echo isset($user_data['number']) ? htmlspecialchars($user_data['number']) : ''; ?>">
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3 primaryBtnAnimate">Save Account</button>
        </form>



        <form id="savePassForm" method="POST">
            <div class="mb-3">
                <label class="form-label fw-bold">Old Password</label>
                <input type="password" class="form-control py-2" placeholder="Enter your old password here" name="user_pass" id="user_pass">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">New Password</label>
                <input type="password" class="form-control py-2" placeholder="Enter your new password here" name="new_pass" id="new_pass">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Confirm New Password</label>
                <input type="password" class="form-control py-2" placeholder="Confirm your new password here" name="new_passCheck" id="new_passCheck">
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3 primaryBtnAnimate">Save</button>
        </form>

    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../backend/javascript/save_account.js"></script>
    <script src="../backend/javascript/save_password.js"></script>
</body>
</html>

