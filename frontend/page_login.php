<!-- frontend/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>

    <link rel="stylesheet" href="../assets/styles/page_login.css">

</head>
<body>

<div class="login-box">
<h2>Login</h2>
    <form action="../backend/phpscripts/login.php" method="POST">
        <input type="text" name="username_or_email" placeholder="Username or Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
