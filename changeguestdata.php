<?php
session_start();
if(!isset($_SESSION["isguestlogin"])){
    header("Location: login.php");
    exit();
}
if(isset($_REQUEST["gpass"])&&isset($_REQUEST["gname"])&&isset($_REQUEST["gphone"])){
  $gid=$_SESSION["gid"];
  $gname=$_REQUEST["gname"];
  $gphone=$_REQUEST["gphone"];
  $gpass=$_REQUEST["gpass"];
  $hashpass=hash("sha256",$gpass);
  include "dbconnect.php";
  if($gpass=="") {
    $stmt = $db->prepare("update guests set gname=:gname,gphone=:gphone where gid=:gid");
    $stmt->bindParam(':gid',$gid);
    $stmt->bindParam(':gname',$gname);
    $stmt->bindParam(':gphone',$gphone);
  }else{
    $stmt = $db->prepare("update guests set gname=:gname,gpass=:gpass,gphone=:gphone where gid=:gid");
    $stmt->bindParam(':gid',$gid);
    $stmt->bindParam(':gpass',$hashpass);
	$stmt->bindParam(':gname',$gname);
    $stmt->bindParam(':gphone',$gphone);
  }
  $executestate=$stmt->execute();
  if($executestate){
    $execstatus="success";
	$_SESSION["username"]=$gname;
	$_SESSION["userphone"]=$gphone;
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
