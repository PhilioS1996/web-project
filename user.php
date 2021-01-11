<?php

  //Validating connection with database
  $con = mysqli_connect('localhost','root','','web');

  if(!$con)
  {
    $messages['database'] =  'Please check the connection with database.';
  }



//-------------SHOW STATISTICS-----------------
if (isset($_POST['stat-btn']))
{

}

//--------------------LOG OUT----------------------
if (isset($_POST['logout-btn']))
{
    session_start();  
    session_destroy();  
    header("location:index.html?action=login");  
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
   
    <h2>User Menu</h2>
    <div class="topnav">
   
      
      <form action="upload.php" method="post">
        <input type="submit" value="Upload data" class="btn" name="upload-btn">
      </form>
      <form action="change_cred.php" method="post">
        <input type="submit" value="Change credentials" class="btn" name="change-btn">
      </form>
      <form action="user.php" method="post">
        <input type="submit" value="Show statistics" class="btn" name="stat-btn">
      </form>
      <form action="user.php" method="post">
        <input type="submit" value="Log out" class="btn" name="logout-btn">
      </form>
      
      

</form>

</div>
</body>
</html>