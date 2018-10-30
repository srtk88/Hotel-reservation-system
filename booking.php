<?php
	session_start();
	if(!isset($_SESSION["isguestlogin"])){
		header("Location: login.php");
		exit();
	}
	if((isset($_REQUEST["sdate"]))&&(isset($_REQUEST["edate"]))&&(isset($_REQUEST["rtypeid"]))){
	  $gid=$_SESSION["gid"];
	  $currentdatetime = time();
	  $currentdatetimestr = date("YmdHis",$currentdatetime);	
	  $rorderid= $currentdatetimestr . $gid;
	  $orderdate = 	date("Y-m-d H:i:s",$currentdatetime);
	  $sdatestr=$_REQUEST["sdate"];
	  $edatestr=$_REQUEST["edate"];
	  $rtypeid=$_REQUEST["rtypeid"];
      $sdatetime = strtotime($sdatestr);
	  $edatetime = strtotime($edatestr);
	  $diffday = intval(($edatetime-$sdatetime)/86400);
	   include "dbconnect.php";
	  $errmsg="";
	  $roomavailable=1;	
	  for($i=0;$i<$diffday;$i++) {
		$rdatetime = $sdatetime + $i*86400;
		$rdate = date("Y-m-d",$rdatetime);
		//check room reserved count  
		$stmt = $db->prepare("select * from roomrcount where roomtypeid=:roomtypeid and rdate=:rdate");
		$stmt->bindParam(':roomtypeid', intval($rtypeid));
		$stmt->bindParam(':rdate', $rdate);
		$stmt->execute(); 
		$result=$stmt->fetchALL(PDO::FETCH_ASSOC);
		$roomrcount=0;  
		foreach($result as $row){
			$roomrcount=intval($row["rcount"]);
		}
		$stmt = $db->prepare("select * from roomlimit where roomtypeid=:roomtypeid and limitdate=:rdate");
		$stmt->bindParam(':roomtypeid', intval($rtypeid));
		$stmt->bindParam(':rdate', $rdate);
		$stmt->execute(); 
		$result=$stmt->fetchALL(PDO::FETCH_ASSOC);
		$roomlimitcount=0;  
		foreach($result as $row){
			$roomlimitcount=intval($row["limitnumber"]);
		}			  
		$stmt = $db->prepare("select * from roomtype where roomtypeid=:roomtypeid");
		$stmt->bindParam(':roomtypeid', intval($rtypeid));
		$stmt->execute(); 
		$result=$stmt->fetchALL(PDO::FETCH_ASSOC);
		$rtypecount=0; 
		$rtypename="";  
		foreach($result as $row){
			$rtypecount=intval($row["rcount"]);
			$rtypename=$row["rname"];
		}  
		if($roomlimitcount>0) {
			if($roomrcount>=$roomlimitcount){
				$roomavailable=0;
				$errmsg .= $rtypename . " at " . $rdate . " is not available. <br/>";
				$execstatus="fail";
			}
		}else{
			if($roomrcount>=$rtypecount){
				$roomavailable=0;
				$errmsg .= $rtypename . "  at " . $rdate . " is not available. <br/>";
				$execstatus="fail";
			}			
		}
	  }
	  if($roomavailable==1) {
	  $db->beginTransaction();	
		  try {
			  for($i=0;$i<$diffday;$i++) {
				$rdatetime = $sdatetime + $i*86400;
				$rdate = date("Y-m-d",$rdatetime);
				$stmt = $db->prepare("insert into reservation values (:rorderid,:gid,:roomtypeid,:orderdate,:rdate)");
				$stmt->bindParam(':rorderid', $rorderid);
				$stmt->bindParam(':gid', intval($gid));
				$stmt->bindParam(':roomtypeid', intval($rtypeid));
				$stmt->bindParam(':orderdate', $orderdate);
				$stmt->bindParam(':rdate', $rdate);
				$stmt->execute();
				$stmt = $db->prepare("insert into roomrcount (roomtypeid,rcount,rdate) values (:roomtypeid,1,:rdate) on duplicate key update rcount=rcount+1;");
				$stmt->bindParam(':roomtypeid', intval($rtypeid));
				$stmt->bindParam(':rdate', $rdate);
				$stmt->execute();  
			  }
			  $db->commit();
			  $execstatus="success";
		  }catch(Exception $e){
			  //echo $e->getMessage();
			  $db->rollBack();
			  $errmsg="Server DB Problem";
			  $execstatus="fail";
		  }
	  }
	  header("Content-type: application/json");
	  echo '{"status":"' . $execstatus .'","errmsg":"'.$errmsg.'"}';//{"status":"success"}   {"status":"fail"}
	}else{
		header("Content-type: application/json");
		echo '{"status":"prohibit","errmsg":"prohibit the action"}';
	}
?>

