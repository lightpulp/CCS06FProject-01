<?php
include "config.php";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_pass = $_POST['user_pass'];
    $role = isset($_POST['role']) ? 1 : 0; 

    $sql = "INSERT INTO users (username, user_email, user_pass, role) 
            VALUES ('$username', '$user_email', '$user_pass', $role)";
    
    if (mysqli_query($conn, $sql)) {


        echo "User created successfully!";
    } else {



        echo "Error: " . mysqli_error($conn);
    }
}

?>
