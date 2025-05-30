<?php
include "config.php";

$query = "SELECT * FROM users ORDER BY user_id DESC";
$result = $conn->query($query);

$data = [];

while ($row = $result->fetch_assoc()) {
    $fullName = $row['user_fname'] . ' ' . $row['user_lname'];
    $roleClass = $row['role'] == 1 ? 'status-admin' : 'status-user';
    $roleText = $row['role'] == 1 ? 'Admin' : 'User';

    //Determine active status
    $activeClass = $row['active'] == 1 ? 'status-active' : 'status-inactive';
    $activeText = $row['active'] == 1 ? 'Active' : 'Inactive';


    $data[] = [
        $row['user_id'],
        $fullName,
        $row['user_name'],
        $row['birthdate'],
        $row['address'],
        $row['user_email'],
        $row['number'],
        "<div class='rounded p-1 {$roleClass} text-center' style='max-width: 80px;'>{$roleText}</div>",

        "<div class='rounded p-1 {$activeClass} text-center' style='max-width: 80px;'>{$activeText}</div>",
        
        "<a href='page_admin_edit_account.php?id=$row[user_id]' class='link-warning'><i class='fa-solid fa-pen-to-square fs-5 mx-1'></i></a>"
    ];
}

echo json_encode(["data" => $data]);
?>


