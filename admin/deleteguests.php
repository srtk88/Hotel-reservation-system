<?php
session_start();
if(!isset($_SESSION["isadminlogin"])){
    header("Location: adminlogin.php");
    exit();
}
if(isset($_REQUEST["gid"])){
$gid=$_REQUEST["gid"];
include "../dbconnect.php";
$stmt = $db->prepare("delete from guests where gid=:gid");
$stmt->bindParam(':gid',$gid);
$stmt->execute();
$executestate=$stmt->execute();
if($executestate){
  $execstatus="success";
}else{
  $execstatus="fail";
}
header("Content-type: application/json");
echo '{"status":"' . $execstatus .'"}';//{"status":"success"}   {"status":"fail"}
}else{
header("Content-type: application/json");
echo '{"status":"prohibit"}';
}
?>
