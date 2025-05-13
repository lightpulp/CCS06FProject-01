<!-- frontend/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link rel="stylesheet" href="../assets/styles/style.css">
</head>
<body>
    <div class="container-fluid min-vh-100 d-flex p-0">
        <!-- Left: Form Section -->
        <div class="form-section flex-grow-1 p-5 overflow-auto">
            <div class="form-wrapper mx-auto animate__animated animate__fadeInLeft" style="max-width: 600px;">
                <h5 class="text-brand-500 fw-bold">TUTUBAN</h5>
                <h2 class="mt-4 fw-bold">Register with Tutuban</h2>
                <p class="text-muted opacity-50">Naiimagine mo sa sarili mo na sakses ka eh. Bigla kang sumakses eh.</p>
                <form id="registerForm" method="POST" autocomplete="off">
                    
                    <!-- First Name -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">First Name</label>
                        <input type="text" class="form-control py-2" placeholder="Enter your first name here" name="user_fname" id="user_fname">
                    </div>

                    <!-- Last Name -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Last Name</label>
                        <input type="text" class="form-control py-2" placeholder="Enter your last name here" name="user_lname" id="user_lname">
                    </div>

                    <!-- UserName -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Username</label>
                        <input type="text" class="form-control py-2" placeholder="Enter your username here" name="user_name" id="user_name">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control py-2" placeholder="eg: john@email.com" name="user_email" id="user_email">
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="regPassword" class="form-label fw-bold">Password</label>
                        <div class="input-group">
                        <input type="password" class="form-control py-2" name="password" id="regPassword" placeholder="Type your password here" required name="user_pass" id="user_pass">

                        <!-- Password Visibility -->
                        <span class="input-group-text toggle-password"><i class="fa-solid fa-eye"></i></span>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label fw-bold">Confirm Password</label>
                        <div class="input-group">
                        <input type="password" class="form-control py-2" name="confirmPassword" id="regConfirmPassword" placeholder="Confirm Password" required name="user_passCheck" id="user_passCheck">
                        
                        <!-- Password Visibility -->
                        <span class="input-group-text toggle-password"><i class="fa-solid fa-eye"></i></span>
                        </div>
                    </div>

                    <!-- Date of Birth -->
                    <div class="mb-4">
                    <label class="form-label fw-bold">Date of Birth</label>
                    <input type="date" class="form-control py-2" name="birthdate" id="birthdate">
                    </div>

                    <!-- Address -->
                    <div class="mb-3">
                    <label class="form-label fw-bold">Address</label>
                    <input type="text" class="form-control py-2" placeholder="Enter your Address Here" name="address" id="address">
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-3">
                    <label class="form-label fw-bold">Phone Number</label>
                    <div class="input-group">
                        <input type="text" class="form-control py-2" placeholder="Enter your Address Here" name="number" id="number" maxlength="11">
                    </div>
                    </div>

                    <div class="mb-3">
                    <p>Have an account? <a href="page_login.php" class="sessionsLink fw-bold">Sign In.</a></p>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3 primaryBtnAnimate">Register Now</button>
                </form>
            </div>
        </div>
        <!-- Red Background Panel -->
        <div class="red-background-section d-none d-md-block animate__animated animate__fadeInRight">
            <div class="circle-1"></div>
            <div class="circle-2"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../backend/javascript/register.js">
        
</script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/script/script.js"></script>
</body>
</html>