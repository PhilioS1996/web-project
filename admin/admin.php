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
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
      <script src = https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js></script>
      <script src = "admin_queries.js"></script> 
      <script src = "admin_charts.js"></script> 
  </head>

  <body> 
    <div>
      <h1>Welcome, admin!</h1> 
      
      <div>
        <h2>Basic Information</h2>

        <h3>Total number of registered users:</h3> <h3> <div id = "display1"></div> </h3>
        <input type="button" value="Display" name="button1" id = "button1"><br><br>
        
        <h3>Total number of entries per request method:</h3> <h3> <div id = "display2"></div> </h3>
        <input type="button" value="Display" name="button2" id = "button2"><br><br>

        <h3>Total number of entries per response status:</h3><h3> <div id = "display3"></div> </h3>
        <input type="button" value="Display" name="button3" id = "button3"><br><br>

        <h3>Total number of unique domains:</h3><h3> <div id = "display4"></div> </h3>
        <input type="button" value="Display" name="button4" id = "button4"><br><br>

        <h3>Total number of unique ISPs:</h3><h3> <div id = "display5"></div> </h3>
        <input type="button" value="Display" name="button5" id = "button5"><br><br>

        <h3>Average age of http request per content type:</h3><h3> <div id = "display6"></div> </h3>
        <input type="button" value="Display" name="button6" id = "button6"><br><br>

        <div>
        <a href = "../logout.php"><h3>Log out</h3></a>
      </div>


      <div>
      <canvas id="myChart" width="400" height="400"></canvas>
      </div>
     
  </body>
</html>