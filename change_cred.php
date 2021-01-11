<?php 
  //Validating connection with database
  $con = mysqli_connect('localhost','root','','web');

  if(!$con)
  {
    $messages['database'] =  'Please check the connection with database.';
  }

  //Messages
    $messages = array('success'=>'', 'error'=>'');

  if (isset($_POST['submit-btn']))
  {
    $username = $_POST['username'];
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];
    $cpassword = $_POST['cpassword'];

    $sql_pass = "SELECT Username, Password FROM users WHERE Username = '$username' AND Password = '$oldpassword' ";
    $query = mysqli_query($con, $sql_pass);

    $result = mysqli_fetch_array ($query);
    
    if (empty($username) || empty($oldpassword) || empty($newpassword) || empty($cpassword))
    {
            $messages['empty'] ='Please fill in the blanks.';
    }
    if ($result>1)
    {
        $uppercase = preg_match('@[A-Z]@', $newpassword);
        $number = preg_match('@[0-9]@', $newpassword);
        $special_chars = preg_match('@[^\w]@', $newpassword);

        if (!$uppercase|| !$number || !$special_chars || strlen($password) < 8)
        {
            $messages['weak_pass'] = 'Password should be at least 8 characters, contain an uppercase, a number and a special character.';
        }
        else
        {
            $update = "UPDATE users SET Password = '$newpassword' WHERE Username = '$username'";
            $conn = mysqli_query($con, $update);
            $messages['success'] = 'Your Password has been succefully updated.'; 
        }
    }
    else
    {
        $messages['error'] = 'Wrong password.';
    }

    
  }


?>


<!DOCTYPE html>
<html>
<style>
  body 
  {
    margin: 0px;
    padding: 0px;
    background: url("background.jpg") no-repeat;
    background-size: cover;
    font-family: 'Ubuntu', sans-serif;
    font-size: 14px; 
  }
</style>
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width", initial-scale=1.0>
      <meta http-equiv="X-UA-Compatible" content="ie-edge">
      <link rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
      <title>HAR WEB Project 2021</title>
  </head>

  <body>
   
    <h2>Change credentials</h2>
    <div class="topnav">
   
    <form action='change_cred.php' method='POST'>
        <input type="username" placeholder="Username" class="txt" name="username"><br>
        <input type="oldpassword" placeholder="Old password" class="txt" name="oldpassword"><br>
        <input type="newpassword" placeholder="New password" class="txt" name= "newpassword"><br>
        <input type="cpassword" placeholder="Confirm password" class="txt" name= "cpassword"><br><br>

        <input type="submit" value="Change password" class="btn" name="submit-btn">
    </form>
      
    
      
      

</form>

</div>
</body>
</html>