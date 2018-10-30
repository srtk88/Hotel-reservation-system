<?php
session_start();
if(!isset($_SESSION["isadminlogin"])){
    header("Location: adminlogin.php");
    exit();
}
include "../dbconnect.php";
if(isset($_REQUEST["gemail"])) {
	$gemail=$_REQUEST["gemail"];
	$stmt = $db->prepare("select gid,gname,gemail,gphone from guests where gemail=:gemail");
	$stmt->bindParam(':gemail',$gemail);
	$stmt->execute();	
}else{
	$stmt = $db->prepare("select gid,gname,gemail,gphone from guests");
	$stmt->execute();
}
$result=$stmt->fetchALL(PDO::FETCH_ASSOC);
?>
<table class="ui celled striped table">
  <thead>
    <tr>
		<th colspan="5">
			<div class="ui form">
			  <div class="fields">	
			  <div class="two fields">
			  <div class="field">
				<label>Guest Email For Filter</label>
				<input type="text" id="filtergemail" placeholder="Guest Email">
			  </div>
			<div class="field">
				<label>&nbsp;&nbsp;&nbsp;</label>
			   <button class='ui inverted brown button' id="filterbyemailbutton" onclick="gofilterbyemail();">Filter By Email</button>
				</div>	
				  </div>
				  </div>
			</div>	
		</th>	  
	 </tr>	
    <tr>
      <th>Guest name</th>
      <th>Guest Email</th>
      <th>Guest Phone</th>
      <th colspan="2">Action</th><!--modify and delete button-->
    </tr>
  </thead>
  <tbody>
<?php
foreach($result as $row){//selecet all data output
  $gid=$row["gid"];
  echo "<tr>";
  echo "<td id='gname".$gid."'>";
  echo $row["gname"];
  echo "</td>";
  echo "<td id='gemail".$gid."'>";
  echo $row["gemail"];
  echo "</td>";
  echo "<td id='gphone".$gid."'>";
  echo $row["gphone"];
  echo "</td>";
  echo "<td><button class='ui inverted red button' onclick='modifyguest(".$gid.")'>Modify</button></td>";
  echo "<td><button class='ui inverted blue button' onclick='deleteguest(".$gid.")'>Delete</button></td>";
  echo "</tr>";
}
?>
  </tbody>
</table>
