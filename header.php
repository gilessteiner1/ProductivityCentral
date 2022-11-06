<!DOCTYPE html>
<html lang="en">

<?php
  require("connect-db.php");
  session_start();
  $cookie_name = "user";
  $cookie_value = $_SESSION['name'];
  setcookie($cookie_name,$cookie_value,time()+3600);
 ?>


  <!-- Head -->
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Giles Steiner">
    <meta name="description" content="Productivity Web Application">
    <title>Productivity Tracker</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="style/homepage.css"/>
    <link rel="stylesheet" href="style/main.css"/>
    <script src="javascript/jscolor.js"></script>
    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


  </head>

  <!-- Body -->
  <body>

    <!-- Navigation Bar + Logout -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand">Welcome, <?php echo $_COOKIE['user']; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse active" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="homepage.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="tasks.php">Tasks <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="http://localhost:4200">Contact <span class="sr-only">(current)</span></a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <a class="btn btn-primary" href="logout.php">Logout</a>
      </form>
    </div>
    </nav>
  </body>
</html>
