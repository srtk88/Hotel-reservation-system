<?php
session_start();
if(!isset($_SESSION["isadminlogin"])){
    header("Location: adminlogin.php");
    exit();
}
include "../dbconnect.php";
$stmt = $db->prepare("select * from roomtype");
$stmt->execute();
$result=$stmt->fetchALL(PDO::FETCH_ASSOC);
?>
<table class="ui celled striped table">
  <thead>
    <tr>
      <th>Room Name</th>
      <th>Room Price</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
<?php
foreach($result as $row){//selecet all data output
  $roomtypeid=$row["roomtypeid"];
  $roomname=$row["rname"];
  $roomprice=$row["rprice"];
  echo "<tr>";
  echo "<td id='roomname".$roomtypeid."'>";
  echo $roomname;
  echo "</td>";
  echo "<td id='roomprice".$roomtypeid."'>";
  echo $roomprice;
  echo "</td>";
  echo "<td><button class='ui inverted red button' id='roombutton".$roomtypeid."' onclick='changeroomprice(".$roomtypeid.")'>Change Price</button></td>";
  echo "</tr>";
}
?>
  </tbody>
</table>

