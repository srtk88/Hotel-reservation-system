<?php
session_start();
if(!isset($_SESSION["isguestlogin"])){
    header("Location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
   <head>
      <!-- Standard Meta -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
      <!-- Site Properities -->
      <title>Sunny Beach Hotel Member Area</title>
      <link rel="stylesheet" type="text/css" href="semantic/semantic.css">
      <link rel="stylesheet" type="text/css" href="css/homepage.css">
      <link rel="stylesheet" type="text/css" href="iconfonts/flaticon.css">
      <script src="js/jquery.js"></script>
      <script src="semantic/semantic.js"></script>
      <script src="js/homepage.js"></script>
      <script>
         $(document).ready(function(){
           $("#guestdata").click(function(){
				location="guests.php";
           });
		   $("#guestorder").click(function(){//retrieve all of guests information
             $.ajax({
               url: "guestorder.php",
               type: "post",
               success: function(data) {//return the data back
                 $("#guestcontent").html(data);
               },
               error: function() {
                 alert("Can't Conntect!!");
               }
             });
           });
           $("#guestupdatebutton").click(function(){
			var fullname=$("#fullname").val();
			var password=$("#password").val();
			var repassword=$("#repassword").val();
			var phone=$("#phone").val();
			fullname=fullname.trim();
      		password=password.trim();
      		repassword=repassword.trim();
            phone=phone.trim();	
      		if(phone==""){
      			$("#warnmsg").html("Phone is empty.");
      			$("#warningdlg").modal("show");
      			return false;
      		}	
      		if(fullname==""){
      			$("#warnmsg").html("Full Name is empty.");
      			$("#warningdlg").modal("show");
      			return false;
      		}			
			if(password!=repassword){
			$("#warnmsg").html("The password is incorrect ");
				$("#warningdlg").modal("show");
				return false;
			}					
			$.ajax({
				url: "changeguestdata.php",
				type: "post",
				data: {
					"gname": fullname,
					"gpass": password,
					"gphone": phone
				},
				success: function(data) {
					console.log(data);
					$("#noticemsg").html("Modify successfully");
					$("#successokbutton").click(function(){
						location="guests.php";
					});
					$('#successdlg').modal('show');
				},
				error: function() {
					alert("Can't Conntect!!");
				}
			});            
         });
	   });
      </script>
   </head>
   <body class="masthead">
      <div class="ui two column page grid">
         <div class="column">
            <div class="ui secondary pointing menu">
               <a class="logo item" href="../index.php">
               Sunny Beach Hotel Member Area
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
                <a class="active item" id="guestdata">
                  Guests Data
                </a>
                <a class="active item" id="guestorder">
                  Orders
                </a>
                <a class="active item" href="logout.php">
                  Logout
                </a>				
              </div>
            </div>
              <div class="ten wide column" id="guestcontent">
			   <form class="ui form">
				 <div class="field">
					<label>Fullname</label>
					<input type="text" id="fullname" value="<?php echo $_SESSION["username"];?>">
				 </div>
				  <div class="field">
					 <label>New Password</label>
					 <input type="password" id="password" placeholder="6-12 characters">
				  </div>
				  <div class="field">
					 <label>Repeat New Password</label>
					 <input type="password" id="repassword" placeholder="6-12 characters">
				  </div>				  
				  <div class="field">
					 <label>Phone</label>
					 <input type="text" id="phone" value="<?php echo $_SESSION["userphone"];?>">
				  </div>
				  <button class="ui button" id="guestupdatebutton">Update</button>
			   </form>
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
