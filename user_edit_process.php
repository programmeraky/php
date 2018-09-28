<?php

include( "connection.php" );
if ( isset( $_POST[ 'id' ] ) ) 
{
	$id = $_POST[ 'id' ];
	$name = $_POST[ 'name' ];
	$email = $_POST[ 'email' ];
	$gender = $_POST[ 'gender' ];
	$job_role_id = $_POST[ 'job_role_id' ];

	//$interest = implode(',', $checksub);	

	$update = date( "Y/m/d h:i:s" );

	//	$uploadedfile = $_FILES['image']['tmp_name'];
	//	$upload = $_FILES['image']['name'];
	//	echo "<pre>";
	//	print_r($upload);
	//	echo "</pre>";
	//	exit();
	////	
	//	 foreach($_FILES['image']['name'] as $key=>$val)
	//		{
	//		 	$upload = $_FILES['image']['name'][$key];
	//		 $uniqID = uniqid();
	//		 $fileName = $upload[0].$uniqID.".".$upload[1];
	//		echo "<pre>";
	//		print_r($fileName);
	//		echo "</pre>";
	//	 }
	//exit();
	
		$qry = mysqli_query( $con, "SELECT image_name, thumb_image_name FROM images WHERE user_id = '" . $id . "'" );
		while ( $q = mysqli_fetch_array( $qry ) )
		{
			unlink( "usersImages/" . $q[ 'image_name' ] );
			unlink( "usersImages/usersThumb/" . $q[ 'thumb_image_name' ] );

		}
		$qr1 = mysqli_query( $con, "DELETE FROM images WHERE user_id = '" . $id . "'" );
	
		foreach ( $_FILES[ 'image' ][ 'name' ] as $key => $val ) 
		{
			$allowTypes = array( 'jpg', 'png', 'jpeg', 'gif' );
			$targetDir = "usersImages/";
			$image = explode( ".", $_FILES[ 'image' ][ 'name' ][ $key ] );
			$uniqID = uniqid();
			$fileName = $image[ 0 ] . $uniqID . "." . $image[ 1 ];
			$thumb_path = "usersImages/usersThumb/";
			$sourceFile = $_FILES[ 'image' ][ 'tmp_name' ][ $key ];
			$targetFilePath = $targetDir . $fileName;
			$fileType = pathinfo( $targetFilePath, PATHINFO_EXTENSION );
			$thumb_width = 50;
			$thumb_height = 50;

			if ( in_array( $fileType, $allowTypes ) )
			{
				move_uploaded_file( $sourceFile, $targetFilePath );

				$thumbnail = $thumb_path . $fileName;
				list( $width, $height ) = getimagesize( $targetFilePath );
				$thumb_create = imagecreatetruecolor( $thumb_width, $thumb_height );
				switch ( $fileType )
				{
					case 'jpg':
						$source = imagecreatefromjpeg( $targetFilePath );
						break;
					case 'jpeg':
						$source = imagecreatefromjpeg( $targetFilePath );
						break;
					case 'png':
						$source = imagecreatefrompng( $targetFilePath );
						break;
					case 'gif':
						$source = imagecreatefromgif( $targetFilePath );
						break;
					default:
						$source = imagecreatefromjpeg( $targetFilePath );
				}
				imagecopyresized( $thumb_create, $source, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height );
				switch ( $fileType )
				{
					case 'jpg' || 'jpeg':
						imagejpeg( $thumb_create, $thumbnail, 100 );
						break;
					case 'png':
						imagepng( $thumb_create, $thumbnail, 100 );
						break;
					case 'gif':
						imagegif( $thumb_create, $thumbnail, 100 );
						break;
					default:
						imagejpeg( $thumb_create, $thumbnail, 100 );
				}

			}
			$query = "INSERT into images(image_id,user_id,image_name,thumb_image_name,image_create_date,image_update) VALUES ('','" . $id . "','" . $fileName . "','" . $fileName . "','" . $update . "','" . $update . "')";
			$insert = mysqli_query( $con, $query );

		}

	$qr = "UPDATE user_details SET user_name = '" . $name . "', user_email = '" . $email . "', user_gender = '" . $gender . "', user_job_role_id = '" . $job_role_id . "', user_update= '" . $update . "' where user_id = '" . $id . "' ";

	$qry = mysqli_query( $con, $qr );
	//print_r($_POST['interest']);
	//exit();	
	if ( !empty( $_POST[ 'interest' ] ) ) {
		//		$id = mysqli_fetch_array($qr);
		//$interest = implode (',',);

		$interests = $_POST[ 'interest' ];

		$q = "DELETE FROM user_interest WHERE user_id = '" . $id . "'";
		//exit();
		$emp_delete_qry = mysqli_query( $con, $q );

		foreach ( $interests as $interest ) {
			$query = mysqli_query( $con, "INSERT into user_interest(user_interest_id,interest_id,user_id,user_interest_create_date,user_interest_update) VALUES ('','" . $interest . "','" . $id . "','" . $update . "','" . $update . "')" );

		}

		//print_r($r['emp_id']);
		//exit();
		if ( !$query ) {
			//
		} else {
			header( 'Location: user_data.php' );
		}

	}

}
?>