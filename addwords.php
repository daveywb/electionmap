<?php
include('connect.php');

if(isset($_POST['wordinput'])){


  $wordsinput = $_POST['wordinput'];

   $sql = "INSERT INTO `words` (`word`) VALUES ('$wordsinput[0]');";


  if ($conn->query($sql) === TRUE) {
  } else {
     echo "Error: " . $sql . "<br>" . $conn->error;
   }

   $sql = "INSERT INTO `words` (`word`) VALUES ('$wordsinput[1]');";
   if ($conn->query($sql) === TRUE) {
   } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
   $sql = "INSERT INTO `words` (`word`) VALUES ('$wordsinput[2]');";
   if ($conn->query($sql) === TRUE) {
   } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
   $sql = "INSERT INTO `words` (`word`) VALUES ('$wordsinput[3]');";
   if ($conn->query($sql) === TRUE) {
   } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
   $sql = "INSERT INTO `words` (`word`) VALUES ('$wordsinput[4]')";
   if ($conn->query($sql) === TRUE) {
   } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }


    // Every time some words are added we have to see if all the words are added
    $result = [];
    $query = $conn->query("SELECT * FROM `words`");

    // Count number of rows
    $row_count = $query ->num_rows;

    //This number is sent back so we know if we can start
    echo $row_count;

    // but also we need to shuffle the cards if we get to 25!

    // So make an array of the IDs of the words

    /*
    if($row_count >= 25){
      //start Game

      $result = [];
      $query = $conn->query("SELECT * FROM `words`");
      while($row = mysqli_fetch_assoc($query)){
          $result[] = $row['id']);
      }

      //echo implode(", ", $result);

    }*/


}

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


$query = $conn->query("SELECT * FROM `words`");

// Count number of rows
$row_count = $query->num_rows;
echo $row_count;

$query = $conn->query("SELECT game_value FROM `general` WHERE game_key = 'players'");
// Count number of rows
$numberplayers = $query;


if($row_count >= (5 * $numberplayers)){
              //start Game

            // Make php array of all the words in the DB
            while($row = mysqli_fetch_assoc($query)){
                $wordsarray[] = $row['word'];
            }

            print_r($wordsarray);
            // shuffle the array
            shuffle($wordsarray);

            print_r($wordsarray);

            //now save the array as serialised data somewhere in the db

            //empty table
            $sql = "TRUNCATE TABLE words_shuffled;";

            if (mysqli_query($conn, $sql)) {
             echo "Record deleted successfully";
            } else {
             echo "Error deleting record: " . mysqli_error($conn);
            }

            //insert sorted array into words_shuffled
            $sql2 = '';

            for ($x = 0; $x < $row_count; $x++) {
              $sql2 .= "INSERT INTO words_shuffled (word) VALUES ('" . $wordsarray[$x] . "');";
            }

            echo $sql2;

            if ($conn->multi_query($sql2) === TRUE) {
                echo "New records created successfully";
            } else {
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }

            //words_shuffled is what we'll use for the game

            //NOW We have to start the game and give the word to the first person


}


?>
