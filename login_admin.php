<?php

	//Validating connection with database
	$con = mysqli_connect('localhost','root','','web');

	if(!$con)
	{
		$messages['database'] =  'Please check the connection with database.';
    }
	

	//Messages
	$messages = array('empty'=>'', 'mismatch'=>'', 'user_not_found'=>'', "database"=>'' );
	
	//Main functionality
	if (isset($_POST['adminlog-btn']))
	{

		$username = $_POST['username'];
		$password = mysqli_real_escape_string($con, $_POST['password']); 
		
		if (empty($username) || empty($password))
		{
			$messages['empty'] = 'Please fill in the blanks.';
		}
		else
		{
			$query = "SELECT * FROM admins WHERE adminname = '$username'";
			$found_admin = mysqli_query($con,$query);

			if (mysqli_num_rows($found_admin) == 1)
			{
				$row = mysqli_fetch_assoc($found_admin) ;
			
				if ($password == $row['password'])
				{
					header("Location:admin.php");
				}
				else
				{
					$messages['mismatch'] = "Password is incorrect.";
				}
				    
			}
			else
			{
				$messages['user_not_found'] = 'Admin not found.';
			}
			
		}
	}

?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width", initial-scale=1.0>
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <title>HAR WEB Project 2021</title>
</head>

<body>
	<div class="login-form">
		<img src="user.png"/>
		<form action="login_admin.php" method="post">

			<input type="username" placeholder="Username" class="txt" name="username" >
			<input type="password" placeholder="Password" class="txt" name="password">

			<div class="red-text"><?php echo $messages['empty'];?></div>
			<div class="red-text"><?php echo $messages['mismatch'];?></div>
			<div class="red-text"><?php echo $messages['user_not_found'];?></div>
			
			
            <input type="submit" value="Login" class="btn" name="adminlog-btn">
          
        </form>
	</div>
</body>
</html>