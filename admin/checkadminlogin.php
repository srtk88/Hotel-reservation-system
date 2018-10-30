<?php
session_start();
if((isset($_REQUEST["email"]))&&(isset($_REQUEST["password"]))){
$adminemail=$_REQUEST["email"];
$adminpass=$_REQUEST["password"];
$hashpass=hash("sha256",$adminpass);
include "../dbconnect.php";
$stmt = $db->prepare("select aemail from admin where aemail=:adminemail and apass=:adminpass");
$stmt->bindParam(':adminemail',$adminemail);
$stmt->bindParam(':adminpass', $hashpass);
$stmt->execute();
$result=$stmt->fetchALL(PDO::FETCH_ASSOC);
$authstatus="fail";
foreach($result as $row){
  $authstatus="success";
  $_SESSION["isadminlogin"]=true;
  $_SESSION["adminemail"]=$row["aemail"];
}
header("Content-type: application/json");
echo '{"status":"' . $authstatus .'"}';//{"status":"success"}   {"status":"fail"}
}else{
	header("Content-type: application/json");
	echo '{"status":"prohibit"}';
}
?>
