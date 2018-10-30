<?php
session_start();
if(!isset($_SESSION["isadminlogin"])){
    header("Location: adminlogin.php");
    exit();
}
if(isset($_REQUEST["roomtypeid"])&&isset($_REQUEST["limitdate"])&&isset($_REQUEST["newroomlimitnumber"])){
  $roomtypeid=intval($_REQUEST["roomtypeid"]);
  $limitdate=$_REQUEST["limitdate"];
  $newroomlimitnumber=intval($_REQUEST["newroomlimitnumber"]);
  include "../dbconnect.php";

  $stmt = $db->prepare("update roomlimit set limitnumber=:limitnumber where roomtypeid=:roomtypeid and limitdate=:limitdate");
  $stmt->bindParam(':roomtypeid',$roomtypeid);
  $stmt->bindParam(':limitnumber',$newroomlimitnumber);
  $stmt->bindParam(':limitdate',$limitdate);
  $stmt->execute();
  $executestate=$stmt->execute();//判斷執行是否成功
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

