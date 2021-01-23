<?php 


  include "../config.php";

  if  ( (isset($_POST['username']) && isset($_POST['newusername'])) ) 
  {
    
    $username = $_POST['username'];
    $newusername = $_POST['newusername'];

    $query = "SELECT * FROM users WHERE Username = '$newusername' ";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0)
    {
        echo -1;
    }
    else
    {
      
      $user_query = "UPDATE users SET Username = '$newusername' WHERE Username = '$username'";
      $result1 = mysqli_query($con, $user_query);

      if ($result1)
      {
        session_start();
        $_SESSION['username'] = $newusername; 
        echo 1;
      }
      else echo 0;   
      
    }  
  }


  if ((isset($_POST['username']) && isset($_POST['oldpassword']) && isset($_POST['newpassword']) && isset($_POST['cpassword'])))
  {

    $username = $_POST['username'];
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];
    $cpassword = $_POST['cpassword'];

    $query = "SELECT Username FROM users WHERE Username = '$username' ";
    $result = mysqli_query($con, $query);
    
    if ($result)
    {
      $uppercase = preg_match('@[A-Z]@', $newpassword);
      $number = preg_match('@[0-9]@', $newpassword);
      $special_chars = preg_match('@[^\w]@', $newpassword);

      if (!$uppercase|| !$number || !$special_chars || strlen($newpassword) < 8)
      {
        echo -1;
      }
      else
      {
        $pass_query = "UPDATE users SET Password = '$newpassword' WHERE Password = '$oldpassword'";   
        $result1 = mysqli_query($con, $pass_query);
               
        if($result1)
        {
          session_start();
          $_SESSION['username'] = $username;
          echo 1;
        }
        else echo 0;
      }
    }
    else
    {
      echo 0;
    }
    
  }
 
?>
