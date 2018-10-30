<?php
   session_start();
   if(!isset($_SESSION["isguestlogin"])){
    header("Location: login.php");
    exit();
   }
   include "dbconnect.php";
   $stmt = $db->prepare("select roomtypeid,rname from roomtype");
   $stmt->execute();
   $result=$stmt->fetchALL(PDO::FETCH_ASSOC);
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
  <link rel="stylesheet" type="text/css" href="semantic/semantic.css">
  <link rel="stylesheet" type="text/css" href="css/calender.css">
  <link rel="stylesheet" type="text/css" href="css/homepage.css">
  <link rel="stylesheet" type="text/css" href="iconfonts/flaticon.css">
  <script src="js/jquery.js"></script>
  <script src="semantic/semantic.js"></script>
  <script src="js/homepage.js"></script>
  <script src="js/calender.js"></script>
  <script>
    $(document).ready(function() {
      var today=new Date();
      $("#startcal").calendar({
        type: 'date',
        endCalendar: $("#endcal"),
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
      $("#endcal").calendar({
        type: 'date',
        startCalendar: $("#startcal"),
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
      $("#bookingbutton").click(function() {
		$("#successokbutton").unbind('click');	  
        var sdate = $("#startdate").val();
        var edate = $("#enddate").val();
        var rtypeid = $("#roomtypeid").val();
        $.ajax({
          url: "booking.php",
          type: "post",
          data: {
            "sdate":sdate,
            "edate": edate,
            "rtypeid":rtypeid
          },
          success: function(jsonobj) {
                  console.log(jsonobj.status);
                  if(jsonobj.status=="success"){
                    $("#noticemsg").html("Booking successfully");
                    $("#successokbutton").click(function(){
                      location="index.php";
                    });
                    $('#successdlg').modal('show');
                  }
                  else{
                    $('#warnmsg').html("Bookiing Fail !!<br/><br/>"+jsonobj.errmsg);
                    $('#warningdlg').modal('show');

                  }
          },
          error: function() {
            alert("Can't Conntect!!");
          }
        });
      });
    });
  </script>
</head>
<body id="home" class="masthead">
  <div class="ui inverted masthead centered segment">
    <div class="ui page grid">
      <div class="column">
        <div class="ui secondary pointing menu">
          <a class="logo item">
                  Sunny Beach Hotel
                  </a>
          <a class="item" href="index.php">
                  <i class="flaticon-home"></i> HOME
                  </a>
        </div>
      </div>
    </div>
    <div class="ui inverted masthead centered segment">
		 <div class="ui form">
		  <div class="three fields">
			   <div class="field">
			   </div> 
          <div class="field">
		  <label>Room Type</label>	  
          <select class="ui fluid search dropdown" id="roomtypeid">
            <?php
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
			   </div>
			 </div>			 
		   <div class="three fields">
			  <div class="field">
			   </div>
			 <div class="field">
				<label>Start Date</label>
				<div class="ui calendar" id="startcal">
					<div class="ui input left icon">
					  <i class="calendar icon"></i>
					  <input id="startdate" type="text" placeholder="Date/Time">
					</div>
				</div>
			 </div>
			  <div class="field">
			   </div>			   
		  </div>
		   <div class="three fields">
			  <div class="field">
			   </div>
			 <div class="field">
				<label>End Date</label>
				<div class="ui calendar" id="endcal">
					<div class="ui input left icon">
					  <i class="calendar icon"></i>
					  <input id="enddate" type="text" placeholder="Date/Time">
					</div>
				</div>
			</div>
			  <div class="field">
			   </div>			   
		  </div>			 
		   <div class="three fields">
			  <div class="field">
			   </div>
			   <div class="field">
				   <button class="ui inverted button" id="bookingbutton">Booking</button>
			   </div>
			   <div class="field">
			   </div>
			 </div>
				 
    </div>
  </div>
<?php include "footer.php";?>
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
