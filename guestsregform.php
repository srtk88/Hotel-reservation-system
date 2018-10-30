<!DOCTYPE html>
<html>
   <head>
      <!-- Standard Meta -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
      <!-- Site Properities -->
      <title>Sunny Beach Hotel - Guest Registration</title>
      <link rel="stylesheet" type="text/css" href="semantic/semantic.css">
      <link rel="stylesheet" type="text/css" href="css/homepage.css">
      <link rel="stylesheet" type="text/css" href="iconfonts/flaticon.css">
      <script src="js/jquery.js"></script>
      <script src="semantic/semantic.js"></script>
      <script src="js/homepage.js"></script>
      <script>
      	function checksubmit(){
          var fullname=$("#fullname").val();
      		var username=$("#username").val();
      		var email=$("#email").val();
      		var password=$("#password").val();
      		var repassword=$("#repassword").val();
      		var phone=$("#phone").val();
          fullname=fullname.trim();
      		username=username.trim(); 
      		email=email.trim();
      		password=password.trim();
      		repassword=repassword.trim();
      		phone=phone.trim();

          if(fullname==""){
      			$("#warnmsg").html("Fullname is empty.");
      			$("#warndlg").modal("show");
      			return;
      		}

      		if(username==""){
      			$("#warnmsg").html("Username is empty.");
      			$("#warndlg").modal("show");
      			return;
      		}
      		if(email==""){
      			$("#warnmsg").html("E-mail is empty.");
      			$("#warndlg").modal("show");
      			return;
      		}
      		if(password==""){
      			$("#warnmsg").html("Password is empty.");
      			$("#warndlg").modal("show");
      			return;
      		}
      		if(phone==""){
      			$("#warnmsg").html("Phone is empty.");
      			$("#warndlg").modal("show");
      			return;
      		}
      		if(password!=repassword){
            $("#warnmsg").html("The password is incorrect ");
      			$("#warndlg").modal("show");
      			return;
      		}
          $.ajax({
            url: "guestsreg.php",//送到guestreg
            type: "post",
            data:{"fullname":fullname,"username":username,"email":email,"password":password,"phone":phone},
            success: function(jsonobj) {
               		console.log(jsonobj.status);
               		if(jsonobj.status=="success"){
                    $('#welcomedlg').modal('show');
               		}
               		else{
               			$("#warnmsg").html("The profile is incorrect. Please check your information.");
              			$("#warndlg").modal("show");
               		}
            },
            error: function() {
            	alert("Can't Conntect!!");
            }
          });
      	}
        $(document).ready(function(){ //文件載入完成
          $('#welcomeokbutton').click(function(){
              location="login.php";
          });
        });
      </script>
   </head>
   <body class="masthead">
      <div class="ui page grid">
         <div class="column">
            <div class="ui secondary pointing menu">
               <a class="logo item" href="index.php">
               Sunny Beach Hotel Guest Registration Form
               </a>
            </div>
         </div>
         <div class="ui hidden transition information">
         </div>
      </div>
      <div class="ui segment">
         <form class="ui form">
           <div class="field">
              <label>Fullname</label>
              <input type="text" id="fullname" placeholder="Fullname">
           </div>
            <div class="field">
               <label>User name</label>
               <input type="text" id="username" placeholder="User Name">
            </div>
            <div class="field">
               <label>E-mail</label>
               <input type="text" id="email" placeholder="joe@schmoe.com">
            </div>
            <div class="field">
               <label>Password</label>
               <input type="password" id="password" placeholder="6-12 characters">
            </div>
            <div class="field">
               <label>Password Check</label>
               <input type="password" id="repassword" placeholder=" Please re-enter your pawword">
            </div>
            <div class="field">
               <label>Phone</label>
               <input type="text" id="phone">
            </div>
            <button class="ui button" type="submit" onclick="checksubmit();">Submit</button>
         </form>
      </div>
          <div class="ui small test modal transition" id="warndlg">
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
  <div class="ui small test modal transition" id="welcomedlg">
    <div class="header">
      Welcome!
    </div>
    <div class="content">
      <p >Thank you for your registration!</p>
    </div>
    <div class="actions">
      <div class="ui positive right labeled icon button" id="welcomeokbutton">
        OK
        <i class="checkmark icon"></i>
      </div>
    </div>
  </div>
   </body>
</html>
