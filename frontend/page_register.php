<!-- frontend/page_register.php -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register</title>

    <link rel="stylesheet" href="../assets/styles/page_register.css">

</head>
<body>

<div class="register-box">
    <h2>Create Account</h2>
    
    
    <form action="../backend/phpscripts/register.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>

</div>

</body>
</html>
