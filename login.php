<!DOCTYPE html>
<html>
   <head>
      <!-- Standard Meta -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
      <!-- Site Properities -->
      <title>Sunny Beach Hotel Guest Login</title>
      <link rel="stylesheet" type="text/css" href="semantic/semantic.css">
      <link rel="stylesheet" type="text/css" href="css/homepage.css">
      <link rel="stylesheet" type="text/css" href="iconfonts/flaticon.css">
      <script src="js/jquery.js"></script>
      <script src="semantic/semantic.js"></script>
      <script src="js/homepage.js"></script>
      <script>
         function processauth(){
         		$.ajax({
					url: "checklogin.php",
					type: "post",
					data:{"email":$("#email").val(),"password":$("#password").val()},
         			success: function(jsonobj) {
                   		console.log(jsonobj.status);
                   		if(jsonobj.status=="success"){
                   			location="guests.php";
                   		}
                   		else{
                   			$('#loginerrdlg').modal('show');

                   		}
         			},
         			error: function() {
         				alert("Can't Conntect!!");
         			}
         		});
         }
         $(document).ready(function(){


         });
      </script>
   </head>
   <body class="masthead">
      <div class="ui two column page grid">
         <div class="column">
            <div class="ui secondary pointing menu">
               <a class="logo item" href="index.php">
               Sunny Beach Hotel Guest Login
               </a>
            </div>
         </div>
         <div class="ui hidden transition information">
         </div>
      </div>
         <div class="ui  five column middle aligned  grid">
			 <div class="column">
			 </div>	 
            <div class="column">
               <div class="ui form">
                  <div class="field">
                     <label>Email</label>
                     <div class="ui left icon input">
                        <input id="email" type="text" placeholder="Email">
                        <i class="user icon"></i>
                     </div>
                  </div>
                  <div class="field">
                     <label>Password</label>
                     <div class="ui left icon input">
                        <input id="password" type="password">
                        <i class="lock icon"></i>
                     </div>
                  </div>

				  <div class="ui blue submit button" onclick="processauth()">Login</div>
               </div>
			   
			 </div>
            <div class="column">
							<div class="ui vertical divider">
							   Or
							</div>
			</div>
            <div class="column">

						   <div class="ui big green labeled icon button"  onclick="location='guestsregform.php';">
							<i class="signup icon"></i>
							    Sign Up
					       </div>
		    </div>	
            <div class="column">
			 </div>
         </div>
      <div class="ui small test modal transition" id="loginerrdlg">
    <div class="header">
      Warning!
    </div>
    <div class="content">
      <p>The email or password you typed is incorrect. Please try again.</p>
    </div>
    <div class="actions">
      <div class="ui positive right labeled icon button">
        OK
        <i class="checkmark icon"></i>
      </div>
    </div>
  </div>
   </body>

</html>
