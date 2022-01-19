<?php
session_start();

if(isset($_SESSION["loggedin"])){
    header("location: homepage.html");
    exit;
}
require_once "config.php";

	$name=$_POST['uname'];
	$user=$_POST['email'];
    $phn=$_POST['phno'];
	$city=$_POST['city'];
	$purpose=$_POST['purpose'];
	$meet_time=$_POST['time'];
	$user_err=$empty_err=$invalid_email='';
	if(empty($user)||empty($name)||empty($phn)||empty($city)||empty($purpose)||empty($meet_time)){
		$empty_err="Please enter all the details carefully";
	}
	elseif (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
       $invalid_email = "Invalid email format";
    }
	else{
	$sql_query="SELECT * from user_info WHERE email='$user'";
	$query=mysqli_query($conn,$sql_query);
	if(mysqli_num_rows($query)>0)
	{
	  alert_message("You've already booked a slot. We'll get back to you soon. For further queries, write an email to us.");
	}
	else{
		$query_insert="INSERT INTO user_info(name,email,phone_no,city,purpose,meet_time) VALUES ('$name','$user',$phn,'$city','$purpose','$meet_time')";
		if(!mysqli_query($conn,$query_insert))
		echo mysqli_error($conn);
		else
		{
		alert_message("You are now registered with us. Welcome aboard! Our team will get back to you as soon as possible. This may take 2-3 business days!");
		}
	}
	}
	
	if(!empty($empty_err)){
		alert_message($empty_err);
	}
	elseif(!empty($invalid_email)){
		alert_message($invalid_email);
	}
	elseif(!empty($user_err)){
		alert_message($user_err);
	}
	
	mysqli_close($conn);
	
	function alert_message($mssg)
	{
		echo "<script> alert('$mssg'); </script>";
	}
?>