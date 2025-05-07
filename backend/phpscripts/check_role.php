<?php
if ($user_data['role'] == 1){
} else if ($user_data['role'] == 0) {
    echo '<script>alert("You are not an Admin!");</script>';
    header("Location: ../frontend/page_user_dashboard.php");
    exit();
}
?>
