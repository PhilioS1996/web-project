<?php

    include "config.php";

    //Main functionality
	if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['cpassword']))
	{
    
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword= $_POST['cpassword'];

        
        $sql_user = "SELECT * FROM users WHERE Username='$username'";
        $res_user = mysqli_query($con, $sql_user);

        if (mysqli_num_rows($res_user) > 0)
        {
            echo -2;
        }
        else
        {

            $uppercase = preg_match('@[A-Z]@', $password);
            $number = preg_match('@[0-9]@', $password);
            $special_chars = preg_match('@[^\w]@', $password);

            if(!$uppercase|| !$number || !$special_chars || strlen($password) < 8) 
            {
                echo -1;
            }
            else
            {
                //$password = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO users (Username, Email, Password) values  ('$username', '$email', '$password')";
                $result = mysqli_query($con, $query);
                if ($result)
                {
                    session_start();
                    $_SESSION['username'] = $username;
                    echo 1;
                    
                }
                else echo 0;
            }
        }  
	}
?>