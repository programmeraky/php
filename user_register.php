<?php 
	include("connection.php");
?>
<html>
	<head>
		<title>Form</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type= text/javascript>
			$(document).ready(function() {
				
			$('#form1').submit(function(e) 
			{
//				e.preventDefault();
				var name= $('#name').val();
				var em= $('#email').val();
				var gen= document.getElementsByName("gender");
//				//var female= $('#female').val();
				var password= $('#password').val();
				var con_password= $('#con_password').val();
				
				/*var marketing= $('#marketing').val();
//				var designing= $('#designing').val();
//				var development= $('#development').val();
//				var business= $('#business').val();*/
					

				if (name.length < 1 || name == null)
				{
      				alert("Please enter your name!");
					return false;
    			}
				
				if(name.length > 1)
				{
					if(!/^[a-zA-Z\s]+$/.test(name))
					{
						alert("Please enter alphabets only!");
						return false;
					}
				}
				
				if (em.length < 1 || em == null)
				{
					alert("Please enter your email!");
					return false;
				}
				
				if(em.length > 1)
				{
					if((em.search('@')>=0)&&(em.search(/\./)>=0) && em.search('@')<em.split('@')[1].search(/\./)+em.search('@'))
					{
						//
					}
					else 
						{
							alert("Please enter correct email address!");
							return false;	
						}
					
				}
//				
				if($('input[name=gender]:checked').length<=0)
				{
					alert("Please select your gender!");
					return false;
				}
				
				if (password.length < 1 || password == null)
				{
					alert("Please enter your password!");
					return false;
				}
				
				if (password.length < 6)
				{
					alert("Password must be longer than 6 characters!");
					return false;
				}
				
				if (con_password < 1 || con_password == null)
				{
					alert("Please enter confirm password to verify!");
					return false;
				}
								
				if(password != con_password)
				{
					alert ("Password mismatched! Password and Confirm Password must be same!");
					return false;
				}
				
//				var cat = $('#select option:selected').val();   
//				
//    			if (cat == $('#select option:Front End Developer').val()) 
//				{
//            		alert('Please make a selection of any one job role!');
//            		return false;
//   				}
//				else return true;
				
				/*var role = document.getElementsByClassName( 'role' );
				alert();
				var isSelected = false;
    			for (var i = 0; i < role.length; i++) 
				{
        			if ( role[i].checked ) 
					{
						isSelected = true;
					}
    			}
    				if ( isSelected ) 
					{
						//
					}
					else
					{
        				alert( 'Please select at least one job role!' );
						return false;
        			}	
				
				*/
//				 if($("#image").val() == '')
//				 {
//					  alert("Please select your image file to upload!");
//					 return false;
//				 }
//				 
				 var what = document.forms["form1"]["job_role_id"];
				 if (what.selectedIndex < 1)                 
				 {
        			alert("Please enter your job role!");
        			what.focus();
        			return false;
    			 }
				
				var checkBoxes = document.getElementsByClassName( 'test' );
				
				var isChecked = false;
    			for (var i = 0; i < checkBoxes.length; i++) 
				{
        			if ( checkBoxes[i].checked ) 
					{
						isChecked = true;
					}
    			}
    				if ( isChecked ) 
					{
        				//alert( 'At least one checkbox checked!' );
					}
					else 
					{
						alert( 'Please check at least one checkbox!' );
						return false;
        			}	
				
			});
				});
		</script>
	</head>
		<body>
		<center><h1 style="color:blue;margin-left:30px;">SIGN UP HERE!</h1></center>
			<center><a href = "user_data.php">View</a></center><br>
		<form name= "form1" id = "form1" action = "user_register_process.php" method = "POST" enctype="multipart/form-data">
			<table height = "30" width = 30% border = "3" align = "center">
				<tr>
					<td width= "20%">Name:</td>
					<td><input type = "text" name= "name" id = "name" placeholder = "name"></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><input type = "text" name= "email" id = "email" placeholder = "email"></td>
				</tr>
				<tr>
					<td>Gender:</td>
					<td>
						<input type = "radio" name= "gender" id = "male" value= "Male" checked="checked">Male
						<input type = "radio" name = "gender" id = "female" value= "Female">Female
					</td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type = "password" name= "password" id = "password" placeholder = "password"></td>
				</tr>
				<tr>
					<td>Confirm Password:</td>
					<td><input type = "password" name= "con_password" id = "con_password" placeholder = "confirm password"></td>
				</tr>
				<tr>
					<td>Image:</td>
					<td><input type = "file" name = "image[]" multiple= "multiple" id = "image" placeholder = "(Please select your image)"></td>
				</tr>
				<tr>
					<td>Job Role:</td>
					<td>
					<?php
					$result = mysqli_query($con,"SELECT * FROM user_job_role");
					if(mysqli_num_rows($result)>0)
					{
						
					?>
						<select name = "job_role_id" class= 'role' id= "job_role_id">
							<option value="">-- Select Role --</option>
						<?php while($jobRoles = mysqli_fetch_array($result))
						{
						?>
							<option value = "<?php echo $jobRoles['user_job_role_id']?>"><?php echo $jobRoles['user_field_name'];?></option>			
				<?php   } 
					}	?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Interests:</td>
					<td>
					<?php 
					$empInterest = mysqli_query($con,"SELECT * FROM interest");
					
					 while($interest = mysqli_fetch_array($empInterest))
						{
						 ?>
							<input type = "checkbox" class= "test" name= "interest[]" id = "<?php echo $interest['interest_id'];?>" value= "<?php echo $interest['interest_id'];?>"><?php echo $interest['interest_name'];?><br>
						<?php
					 } 
					 ?>
						</td>
				</tr>
					<td><input type = "hidden" name= "form_submitted" value = "1"></td>
				<tr>
					<td colspan = "2"><center><input type = "submit" name= "signup" value = "Sign Up" id= "signup"></center></td>
				</tr>
			</table>
		</form>
	</body>
</html>