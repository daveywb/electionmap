<?php
include('connect.php');

//this page just shows how many rows are in the users table

$query = $conn->query("SELECT * FROM `users`");

// Count number of rows
$row_count = $query->num_rows;

echo 'Users in users table:' . $row_count;

?>
