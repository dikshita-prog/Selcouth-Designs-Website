<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
#overlay {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.9);
  z-index: 2;
  cursor: pointer;
}

#text{
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 20px;
  color: white;
  transform: translate(-50%,-50%);
  -ms-transform: translate(-50%,-50%);
}
a
{
	color:black;
}

</style>
</head>
<body onload="OverlayOn()">
<link rel="stylesheet" type="text/css" href="../CSS/login.css">
<link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru&family=Monoton&family=Train+One&family=Yatra+One&display=swap" rel="stylesheet"> 
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet"> 

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@1,500&display=swap" rel="stylesheet"> 
</head>
<body>

<h1 style=" font-family: 'Train One', cursive; font-size:55px; word-spacing: 5px;color: white;"><center>SELCOUTH DESIGNS<img src="../images/logo500b.png"></center></h1>
<div class=" box">
<div class="display" style="font-family: 'Cormorant Garamond', serif;"><h4><i><a href="../HTML/homepage.html">Go back to homepage..</a>
<br><br>
Or redirect to the <a href="bookaslot1.php">Slot Booking Page</a>
</h4></i>
<h4>Or <a href="../HTML/about.html">Reach out to us</a></h4>
</div>
</div>
<br>
<div id="overlay" onclick="OverlayOff()">
<div id="text">
<?php
	//form validation
	require_once "config.php";

	$name=$_POST['uname'];
	$user=$_POST['email'];
    $phn=$_POST['phno'];
	$city=$_POST['city'];
	$purpose=$_POST['purpose'];
	$meet_time=$_POST['time'];
	if(isset($_POST['submit']))
	{
	if(empty($user)||empty($name)||empty($phn)||empty($city)||empty($purpose)||empty($meet_time)){
		echo "<h2><u>Error</u></h2>Please enter all the details carefully";
	}
	elseif(!ctype_alpha($name))
	{
		 echo "<h2><u>Erroe</u></h2>Invalid Name.<br>Name can only contain alphabets.<br>Please try again." ;

	}
	elseif (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
       echo "<h2><u>Error</u></h2>Invalid email format";
    }
	elseif(!(preg_match('/^[0-9]{10}+$/', $phn))) {
		echo "<h2><u>Error</u></h2>Invalid Phone Number..";
	}
	else{
	$sql_query="SELECT * from user_info WHERE email='$user'";
	$query=mysqli_query($conn,$sql_query);
	if(mysqli_num_rows($query)>0)
	{
	  echo "<h2>You've already booked a slot. We'll get back to you soon. <br>For further queries, write an email to us at <a href='https://mail.google.com/mail/u/0/#inbox' style='color:white;'>helpdesk@selcouthdesigns.in</a>";
	}
	else{
		$query_insert="INSERT INTO user_info(name,email,phone_no,city,purpose,meet_time) VALUES ('$name','$user',$phn,'$city','$purpose','$meet_time')";
		if(!mysqli_query($conn,$query_insert))
		{
		echo "<h2></u>Error</u></h2>";
		echo mysqli_error($conn);
		}
		else
		{
		echo "<h2><u>Success!</u></h2><b><h3>Welcome aboard!</h3><b>You are now registered with us.<br>Our team will get back to you as soon as possible.<br>This may take 2-3 business days!";
		}
	}
	}
	}
	mysqli_close($conn);
?>
</div>
</div>
</body>
<script language='Javascript'>
function OverlayOn() {
  document.getElementById("overlay").style.display = "block";
}

function OverlayOff() {
  document.getElementById("overlay").style.display = "none";
}
</script>
</html>
