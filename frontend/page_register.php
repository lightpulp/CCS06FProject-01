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
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="email" name="user_email" placeholder="Email" required><br><br>
        <input type="password" name="user_pass" placeholder="Password" required><br><br>
    
        <label>
            <input type="checkbox" name="role" value="1"> Admin
        </label><br><br>
    
    <button type="submit" name="submit">Create User</button>
</form>

</div>

</body>
</html>
