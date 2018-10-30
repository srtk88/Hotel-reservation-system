<?php
session_start();
if(!isset($_SESSION["isadminlogin"])){
    header("Location: adminlogin.php");
    exit();
}
 include "../dbconnect.php";
?>
<!DOCTYPE html>
<html>
   <head>
      <!-- Standard Meta -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
      <!-- Site Properities -->
      <title>Sunny Beach Hotel - Creative Landing Page Template</title>
      <link rel="stylesheet" type="text/css" href="../semantic/semantic.css">
      <link rel="stylesheet" type="text/css" href="../css/calender.css">	   
      <link rel="stylesheet" type="text/css" href="../css/homepage.css">
      <link rel="stylesheet" type="text/css" href="../iconfonts/flaticon.css">
      <script src="../js/jquery.js"></script>
      <script src="../semantic/semantic.js"></script>
      <script src="../js/homepage.js"></script>
      <script src="../js/calender.js"></script>	   
      <script>
		 function gofilterbyemail() {
			gemail= $("#filtergemail").val();
			gemail=gemail.trim();
              if(gemail==""){
      			$("#warnmsg").html("Room Limit Number is empty.");
      			$("#warndlg").modal("show");
      			return;
      		 }			 
            $.ajax({
             url: "guestsadmin.php",
             type: "post",
			 data:{"gemail":gemail},	
               success: function(data) {//直接傳回網頁的資料
                 $("#admincontent").html(data);//tag 中間夾的區域
               },
               error: function() {
                 alert("Can't Conntect!!");
               }
             });			 
		 }
		  
		 function createnewroomlimit() {
			 $("#newroomavailableokbutton").unbind('click');
           $("#newroomavailableokbutton").click(function(){
             var newroomlimitnumber=$('#createnewroomlimitnumber').val();
			 newroomlimitnumber=newroomlimitnumber.trim();  
              if(newroomlimitnumber==""){
      			$("#warnmsg").html("Room Limit Number is empty.");
      			$("#warndlg").modal("show");
      			return;
      		 }			   
			 var newlimitrtypeid = $("#newlimitroomtypeid").val(); 
			 var newlimitdate = $('#createnewroomlimitcal').calendar('get date');  
			var selectdate=new Date(newlimitdate);
			var day =selectdate.getDate();
			day=""+day;
			if(day.length==1) {
				day="0"+day;
			}
			var month = selectdate.getMonth() + 1;
			month=""+month;
			if(month.length==1) {
				month="0"+month;
			}			   
			var year = selectdate.getFullYear();
			var selectdatestr= year + '-' + month + '-' + day;		
             $.ajax({
             url: "newroomavailable.php",
             type: "post",
             data:{"roomtypeid":newlimitrtypeid,"limitdate":selectdatestr,"newroomlimitnumber":newroomlimitnumber},
               success: function(jsonobj) {
                       console.log(jsonobj.status);
                       if(jsonobj.status=="success"){  
                           $("#noticemsg").html("Create New Room Available successfully");
						   $("#successokbutton").click(function(){
						         $("#roomavailable").click();
						   });						   
                           $('#successdlg').modal('show');
                       }
                       else{
                         $('#warnmsg').html("Create New Room Available Fail");
                         $('#warningdlg').modal('show');
                       }
               },
               error: function() {
                 alert("Can't Conntect!!");
               }
             });
           });			 
			 $("#newroomavailabledlg").modal("show");
			 
		 }
         function changeroomlimit(roomtypeid,limitdate,recordid){
		   $("#modifyroomavailableokbutton").unbind('click');
		   $("#successokbutton").unbind('click');	 
           var roomlimitnumberval=$('#roomlimitnumber'+recordid).html();
           $('#newroomlimitnumber').val(roomlimitnumberval);
           var roomnameval=$('#roomname'+recordid).html();
           $('#modifyroomavailableroomtypename').html(roomnameval);
           $("#modifyroomavailableokbutton").click(function(){
             var newroomlimitnumber=$('#newroomlimitnumber').val();
             $.ajax({
             url: "modifyroomavailable.php",
             type: "post",
             data:{"roomtypeid":roomtypeid,"limitdate":limitdate,"newroomlimitnumber":newroomlimitnumber},
               success: function(jsonobj) {
                       console.log(jsonobj.status);
                       if(jsonobj.status=="success"){  
                           $("#noticemsg").html("Modify Room Available successfully");
						   $("#successokbutton").click(function(){
						         $("#roomavailable").click();
						   });						   
                           $('#successdlg').modal('show');
                       }
                       else{
                         $('#warnmsg').html("Modify Room Available Fail");
                         $('#warningdlg').modal('show');
                       }
               },
               error: function() {
                 alert("Can't Conntect!!");
               }
             });
           });

           $('#modifyroomavailabledlg').modal('show');
         }		  
		  
         function deleteguest(gid){
		   $("#successokbutton").unbind('click');	 
           $.ajax({
           url: "deleteguests.php",
           type: "post",
           data:{"gid":gid},
             success: function(jsonobj) {
                     console.log(jsonobj.status);
                     if(jsonobj.status=="ok"){
                       $("#noticemsg").html("Delete successfully");
                       $("#successokbutton").click(function(){
                         $("#guestsadmin").click();
                       });
                       $('#successdlg').modal('show');
                     }
                     else{
                       $('#warnmsg').html("Delete Fail");
                       $('#warningdlg').modal('show');

                     }
             },
             error: function() {
               alert("Can't Conntect!!");
             }
           });
         }
         function changeroomprice(roomtypeid){
		   $("#modifyroompriceokbutton").unbind('click');
		   $("#successokbutton").unbind('click');	 
           var roompriceval=$('#roomprice'+roomtypeid).html();
           $('#newroomprice').val(roompriceval);
           var roomnameval=$('#roomname'+roomtypeid).html();
           $('#modifyroompriceroomtypename').html(roomnameval);
           $("#modifyroompriceokbutton").click(function(){
             var newroomprice=$('#newroomprice').val();
             $.ajax({
             url: "modifyroomprice.php",
             type: "post",
             data:{"roomtypeid":roomtypeid,"roomprice":newroomprice},
               success: function(jsonobj) {
                       console.log(jsonobj.status);
                       if(jsonobj.status=="success"){  
                           $("#noticemsg").html("Modify Room Price successfully");
						   $("#successokbutton").click(function(){
						         $("#roomadmin").click();
						   });						   
                           $('#successdlg').modal('show');
                       }
                       else{
                         $('#warnmsg').html("Modify Room Price Fail");
                         $('#warningdlg').modal('show');
                       }
               },
               error: function() {
                 alert("Can't Conntect!!");
               }
             });
           });

           $('#modifyroompricedlg').modal('show');
         }
         function modifyguest(gid){
		    $("#modifyokbutton").unbind('click');
			$("#successokbutton").unbind('click');	
           var gnameval=$('#gname'+gid).html();//根據gid取html裡gname值
           $('#fullname').val(gnameval);
           var gphoneval=$('#gphone'+gid).html();//根據gid取html裡gname值
           $('#phone').val(gphoneval);
           $("#modifyokbutton").click(function(){
             var gpass=$('#password').val();
             gpass=gpass.trim();
             $.ajax({
             url: "modifyguests.php",
             type: "post",
             data:{"gid":gid,"gname":$('#fullname').val(),"gpass":gpass,"gphone":$('#phone').val()},
               success: function(jsonobj) {
                       console.log(jsonobj.status);
                       if(jsonobj.status=="success"){
                         $("#noticemsg").html("Modify successfully");
                         $("#successokbutton").click(function(){
                           $("#guestsadmin").click();
							 return true;
                         });
                         $('#successdlg').modal('show');
                       }
                       else{
                         $('#warnmsg').html("Modify Fail");
                         $('#warningdlg').modal('show');

                       }
               },
               error: function() {
                 alert("Can't Conntect!!");
               }
             });
           });
           $('#modifydlg').modal('show');
         }
         $(document).ready(function(){//jquery retrieve the data after implementing codes
           $("#guestsadmin").click(function(){//retrieve all of guests information
             $.ajax({
             url: "guestsadmin.php",
             type: "post",
               success: function(data) {//return the data directly
                 $("#admincontent").html(data);
               },
               error: function() {
                 alert("Can't Conntect!!");
               }
             });
           });
           $("#reservationadmin").click(function(){
             $.ajax({
             url: "adminguestorder.php",
             type: "post",
               success: function(data) {//return the data directly
                 $("#admincontent").html(data);
               },
               error: function() {
                 alert("Can't Conntect!!");
               }
             });
           });
           $("#roomadmin").click(function(){
             $.ajax({
             url: "adminroomlist.php",
             type: "post",
               success: function(data) {//return the data directly
                 $("#admincontent").html(data);
               },
               error: function() {
                 alert("Can't Conntect!!");
               }
             });
           });
           $("#roomavailable").click(function(){
             $.ajax({
             url: "adminroomavailable.php",
             type: "post",
               success: function(data) {//return the data directly
                 $("#admincontent").html(data);
               },
               error: function() {
                 alert("Can't Conntect!!");
               }
             });
           });
			  var today=new Date();
			  $("#createnewroomlimitcal").calendar({
				type: 'date',
				inline: true,  
				formatter: {
				  date: function(date, settings) {
					if (!date) return '';
					var day = date.getDate();
					var month = date.getMonth() + 1;
					var year = date.getFullYear();
					return year + '-' + month + '-' + day;
				  }
				},
				minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate())//limit today
			  });			 
           $("#guestsadmin").click();
         });
      </script>
   </head>
   <body class="masthead">
      <div class="ui page grid">
         <div class="column">
            <div class="ui secondary pointing menu">
               <a class="logo item" href="../index.php">
               Sunny Beach Hotel Admin Panel
               </a>
            </div>
         </div>
         <div class="ui hidden transition information">
         </div>
      </div>
      <div class="ui segment">
         <div class="ui middle aligned very relaxed stackable grid">
            <div class="six wide column">
              <div class="ui vertical pointing menu">
                <a class="active item" id="guestsadmin">
                  Guests
                </a>
                <a class="active item" id="reservationadmin">
                  Reservation
                </a>
                <a class="active item" id="roomadmin">
                  Room Price
                </a>
                <a class="active item" id="roomavailable">
                  Room Available
                </a>				  
                <a class="active item" href="adminlogout.php">
                  Logout
                </a>				
              </div>
            </div>
              <div class="ten wide column" id="admincontent">
              </div>
         </div>
      </div>
      <div class="ui small test modal transition" id="newroomavailabledlg">
         <div class="header">
            Update!
         </div>
         <div class="content">
           <form class="ui form">
			 <div class="field">
				<label>Room Limit Date</label>
				<div class="ui calendar" id="createnewroomlimitcal">
				</div>
			 </div>
          <div class="field">
		  <label>Room Type</label>	  
          <select class="ui fluid search dropdown" id="newlimitroomtypeid">
            <?php
		   $stmt = $db->prepare("select roomtypeid,rname from roomtype");
		   $stmt->execute();
		   $result=$stmt->fetchALL(PDO::FETCH_ASSOC);			  
            foreach($result as $row){//selecet all data output
              $roomtypeid=$row["roomtypeid"];
              $rname=$row["rname"];
            ?>
                      <option value="<?php echo $roomtypeid; ?>"><?php echo $rname; ?></option>
            <?php
            }
            ?>
                 </select>
            </div>
              <div class="field">
                 <label>New Room Limt Number</label>
                 <input type="text" id="createnewroomlimitnumber">
              </div>
           </form>
         </div>
         <div class="actions">
           <div class="ui negative right labeled icon button" id="newroomavailablecancelbutton">
              Cancel
           </div>
            <div class="ui positive right labeled icon button" id="newroomavailableokbutton">
               OK
               <i class="checkmark icon"></i>
            </div>
         </div>
      </div>	   
      <div class="ui small test modal transition" id="modifyroomavailabledlg">
         <div class="header">
            Update Room Limit Number!
         </div>
         <div class="content">
           <form class="ui form">
             <div class="field">
                <label>Room Type</label>
				<div id="modifyroomavailableroomtypename"></div>
             </div>
              <div class="field">
                 <label>New Room Limt Number</label>
                 <input type="text" id="newroomlimitnumber">
              </div>
           </form>
         </div>
         <div class="actions">
           <div class="ui negative right labeled icon button" id="modifyroomavailablecancelbutton">
              Cancel
           </div>
            <div class="ui positive right labeled icon button" id="modifyroomavailableokbutton">
               OK
               <i class="checkmark icon"></i>
            </div>
         </div>
      </div>	   
      <div class="ui small test modal transition" id="modifyroompricedlg">
         <div class="header">
            Update Room Price!
         </div>
         <div class="content">
           <form class="ui form">
             <div class="field">
                <label>Room Type</label>
				<div id="modifyroompriceroomtypename"></div>
             </div>
              <div class="field">
                 <label>New Room Price</label>
                 <input type="text" id="newroomprice">
              </div>
           </form>
         </div>
         <div class="actions">
           <div class="ui negative right labeled icon button" id="modifyroompricecancelbutton">
              Cancel
           </div>
            <div class="ui positive right labeled icon button" id="modifyroompriceokbutton">
               OK
               <i class="checkmark icon"></i>
            </div>
         </div>
      </div>		  
      <div class="ui small test modal transition" id="modifydlg">
         <div class="header">
            Update Guest Profile !
         </div>
         <div class="content">
           <form class="ui form">
             <div class="field">
                <label>Fullname</label>
                <input type="text" id="fullname">
             </div>
              <div class="field">
                 <label>Password</label>
                 <input type="password" id="password" placeholder="6-12 characters">
              </div>
              <div class="field">
                 <label>Phone</label>
                 <input type="text" id="phone">
              </div>
           </form>
         </div>
         <div class="actions">
           <div class="ui negative right labeled icon button" id="modifycancelbutton">
              Cancel
           </div>
            <div class="ui positive right labeled icon button" id="modifyokbutton">
               OK
               <i class="checkmark icon"></i>
            </div>
         </div>
      </div>
      <div class="ui small test modal transition" id="warningdlg">
         <div class="header">
            Warning!
         </div>
         <div class="content">
            <p id="warnmsg"></p>
         </div>
         <div class="actions">
            <div class="ui positive right labeled icon button">
               OK
               <i class="checkmark icon"></i>
            </div>
         </div>
      </div>
      <div class="ui small test modal transition" id="successdlg">
         <div class="header">
            Notice
         </div>
         <div class="content">
            <p id="noticemsg"></p>
         </div>
         <div class="actions">
            <div class="ui positive right labeled icon button" id="successokbutton">
               OK
               <i class="checkmark icon"></i>
            </div>
         </div>
      </div>
   </body>
</html>
