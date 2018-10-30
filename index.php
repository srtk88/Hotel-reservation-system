<?php
   session_start();
   ?>
<!DOCTYPE html>
<html>
   <head>
      <!-- Standard Meta -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
      <!-- Site Properities -->
      <title>Sunny Beach Hotel - Creative Landing Page Template</title>
      <link rel="stylesheet" type="text/css" href="semantic/semantic.css">
      <link rel="stylesheet" type="text/css" href="css/homepage.css">
      <link rel="stylesheet" type="text/css" href="iconfonts/flaticon.css">
      <script src="js/jquery.js"></script>
      <script src="semantic/semantic.js"></script>
      <script src="js/homepage.js"></script>
   </head>
   <body id="home">
      <div class="ui inverted masthead centered segment">
         <div class="ui page grid">
            <div class="column">
               <div class="ui secondary pointing menu">
                  <a class="logo item">
                  Sunny Beach Hotel
                  </a>
                  <a class="active item" href="index.php">
                  <i class="flaticon-home"></i> HOME
                  </a>
                  <a class="item" href="roomtype.php">
                  <i class="flaticon-heart"></i> ROOM
                  </a>
                  <a class="item" href="facility.php">
                  <i class="flaticon-heart"></i> FACILITY
                  </a>
                  <a class="item" href="bookingform.php">
                  <i class="flaticon-heart"></i> BOOKING
                  </a>
				  <a class="item" href="guests.php">
                  <i class="flaticon-heart"></i> MEMBER
                  </a>
               </div>
               <div class="ui hidden transition information">
                  <h1 class="ui inverted centered header">
                     BEST LOCATION.BEST PRICE. GUARANTEED.
                  </h1>
                  <p class="ui centered lead">YOU WON'T GET A BETTER HOTEL PRICE THAN RIGHT HERE!</p>
                  <div class="ui centerted image">
                     <img src="images/sunnybeachhotel.jpg" />
                  </div>
               </div>
            </div>
         </div>
      </div>
<?php include "footer.php";?>
   </body>
</html>
