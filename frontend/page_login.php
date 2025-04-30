<!-- frontend/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link rel="stylesheet" href="../assets/styles/style.css">
</head>
<body>

<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center py-5">
    <div class="row w-100 mx-auto shadow-lg rounded overflow-hidden" style="max-width: 1200px;">
    <div class="col-md-6 p-5 d-flex flex-column justify-content-center form-side animate__animated animate__fadeInLeft bg-white">  
        <h5 class="text-brand-500 fw-bold">TUTUBAN</h5>
        <h2 class="mt-4 fw-bold">Login with Tutuban</h2>
        <p class="text-muted opacity-50">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        
        <form action="../backend/phpscripts/login.php" method="POST">
          
            <div class="mb-3">
                <label for="username" class="form-label fw-bold">Email</label>
                <input type="text" class="form-control py-2" name="user_email" id="user_email" placeholder="Enter your Email Address" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label fw-bold">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control py-2" name="user_pass" id="user_pass" placeholder="Type your password here" required>
                    
                    <span class="input-group-text toggle-password"><i class="fa-solid fa-eye"></i></span>
                </div>
            </div>
        
            <p class="small">Don't have an account? <a href="page_register.php" class="sessionsLink fw-bold">Register Now.</a></p>
            <button type="submit" class="btn btn-primary w-100 mt-3 primaryBtnAnimate">Log In</button>
        </form>
    
    </div>
  
      <!-- Image panel -->
      <div class="col-md-6 p-0 image-side animate__animated animate__fadeInRight">
        <img src="https://images.unsplash.com/photo-1598708962278-fe9a8b79ff96" alt="News" class="img-fluid w-100 h-100 object-fit-cover">
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../assets/script/script.js"></script>

</body>
</html>