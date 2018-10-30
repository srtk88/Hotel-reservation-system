<?php
session_start();
if((isset($_REQUEST["email"]))&&(isset($_REQUEST["password"]))){
$useremail=$_REQUEST["email"];
$userpass=$_REQUEST["password"];
$hashpass=hash("sha256",$userpass);
include "dbconnect.php";
$stmt = $db->prepare("select gid,gname,gphone,gemail from guests where gemail=:useremail and gpass=:userpass");
$stmt->bindParam(':useremail', $useremail);
$stmt->bindParam(':userpass', $hashpass);
$stmt->execute();
$result=$stmt->fetchALL(PDO::FETCH_ASSOC);
$authstatus="fail";
foreach($result as $row){
  $authstatus="success";
  $_SESSION["isguestlogin"]=true;
  $_SESSION["gid"]=$row["gid"];
  $_SESSION["username"]=$row["gname"];
  $_SESSION["userphone"]=$row["gphone"];
  $_SESSION["useremail"]=$row["gemail"];
}
header("Content-type: application/json");
echo '{"status":"' . $authstatus .'"}';//{"status":"success"}   {"status":"fail"}
}else{
	header("Content-type: application/json");
	echo '{"status":"prohibit"}';
}
?>
