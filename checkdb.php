<?php
include('connect.php');

$query = $conn->query("SELECT * FROM `users`");

// Count number of rows
$row_count = $query->num_rows;

echo $row_count;

?>
