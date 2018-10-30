<?php
session_start();
if(!isset($_SESSION["isadminlogin"])){
    header("Location: adminlogin.php");
    exit();
}
include "../dbconnect.php";
$stmt = $db->prepare("select rl.roomtypeid,rt.rname,rl.limitnumber,rl.limitdate from roomlimit rl,roomtype rt where rl.roomtypeid=rt.roomtypeid order by limitdate");
$stmt->execute();
$result=$stmt->fetchALL(PDO::FETCH_ASSOC);
?>
<table class="ui celled striped table">
  <thead>
    <tr>
      <th colspan='4'><button class='ui inverted blue button' id='newroomlimitbutton' onclick="createnewroomlimit();">Create New Room Limit</button></th>
    </tr>	  
    <tr>
      <th>Room Name</th>
      <th>Room Limit Number</th>
	  <th>Room Limit Date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
<?php
foreach($result as $row){
  $roomtypeid=intval($row["roomtypeid"]);
  $roomname=$row["rname"];
  $roomlimitnumber=intval($row["limitnumber"]);
  $roomlimitdate=$row["limitdate"];
  $roomlimittime = strtotime($roomlimitdate);
  $roomlimittimestr = date("Ymd");	
  echo "<tr>";
  echo "<td id='roomname" . $roomtypeid . $roomlimittimestr . "'>";
  echo $roomname;
  echo "</td>";
  echo "<td id='roomlimitnumber" . $roomtypeid . $roomlimittimestr . "'>";
  echo $roomlimitnumber;
  echo "</td>";
  echo "<td id='roomlimitdate" . $roomtypeid . $roomlimittimestr . "'>";
  echo $roomlimitdate;
  echo "</td>";	
  echo "<td><button class='ui inverted red button' id='roomavailbutton".$roomtypeid."' onclick='changeroomlimit(".$roomtypeid.",\"".$roomlimitdate."\",".$roomtypeid . $roomlimittimestr .")'>Change Room Limit</button></td>";
  echo "</tr>";
}
?>
  </tbody>
</table>

