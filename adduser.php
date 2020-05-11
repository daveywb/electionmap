<?php
include('connect.php');

if(isset($_POST['name-input'])){

  $nameinput = $_POST['name-input'];

  $sql = "INSERT INTO users (username) VALUES ('$nameinput')";

  if ($conn->query($sql) === TRUE) {
      echo  $nameinput;
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();

}
?>
