<?php

  include "../config.php";

  session_start();


  if (isset($_SESSION['username']))
  {
    //Global
    $username = $_SESSION['username'];
  }
?>

<!DOCTYPE html>
<html>
  <style>
    body 
    {
      margin: 0px;
      padding: 0px;
      background: url("../background.jpg") no-repeat;
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
    <div>
      <h1>Welcome <?php echo $username ?> !</h1> 
      

      <div id="upload-form">
        <h2>Upload data</h2>
        <h3>Please select a .har file:</h3>
        <input type="file" id="myfiles" multiple/>
        <button id = "upload-btn">Upload</button><br><br>
        <div id = "message"></div>

        <h3>Would you like to download the updated .json or upload it on the server?</h3>
        <button id="download">Download</button> 
        <button id="upload" >Upload to server</button><br><br>
        <div id = "server"></div>
      </div>
    </div>
    <!-- jQuery--> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script src = "user_queries.js"></script> 
    
    <div>
      <h2>Change Credentials</h2>
      <h3>Change your username</h3>

      <input type="username" placeholder="Username" name="username" id = "username"><br>
      <input type="newusername" placeholder="New Username" name="newusername" id = "newusername"><br>
      <input type="submit" value="Submit Username" name="usr_submit" id = "usr_submit"><br><br>
      <div id = "user"></div><br><br>
      
      <h3>Change your password</h3>
      <input type="username" placeholder="Username" name="username1" id = "username1"><br>
      <input type="password" placeholder="Old Password" name="oldpassword" id = "oldpassword"><br>
      <input type="password" placeholder="New Password" name="newpassword" id = "newpassword"><br>
      <input type="password" placeholder="Confirm Password" name="password" id = "cpassword"><br>
  
      <input type="submit" value="Submit Password" name="pass_submit" id = "pass_submit"><br><br>
      <div id = "password"></div>
      
    </div>
    <script src="change_pass.js"></script>

    <div>
      <h2>Your last HAR upload was on: </h2> <input type="button" value="Show" name="last_button" id = "last_button"><br><br>
      <div id = "show_lastupdated"></div>

      <h2>Total files uploaded: </h2> <input type="button" value="Show" name="total_button" id = "total_button"><br><br>
      <div id = "show_total"></div>

      <a href = "../logout.php"><h3>Log out</h3></a>
      
    </div>


  </body>
</html>