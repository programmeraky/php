<html>

<head>
	<title>Form Data</title>
</head>

<body>
	<?php 
		session_start();
			include("connection.php");
			
			if($con->connect_error)
			{
				die("Connection failed:". $con->connect_error);
			}
			else
			{
				echo "Database connected successfully!"."<br>";
			}
			if(isset($_POST['form_submitted']))
			{
				echo "Welcome ". $_POST['name']. "!<br>";
			}
			
			$name = $_POST['name'];
			$email = $_POST['email'];
			$gender = $_POST['gender'];
			$password = $_POST['password'];
		 
		 
			$job_role_id = $_POST['job_role_id'];
			
			$c_date = date("Y/m/d");
			$update = date("Y/m/d h:i:s");
			$interests = $_POST['interest'];
		 		
		 	$query = "INSERT INTO user_details(user_id, user_name, user_email, user_gender, user_password, user_job_role_id, user_create_date, user_update) VALUES('','".$name."','".$email."','".$gender."','".$password."','".$job_role_id."','".$c_date."','".$update."');";
			$qr = mysqli_query($con,$query);
		 	
		 	$user_id = mysqli_insert_id($con);
		
		 	$c = date('Y-m-d h:i:s');
		    if(!empty($user_id)){
				foreach($interests as $intrest)
				{
									
					$insert_user_interest = mysqli_query($con,"INSERT INTO user_interest(user_interest_id, interest_id, user_id, user_interest_create_date, user_interest_update) VALUES('','".$intrest."','".$user_id."','".$c."','".$c."')");
						
					
				}
	
			} 
	

			foreach($_FILES['image']['name'] as $key=>$val)
			{
				$allowTypes = array('jpg','png','jpeg','gif');
				$targetDir = "usersImages/";
				$image = explode(".",$_FILES['image']['name'][$key]);
				$uniqID = uniqid();
				$fileName = $image[0].$uniqID.".".$image[1];
				$thumb_path = "usersImages/usersThumb/";
				$sourceFile = $_FILES['image']['tmp_name'][$key];
				$targetFilePath = $targetDir . $fileName;
				$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
				$thumb_width = 50;
				$thumb_height = 50;
		
				if(in_array($fileType, $allowTypes))
				{
					move_uploaded_file($sourceFile, $targetFilePath);
			
					$thumbnail = $thumb_path.$fileName;
					list($width,$height) = getimagesize($targetFilePath);
					$thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
					switch($fileType)
					{
						case 'jpg':
							$source = imagecreatefromjpeg($targetFilePath);
							break;
						case 'jpeg':
							$source = imagecreatefromjpeg($targetFilePath);
							break;
						case 'png':
							$source = imagecreatefrompng($targetFilePath);
							break;
						case 'gif':
							$source = imagecreatefromgif($targetFilePath);
							break;
						default:
							$source = imagecreatefromjpeg($targetFilePath);
					}
					imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
					switch($fileType)
					{
						case 'jpg' || 'jpeg':
							imagejpeg($thumb_create,$thumbnail,100);
							break;
						case 'png':
							imagepng($thumb_create,$thumbnail,100);
							break;
						case 'gif':
							imagegif($thumb_create,$thumbnail,100);
							break;
						default:
							imagejpeg($thumb_create,$thumbnail,100);
					}
					
					$insert_user_image = mysqli_query($con,"INSERT INTO images(image_id, user_id, image_name, thumb_image_name, image_create_date, image_update) VALUES('','".$user_id."','".$fileName."','".$fileName."','".$c."','".$c."')");
				}

			}
	
	
//	function createThumb(){
//		
//	}
	
//	function createThumbnail($fileName,$fileType,$targetFilePath,$thumb_path) {
//		
//		echo "hii";exit();
//     
//    if($fileType == 'jpg' || $fileType == 'jpeg')
//	{
//        $im = imagecreatefromjpeg($targetFilePath . $fileName);
//    } 
//	else if ($fileType == 'gif') 
//	{
//        $im = imagecreatefromgif($targetFilePath . $fileName);
//    } 
//	else if ($fileType == 'png') 
//	{
//        $im = imagecreatefrompng($targetFilePath . $fileName);
//    }
//     
//    $ox = imagesx($im);
//    $oy = imagesy($im);
//     
//    $nx = 50;
//    $ny = 50;
//     
//    $nm = imagecreatetruecolor($nx, $ny);
//     
//    imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);
//     
//    if(!file_exists($thumb_path)) 
//	{
//      if(!mkdir($thumb_path))
//	  {
//           die("There was a problem. Please try again!");
//      } 
//    }
// 
//    imagejpeg($nm, $thumb_path . $fileName);
//    echo "thumbnail has been created.";
//}
//	
//	exit();
	
//		  function cwUpload($field_name = '', $target_folder = '', $file_name = '', $thumb_folder = '', $thumb_width = '', $thumb_height = '')
//		 {
//			  
//			  
//			  $u = implode(',',$_FILES['image']['name']);
//			  $image = explode(",",$u);
//	
//			  $uniqID = uniqid();
//		
//    			$target_path = $target_folder;
//    			$thumb_path = $thumb_folder;
//			  
//			  $i = $image[0].$uniqID.".".$image[1];
//    
//			  	//file name setup
//			  	$f = implode(',',$_FILES[$field_name]['name']);
//			  	$t = implode(',',$_FILES[$field_name]['tmp_name']);
//    			$filename_err = explode(".",$f);
//    			$filename_err_count = count($filename_err);
//    			$file_ext = $filename_err[$filename_err_count-1];
//    			if($file_name != '')
//				{
//        			$fileName = $file_name.'.'.$file_ext;
//					
//    			}
//			 	else
//				{
//        			$fileName = $i;
//				
//    			}
//    
//    			//upload image path
//    			$upload_image = $target_path.basename($fileName);
//    
//			 	//upload image
//    			if(move_uploaded_file($t,$upload_image))
//    			{
//        			//thumbnail creation
//							$thumbnail = $thumb_path.$fileName;
//							list($width,$height) = getimagesize($upload_image);
//							$thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
//							switch($file_ext)
//							{
//								case 'jpg':
//									$source = imagecreatefromjpeg($upload_image);
//									break;
//								case 'jpeg':
//									$source = imagecreatefromjpeg($upload_image);
//									break;
//
//								case 'png':
//									$source = imagecreatefrompng($upload_image);
//									break;
//								case 'gif':
//									$source = imagecreatefromgif($upload_image);
//									break;
//								default:
//									$source = imagecreatefromjpeg($upload_image);
//							}
//
//					imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
//							switch($file_ext)
//							{
//								case 'jpg' || 'jpeg':
//									imagejpeg($thumb_create,$thumbnail,100);
//									break;
//								case 'png':
//									imagepng($thumb_create,$thumbnail,100);
//									break;
//								case 'gif':
//									imagegif($thumb_create,$thumbnail,100);
//									break;
//								default:
//									imagejpeg($thumb_create,$thumbnail,100);
//								}
//
//
//						return $fileName;
//					}
//    	else
//		{
//			echo "error";
//			return false;
//		}
		header('Location: user_data.php')
		
	?>
</body>

</html>