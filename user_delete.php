<?php
	include("connection.php");
	$id = $_GET['id'];
	//echo $id;
	
	$qr = "DELETE FROM user_details WHERE user_id= '".$id."'";
	{
		$q = mysqli_query($con,"SELECT image_name,thumb_image_name FROM images where user_id = '".$id."'");
		
		if(mysqli_num_rows($q) > 0)
		{
			while ($res = mysqli_fetch_assoc($q))
			{
//				echo "<pre>";
//				print_r($res);
//				echo "<pre>";
				unlink("usersImages/".$res['image_name']);
				unlink("usersImages/usersThumb/".$res['thumb_image_name']);
				$i = mysqli_query($con,"DELETE FROM images WHERE user_id = '".$id."'");
				
			}
		
		}
	}

		$result = mysqli_query($con,$qr);

		if($con->query($result))
		{
			echo "Item deleted successfully!";
		}
	
	header('Location: user_data.php');
?>