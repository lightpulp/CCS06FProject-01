<?php
include "config.php";

$query = "SELECT l.*, u.user_name, u.user_fname, u.user_lname 
          FROM activity_logs l
          LEFT JOIN users u ON l.user_id = u.user_id
          ORDER BY l.created_at DESC
          LIMIT 200";

$result = $conn->query($query);

$data = [];

while ($row = $result->fetch_assoc()) {


    $data[] = [
        $row['log_id'],
        $row['created_at'],
        $row['user_name'],
        $row['action'],
        $row['details'],
        $row['page_url'],
    ];
}

echo json_encode(["data" => $data]);

    /*


        //Determine active status
        $activeClass = $row['active'] == 1 ? 'status-active' : 'status-inactive';
        $activeText = $row['active'] == 1 ? 'Active' : 'Inactive';



    */

?>


