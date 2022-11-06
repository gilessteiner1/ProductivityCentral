<!DOCTYPE html>
<html lang="en">

  <!-- Head -->
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Giles Steiner">
    <meta name="description" content="Productivity Web Application">
    <title>Productivity Tracker</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css"/>
    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  </head>
  <body>
      <?php session_start(); ?> <!-- Join session. Create session ID -->

      <!-- Remove data from session -->
      <?php
        if(count($_SESSION) > 0){
          foreach($_SESSION as $k => $v){
            unset($_SESSION[$k]); //remove element key-value pair from sesh obj on server side
          }
          session_destroy(); //completely remove the instance (server)
        }
        setcookie("PHPSESSID", "", time()-3600, "/"); //delete cookie on client side
        header("Location: login.php");
       ?>

  </body>
</html>
