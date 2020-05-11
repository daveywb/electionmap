<?php
include('connect.php');

// Not using this file now dont think

$result = [];
$query = $conn->query("SELECT * FROM `words`");
while($row = mysqli_fetch_assoc($query)){
    $result[] = $row['id_add_user']);
}

echo implode(", ", $result);
