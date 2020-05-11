<?php
$servername = "localhost";
$username = "davidbro_hatgame";
$password = "M4gp1es->fly;";

// Create connection
$conn = new mysqli($servername, $username, $password, $username);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_select_db($conn,'davidbro_hatgame');

?>
