<?php
session_start();
if(!isset($_SESSION["isguestlogin"])){
    header("Location: login.php");
    exit();
}
$gid=$_SESSION["gid"];
include "dbconnect.php";
$stmt = $db->prepare("select rs.rorderid,gt.gemail,rt.rname,rs.rdate,rs.orderdate from reservation rs,roomtype rt,guests gt where rs.gid=gt.gid and rt.roomtypeid=rs.roomtypeid and rs.gid=:gid order by rs.rorderid,rs.rdate");

$stmt->bindParam(':gid',$gid);
$stmt->execute();
$result=$stmt->fetchALL(PDO::FETCH_ASSOC);

$orderdata=Array();
$orderidcount=0;
foreach($result as $row){
	$rorderid=$row["rorderid"];
	if(isset($orderdata[$rorderid]["sdate"])) {
		$orderdata[$rorderid]["edate"]=$row["rdate"];
		$orderidcount++;
		$orderdata[$rorderid]["daycount"]=$orderidcount;
		continue;
	}else{
		$orderidcount=0;
		$orderdata[$rorderid]["sdate"]=$row["rdate"];
		$orderdata[$rorderid]["gemail"]=$row["gemail"];
		$orderdata[$rorderid]["rname"]=$row["rname"];
		$orderdata[$rorderid]["orderdate"]=$row["orderdate"];
	}
}
?>
<table class="ui celled striped table">
  <thead>
    <tr>
      <th>Order ID</th>
      <th>Guest Email</th>
      <th>Room Type</th>
	  <th>Reserved Period</th>
	  <th>Order Date</th>
	  <th>Day Count</th>
    </tr>
  </thead>
  <tbody>
<?php
foreach($orderdata as $orderid => $orderdetail){//selecet all data output
	  echo "<tr>";
	  echo "<td>";
	  echo $orderid;
	  echo "</td>";	
	  echo "<td>";
	  echo $orderdetail["gemail"];
	  echo "</td>";
	  echo "<td>";
	  echo $orderdetail["rname"];
	  echo "</td>";	
	  echo "<td>";
	  echo $orderdetail["sdate"] . " -  "  . $orderdetail["edate"];
	  echo "</td>";
	  echo "<td>";
	  echo $orderdetail["orderdate"];
	  echo "</td>";	
	  echo "<td>";
	  echo $orderdetail["daycount"];
	  echo "</td>";		
      echo "</tr>";
}
?>
  </tbody>
</table>

