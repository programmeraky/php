<?php

include("connection.php");
	$name= $_POST['emp_name'];
	$email = $_POST['email'];
	$gender = $_POST['gender'];
	$job_role_id = $_POST['job_role_id'];
	$interest = $_POST['interest'];
	$update = date("Y/m/d");
	
	$qr = mysql_query("UPDATE emp_details SET emp_name = '$name', emp_email = '$email', emp_gender = '$gender', emp_job_role_id = '$job_role_id', emp_interest = '$interest', emp_update= '$update' ");
	if($con->query($qr))
	{
		header('Location: emp_data.php');
	}
?>