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
<style>
.screen2, .screen3, .screen4{display:none;}
#currentcard{font-size: 3em;padding:40px 20px;border:1px solid #000;display: none;}
</style>

</head>
<body>
<?php
include('connect.php');

//Get number of players
$query = $conn->query("SELECT game_value FROM `general` WHERE game_key = 'players'");

$numberplayers = mysqli_fetch_assoc($query)['game_value'];


?>

<?php




    ?>
<div class="container">
  <div class="row">
    <div class="one-half column" style="margin-top: 5%">

      <h1>The Hat Game</h1>
      <div class="message">
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="one-half column" style="margin-top: 0%">

      <div class="screen1">
        <p>Enter your name and click Submit</p>
        <br />
        <form id="name-form">

        <label for="name-input">Name: </label>
        <input id="name-input" name="name-input" type="text"  />
        <br />
        <input type="submit" />
        </form>

      </div>
      <div class="screen2">
            <p>Enter 5 words then click Submit</p>
            <form id="words-form" >
            <label for=""></label>
            <input id="word1-input" name="wordinput[]" type="text"  />
            <label for=""></label><input id="word2-input" name="wordinput[]" type="text"  />
            <label for=""></label><input id="word3-input" name="wordinput[]" type="text"  />
            <label for=""></label><input id="word4-input" name="wordinput[]" type="text"  />
            <label for=""></label><input id="word5-input" name="wordinput[]" type="text"  />
            <br />
            <input type="submit" />
            </form>
      </div>

      <div class="screen3">

          <div class="waiting">

              Waiting for other players...

          </div>

      </div>

      <div class="screen4">

          <div class="waiting">

              <div id="currentcard"></div>
              <br />
              <button id="getcard">Get a card</button>

          </div>

      </div>



    </div>
  </div>
</div>



<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

  <script>

  $(function () {
         $('#name-form').on('submit', function (e) {
           e.preventDefault();
           $.ajax({
             type: 'post',
             url: 'adduser.php',
             data: $('#name-form').serialize(),
             success: function (data) {
               $('.message').html('<h2>Hello ' + data + '</h2>');
               $('.screen1').hide();
               $('.screen2').show();
               // link name with a cookie so that user is associated with that name
               // When there are 5 names, sort them randomly to decide order of play
               // Show form to add 5 items
               // When 5 items are added check if there are 25 items. Then they are shuffled
               // Ajax request can check the database every few seconds to see when there are 25 items and we are ready to play
               // First user in order (would have to be databse order actually) shown button to click to show a word
               // Word is shown and button can be clicked to show next word if they get that one right
               // Tally can be kept of words they got right
               // Timer can be set and when it's over move on to next person
               // When all words are used up reset and start again



             }
           });
         });

         $('#words-form').on('submit', function (e) {
           e.preventDefault();
           $.ajax({
             type: 'post',
             url: 'addwords.php',
             data: $('#words-form').serialize(),
             success: function (data) {
               console.log('<h2>' + data + '</h2>');

               $('.screen2').hide();

               $('.screen3').show();



               //keep checking database to see who goes first
               setInterval(function(){
                 $.ajax({
                   type: 'post',
                   url: 'checkdb.php',
                   success: function (data) {

                //     console.log(data);
                //     console.log(typeof data);


                    if(data === '<?php echo $numberplayers; ?>'){

                      //show button to get a card
                      $('.screen3').hide();

                      $('.screen4').show();

                    }



                 },
                 error: function(jqxhr, status, exception) {
                                    alert('Exception:', exception);
                                  }
                 });

               }, 3000);






             },
             error: function(jqxhr, status, exception) {
                                alert('Exception:', exception);
                            }
           });
         });


         document.getElementById("getcard").onclick = function() {
           getcard()
         };

         function getcard() {

           $.ajax({
             type: 'post',
             url: 'getcard.php',
             success: function (data) {

               console.log(data);
               $('#currentcard').show();
               $('#currentcard').html(data);



             },
             error: function(jqxhr, status, exception) {
                                alert('Exception:', exception);
                            }
           });


         }






       });

  </script>


</body>
</html>
