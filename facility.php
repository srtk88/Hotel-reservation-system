<?php
   session_start();
   include "dbconnect.php";
   $stmt = $db->prepare("select ftype,fdesc,fimage from Facility");
   $stmt->execute();
   $result=$stmt->fetchALL(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <!-- Site Properities -->
  <title>Sunny Beach Hotel</title>
  <link rel="stylesheet" type="text/css" href="semantic/semantic.css">
  <link rel="stylesheet" type="text/css" href="css/homepage.css">
  <link rel="stylesheet" type="text/css" href="iconfonts/flaticon.css">
  <script src="js/jquery.js"></script>
  <script src="semantic/semantic.js"></script>
  <script src="js/homepage.js"></script>
  <script>
    $(function() {
      $('.ui.card').popup();
    });
  </script>
</head>

<body id="home" class="masthead">
  <div class="ui inverted masthead centered segment">
    <div class="ui page grid">
      <div class="column">
        <div class="ui secondary pointing menu">
          <a class="logo item">
                  Sunny Beach Hotel
                  </a>
          <a class="item" href="index.php">
                  <i class="flaticon-home"></i> HOME
                  </a>
          <a class="active item" href="roomtype.php">
                  <i class="flaticon-heart"></i> ROOM
                  </a>
          <a class="item" href="facility.php">
                  <i class="flaticon-heart"></i> FACILITY
                  </a>
          <a class="item" href="bookingform.php">
                  <i class="flaticon-heart"></i> BOOKING
                  </a>
        </div>
      </div>
    </div>
    <div class="ui inverted masthead centered segment">
      <table class="ui celled striped table">
        <thead>
          <tr>
            <th colspan="3">
              FACILITY INTRODUCTION
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach($result as $row){//selecet all data output
            $ftype=$row["ftype"];
            $fdesc=$row["fdesc"];
            $fimage=$row["fimage"];
          ?>
          <tr>
            <td class="centered aligned">
              <?php echo $ftype; ?>
            </td>
            <td class="centered aligned"> <?php echo $fdesc; ?></td>
            <td class="centered aligned"><img class="ui large image" src="<?php echo $fimage; ?>"></td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
<?php include "footer.php";?>
</body>

</html>
