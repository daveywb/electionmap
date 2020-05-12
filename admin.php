<?php
include('connect.php');

//This will be a place the host can go to set up:
// - Number of users
// - Reset the game

//I'll just do this without Ajax


// Current number of users
$query = $conn->query("SELECT * FROM `users`");
// Count number of rows
$row_count = $query->num_rows;

if(!empty($_POST['players'])){

  // if restart is clicked,
  // --players are all deleted
  $sql = "TRUNCATE TABLE users;";

  if (mysqli_query($conn, $sql)) {
   echo "Record deleted successfully";
  } else {
   echo "Error deleting record: " . mysqli_error($conn);
  }
  // --cards are all deleted
  $sql = "TRUNCATE TABLE words;";

  if (mysqli_query($conn, $sql)) {
   echo "Record deleted successfully";
  } else {
   echo "Error deleting record: " . mysqli_error($conn);
  }

  // -- number of players is updated
  $numberplayers = $_POST['players'];


  $sql = "UPDATE general SET game_value = $numberplayers WHERE game_key = 'players'";

  if ($conn->query($sql) === TRUE) {
      echo  $numberplayers;
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }



  $query = $conn->query("SELECT game_value FROM `general` WHERE game_key = 'players'");
  // Count number of rows
  $numberplayers = $query;

  $conn->close();

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Your page title here :)</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="icon" type="image/png" href="images/favicon.png">
  </head>
  <body>
    <div class="container">
      <div class="row">

        <div class="one-half column" style="margin-top: 5%">
            <h1>Admin</h1>
            <div>
        <?php


            echo 'Number of current user:' . $row_count;
          ?>
        </div>
        <div>
          <form id="restartGame" method="post">
            <label for="players">Players</label>
            <input type="number" name="players" value="<?php echo $numberplayers; ?>" />
            <input type="submit" value="Restart Game" />
          </form>
        </div>

      </div>
    </div>
  </div>
<script>



</script>

  </body>
</html>
