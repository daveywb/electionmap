<?php
include('connect.php');

$query = $conn->query("SELECT * FROM `words_shuffled` LIMIT 1");

  while($row = mysqli_fetch_assoc($query)){
      $wordsarray[] = $row['word'];
  }

  $sql = "DELETE FROM words_shuffled LIMIT 1;";


  if (mysqli_query($conn, $sql)) {
   //echo "Record deleted successfully";
   echo($wordsarray[0]);

  } else {
   //echo "Error deleting record: " . mysqli_error($conn);
  }

//  echo($wordsarray[0]);

?>
