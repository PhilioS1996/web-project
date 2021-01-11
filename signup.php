<?php

    //Validating connection with database
    $con = mysqli_connect('localhost','root','','web');

    if(!$con)
    {
      $messages['database'] =  'Please check the connection with database.';
    }

    //Messages
    $messages = array('empty'=>'', 'mismatch'=>'', 'weak_pass'=>'', 'user_taken'=>'', "database"=>'' );

    //Main functionality
	if (isset($_POST['reg-btn']))
	{
    
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword= $_POST['cpassword'];

        if (empty($username) || empty($email) || empty($password) || empty($cpassword))
        {
            $messages['empty'] ='Please fill in the blanks.';
        }
        elseif ($password!=$cpassword)
        {
            $messages['mismatch'] = "Passwords do not match.";
        }
        else 
        {
            
            $uppercase = preg_match('@[A-Z]@', $password);
            $number = preg_match('@[0-9]@', $password);
            $special_chars = preg_match('@[^\w]@', $password);

            $sql_user = "SELECT * FROM users WHERE Username='$username'";
            $res_user = mysqli_query($con, $sql_user);

            if (mysqli_num_rows($res_user) > 0)
            {
                $messages['user_taken'] = 'Username already taken.';
            }
            elseif(!$uppercase|| !$number || !$special_chars || strlen($password) < 8) 
            {
                $messages['weak_pass'] = 'Password should be at least 8 characters, contain an uppercase, a number and a special character.';
            }
            else
            {
                //$password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (Username, Email, Password) values  ('$username', '$email', '$password')";
                $result = mysqli_query($con, $sql);
                if ($result)
                {
                    header("location:user.php");
                }
                
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
   
    <div class="signup-form">
        <img src="user.png">
        <form action="signup.php" method="post">

            <input type="username" placeholder="Username" class="txt" name="username" >
            <div class="red-text"><?php echo $messages['empty'];?></div>
            <input type="email" placeholder="Email" class="txt" name="email">
            <div class="red-text"><?php echo $messages['empty'];?></div>
            <input type="password" placeholder="Password" class="txt" name="password">
            <div class="red-text"><?php echo $messages['empty'];?></div>
            <input type="password" placeholder="Confirm Password" class="txt" name="cpassword">
            
           
            <div class="red-text"><?php echo $messages['database'];?></div>
            <div class="red-text"><?php echo $messages['empty'];?></div>
            <div class="red-text"><?php echo $messages['mismatch'];?></div>
            <div class="red-text"><?php echo $messages['weak_pass'];?></div>
            <div class="red-text"><?php echo $messages['user_taken'];?></div>
            
            <input type="submit" value="Register" class="btn" name="reg-btn">
            
          
        </form>
    </div>

 
</body>
</html>