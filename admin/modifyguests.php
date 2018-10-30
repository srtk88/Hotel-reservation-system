<?php
session_start();
if(!isset($_SESSION["isadminlogin"])){
    header("Location: adminlogin.php");
    exit();
}
if(isset($_REQUEST["gid"])&&isset($_REQUEST["gname"])&&isset($_REQUEST["gphone"])&&isset($_REQUEST["gpass"])){
  $gid=$_REQUEST["gid"];
  $gname=$_REQUEST["gname"];
  $gphone=$_REQUEST["gphone"];
  $gpass=$_REQUEST["gpass"];
  $hashpass=hash("sha256",$gpass);
  include "../dbconnect.php";
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
