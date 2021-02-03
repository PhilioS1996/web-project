<?php

  include "../config.php";

  session_start();

  //To bring username in HTML 
  if (isset($_SESSION['username']))
  {
    $username = $_SESSION['username'];
  }
  else
  {
    header("Location:../index.html");
  }

?>


<!DOCTYPE html>
<html lang=en>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script src="user_queries.js"></script>
    <script src="change_cred.js"></script>
    <title>User Menu</title>
    <style>
    .nameVariable{
      padding: 8px;
      color: rgb(17, 65, 61);
    } 
    .firstBox{
      padding: 20px;
      border: 15px solid green;
    }
    </style>
  </head>

  <body>
    <div>

      <h1 align="left">Welcome <span class="nameVariable"> <?php echo $username ?> </span></h1> </div>
      
      <div>
        <div class="firstBox">
        <h2 >Upload data</h2>
        <h3>Please select a .har file:</h3>
        <input type="file" id="myfiles" multiple/>
        <button id = "upload-btn">Upload</button><br><br>
        <div id="message"></div>

        <h3>Would you like to download the updated .json or upload it on the server?</h3>
        <button id="download">Download</button> 
        <button id="upload" >Upload to server</button><br><br>
        <div id="server"></div>
        </div>

        <h3>Your last HAR upload was on: </h3> <div id="display1"></div>
        <button id="btn1">Display</button><br><br>

        <h3>Total files uploaded: </h3> <div id="display2"></div>
        <button id="btn2">Display</button><br><br>
      </div>
 
      
      <div>
        <h2>Change Credentials</h2>
        <h3>Change your username</h3>

        <input type="text" placeholder="Username" id="username"><br>
        <input type="text" placeholder="New Username" id="newusername"><br>
        <div id="user-message"></div>

        <button id="usr-sbt">Submit</button><br>
        
        <h3>Change your password</h3>
        <input type="text" placeholder="Username" id="username1"><br>
        <input type="password" placeholder="Old Password" id="oldpassword"><br>
        <input type="password" placeholder="New Password" id="newpassword"><br>
        <input type="password" placeholder="Confirm Password" id="cpassword"><br>
        <div id="pass-message"></div>
  
        <button id="pass-sbt">Submit</button>
      </div>

      <a href = "../logout.php"><h3>Log out</h3></a>
  </body>
</html>