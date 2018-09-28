<?php 
include("connection.php");

if(isset($_POST['delete']))
{
    $empIDs =  $_POST['check'];
	
	for($i=0;$i<count($empIDs);$i++)
	{
		$del_id = $empIDs[$i];
		$qr = "DELETE FROM user_details WHERE user_id= '".$del_id."'";
		$q = mysqli_query($con,"SELECT image_name,thumb_image_name FROM images where user_id = '".$del_id."'");
		while($res = mysqli_fetch_array($q))
		{
			unlink("usersImages/".$res['image_name']);
				unlink("usersImages/usersThumb/".$res['thumb_image_name']);
				$i = mysqli_query($con,"DELETE FROM images WHERE user_id = '".$del_id."'");
		}

		$result = mysqli_query($con,$qr);
	}

	if($con->query($result))
	{
		echo "Item deleted successfully!";
	}
	
	header('Location: user_data.php');
		
	}

	if($result)
	{
		header("Location: user_data.php");
	}

/*
 $ = implode(",", $_POST['check']);

if(!empty($empIDs)){
	
	echo $qry = "DELETE FROM emp_details WHERE emp_id IN ('".$empIDs."')";exit;
	$result = mysqli_query($con,$qry);
	
}*/


?>