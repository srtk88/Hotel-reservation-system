<?php
session_start();
if((isset($_REQUEST["fullname"]))&&(isset($_REQUEST["username"]))&&(isset($_REQUEST["email"]))&&(isset($_REQUEST["password"]))&&(isset($_REQUEST["phone"]))){
  $fullname=$_REQUEST["fullname"];
  $username=$_REQUEST["username"];
  $useremail=$_REQUEST["email"];
  $userpass=$_REQUEST["password"];
  $userphone=$_REQUEST["phone"];
  $hashpass=hash("sha256",$userpass);//store in the database
   include "dbconnect.php";
  $stmt = $db->prepare("INSERT INTO guests (gusername,gpass,gname,gemail,gphone,gdate) values (:gusername,:gpass,:gname,:gemail,:gphone,now())");
  $stmt->bindParam(':gusername', $username);
  $stmt->bindParam(':gpass', $hashpass);
  $stmt->bindParam(':gname', $fullname);
  $stmt->bindParam(':gemail', $useremail);
  $stmt->bindParam(':gphone', $userphone);
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
