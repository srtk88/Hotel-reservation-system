<?php
session_start();
if(!isset($_SESSION["isadminlogin"])){
    header("Location: adminlogin.php");
    exit();
}
if(isset($_REQUEST["roomtypeid"])&&isset($_REQUEST["roomprice"])){
  $roomtypeid=$_REQUEST["roomtypeid"];
  $roomprice=$_REQUEST["roomprice"];
  include "../dbconnect.php";

  $stmt = $db->prepare("update roomtype set rprice=:roomprice where roomtypeid=:roomtypeid");
  $stmt->bindParam(':roomtypeid',$roomtypeid);
  $stmt->bindParam(':roomprice',$roomprice);
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
