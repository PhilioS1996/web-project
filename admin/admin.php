<!DOCTYPE html>
<html lang=en>
 
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script src="admin_queries.js"></script> 
    <script src="admin_charts.js"></script> 
    <title>Admin Menu</title>
  </head>

  <body> 
    
      <h1>Welcome, admin!</h1> 
      
      <div>
        <h2>Basic Information</h2>

        <h3>Total number of registered users: </h3> <div id = "display1"></div> 
        <button id="button1"> Display </button><br>
        
        <h3>Total number of entries per request method: </h3> <div id = "display2"></div> 
        <button id="button2"> Display </button><br>

        <h3>Total number of entries per response status:</h3> <div id = "display3"></div> 
        <button id="button3"> Display </button><br>

        <h3>Total number of unique domains:</h3> <div id = "display4"></div> 
        <button id="button4"> Display </button><br>

        <h3>Total number of unique ISPs:</h3> <div id = "display5"></div>
        <button id="button5"> Display </button><br>

        <h3>Average age of http request per content type:</h3><div id = "display6"></div> 
        <button id="button6"> Display </button><br>

        <a href = "../logout.php"><h3>Log out</h3></a>
      </div>


      <div>
        <canvas id="myChart" width="400" height="400"></canvas>
      </div>
     
  </body>
</html>