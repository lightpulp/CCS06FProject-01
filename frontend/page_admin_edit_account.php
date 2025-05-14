<?php
include "../backend/phpscripts/session.php";
include "../backend/phpscripts/account.php";
include "../backend/phpscripts/config.php";

// Get user ID from URL and validate
$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch user details
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    header("Location: page_admin_account_management.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <title>Edit Account</title>
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
                    <h3 class="fw-bolder me-auto text-muted">Edit Account</h3>
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
            
            <!-- Edit Account Form -->
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8">
                        <form id="accountForm">
                            <input type="hidden" id="user_id" value="<?php echo $user['user_id']; ?>">
                            
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <!-- First Name -->
                                    <div class="form-group mb-3">
                                        <label for="user_fname" class="fw-semibold fs-7 mb-2 text-muted">First Name</label>
                                        <input type="text" name="user_fname" id="user_fname" class="form-control" 
                                               value="<?php echo htmlspecialchars($user['user_fname']); ?>">
                                    </div>
                                    
                                    <!-- Last Name -->
                                    <div class="form-group mb-3">
                                        <label for="user_lname" class="fw-semibold fs-7 mb-2 text-muted">Last Name</label>
                                        <input type="text" name="user_lname" id="user_lname" class="form-control" 
                                               value="<?php echo htmlspecialchars($user['user_lname']); ?>">
                                    </div>
                                    
                                    <!-- Username -->
                                    <div class="form-group mb-3">
                                        <label for="user_name" class="fw-semibold fs-7 mb-2 text-muted">Username</label>
                                        <input type="text" name="user_name" id="user_name" class="form-control" 
                                               value="<?php echo htmlspecialchars($user['user_name']); ?>">
                                    </div>
                                    
                                    <!-- Email -->
                                    <div class="form-group mb-3">
                                        <label for="user_email" class="fw-semibold fs-7 mb-2 text-muted ">Email</label>
                                        <input type="email" name="user_email" id="user_email" class="form-control" 
                                               value="<?php echo htmlspecialchars($user['user_email']); ?>" disabled>
                                    </div>
                                </div>
                                
                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <!-- Birthdate -->
                                    <div class="form-group mb-3">
                                        <label for="birthdate" class="fw-semibold fs-7 mb-2 text-muted">Birthdate</label>
                                        <input type="date" name="birthdate" id="birthdate" class="form-control" 
                                               value="<?php echo htmlspecialchars($user['birthdate']); ?>">
                                    </div>
                                    
                                    <!-- Phone Number -->
                                    <div class="form-group mb-3">
                                        <label for="number" class="fw-semibold fs-7 mb-2 text-muted">Phone Number</label>
                                        <input type="text" name="number" id="number" class="form-control" 
                                               value="<?php echo htmlspecialchars($user['number']); ?>">
                                    </div>
                                    
                                    <!-- Address -->
                                    <div class="form-group mb-3">
                                        <label for="address" class="fw-semibold fs-7 mb-2 text-muted">Address</label>
                                        <textarea name="address" id="address" class="form-control" 
                                                  style="min-height: 100px;"><?php echo htmlspecialchars($user['address']); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Role -->
                                    <div class="form-group mb-3">
                                        <label for="role" class="fw-semibold fs-7 mb-2 text-muted">Role</label>
                                        <select name="role" id="role" class="form-select" 
                                            <?php echo ($user['user_email'] === '1@1') ? 'disabled' : ''; ?>>
                                            <option value="0" <?php echo $user['role'] == 0 ? 'selected' : ''; ?>>User</option>
                                            <option value="1" <?php echo $user['role'] == 1 ? 'selected' : ''; ?>>Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Active Status -->
                                    <div class="form-group mb-3">
                                        <label for="active" class="fw-semibold fs-7 mb-2 text-muted">Status</label>
                                        <select name="active" id="active" class="form-select">
                                            <option value="1" <?php echo $user['active'] == 1 ? 'selected' : ''; ?>>Active</option>
                                            <option value="0" <?php echo $user['active'] == 0 ? 'selected' : ''; ?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="my-4">
                            <div class="d-flex justify-content-between">
                                <a href="page_admin_account_management.php" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary primaryBtnAnimate">Update Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/script/script.js"></script>
    
    <script src="../backend/javascript/admin_edit_account.js">

    </script>
    
    <?php include "../components/button_logout.php" ?>
</body>
</html>