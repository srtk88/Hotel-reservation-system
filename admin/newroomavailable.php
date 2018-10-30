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

  $stmt = $db->prepare("insert into roomlimit (roomtypeid,limitnumber,limitdate)  values (:roomtypeid,:limitnumber1,:limitdate) on duplicate key update limitnumber=:limitnumber2");
  $stmt->bindParam(':roomtypeid',$roomtypeid);
  $stmt->bindParam(':limitnumber1',$newroomlimitnumber);
  $stmt->bindParam(':limitnumber2',$newroomlimitnumber);
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


