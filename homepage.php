<!DOCTYPE html>
<html lang="en">

<?php
  require("header.php");
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


    <!-- Fluid Jumbotron -->
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Productivity Tracker</h1>
        <p class="lead" style="font-style: italic">You can do it!</p>
      </div>
    </div>


    <!-- Change Color (First Row) -->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-2 mx-4">
          <div class="text-center">
            <input type="text" style="width: 70%; align:center; margin-top:40px;" value="Red" class="btn btn-secondary btn-sm btn-light btn-outline-danger" onclick="changeRed()"/>
          </div>
        </div>
        <div class="col-md-2 mx-4">
          <div class="text-center">
            <input type="text" style="width: 70%; align:center; margin-top:40px;" value="Blue" class="btn btn-secondary btn-sm btn-light btn-outline-primary" onclick="changeBlue()"/>
          </div>
        </div>
        <div class="col-md-2 mx-4">
          <div class="text-center">
            <input type="text" style="width: 70%; align:center; margin-top:40px;" value="Green" class="btn btn-secondary btn-sm btn-light btn-outline-success" onclick="changeGreen()"/>
          </div>
        </div>
        <div class="col-md-2 mx-4">
          <div class="text-center">
            <p style="margin-right:30px; white-space: nowrap;"> Change Color Manually: </p>
            <input value="000000FF" id="colorpicker" data-jscolor="{}" onmouseout="changeCP()"> <!-- Color picker from https://jscolor.com/ -->
          </div>
        </div>
      </div>
    </div>
    </br></br></br>


    <!-- Second Row -->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-3 border mx-4">
          <p class="dhead"> Daily Tasks </p>
          <ul class="dtxt">
            <?php printTasks() ?>
          </br>
          </ul>
          <div class="text-center">
            <a href="tasks.php" class="btn btn-secondary btn-sm active" role="button" aria-pressed="true" style="margin-bottom:0px; align:center;">Add more tasks</a>
          </div>
        </br>
        </div>
        <div class="col-md-3 border mx-4">
          <p class="dhead" id="ht"> Daily Events </p>
          <ul id="dailyevents" class="dtxt">
            <li>Class One</li>
            <li>Class Two</li>
            <li>Class Three</li>
          </ul>
        </br></br>
          <div class="text-center">
            <input type="text" style="width: 70%; align:center; margin-left:0px; margin-bottom:20px;" value="Add events" class="btn btn-secondary btn-sm" onclick="addEvents()"/>
          </div>
        </div>
        <div class="col-md-3 border mx-4">
          <p class="dhead"> School </p>
          <ul class="dtxt">
            <li>MAE 2320: 2-3pm</li>
            <li>APMA 3110: 12-2pm </li>
            <li>CS 4640: 3-4pm</li>
            <li>MAE 2320: 6-7am</li>
            <li>MAE 2310: 4-3am</li>
          </ul>
        </div>
      </div>
    </div>
    </br></br></br>

    <?php

      function printTasks(){
        global $db;
        $username = $_SESSION['username'];

        $query = "SELECT * FROM $username WHERE TRUE";
        $statement = $db->prepare($query);
        $statement->execute();
        $row_array = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor(); //let it go
        foreach($row_array as $row){
          echo "<li>" . $row['tasks'] . "</li>";
        }

      }
    ?>



    <!-- Third Row -->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4 border mx-4">
          <p class="dhead"> Medicine </p>
          <ul class="dtxt">
            <li>Last Taken: 2/4/2020</li>
            <li>Next Dose: 2/6/202</li>
            <li>Last Doctor Visit: _____</li>
            <li>Next Doctor Visit: _____</li>
          </ul>
        </div>
        <div class="col-md-4 border mx-4">
          <p class="dhead"> Wellness </p>
            <p class="dtxt">Daily Affirmation:</p>
            <p class="dtxt"> I am the architect of my life; I build its foundation and choose its contents. </p>
        </div>
      </div>
    </div>
    </br></br>
  </br></br></br></br></br>



  <!-- Footer -->
  <?php include('footer.php') ?>

    <!-- Javascript Code -->
    <script>

      //set default zoom to 90%
      document.body.style.zoom="90%";

      //change color of text
      function changeRed(){
        let headers = document.getElementsByClassName("dtxt");
        for(let i = 0; i < headers.length; i++){
          headers[i].style.color = "red";
        }
      }

      function changeBlue(){
        let headers = document.getElementsByClassName("dtxt");
        for(let i = 0; i < headers.length; i++){
          headers[i].style.color = "blue";
        }
      }

      function changeGreen(){
        let headers = document.getElementsByClassName("dtxt");
        for(let i = 0; i < headers.length; i++){
          headers[i].style.color = "green";
        }
      }

      //Manual color picker
      function changeCP(){
        let headers = document.getElementsByClassName("dtxt");
        for(let i = 0; i < headers.length; i++){
          headers[i].style.color = document.getElementById('colorpicker').value;
          headers[i].style.opacity = 1;
        }
      }

      //Arrow function to validate that the user entered a valid non null event
      var valid_input = (user_input) => {
        if(user_input == ""){
          alert("You did not enter an event.")
          return false;
        }
        else{
          return true;
        }
      }

      /* Add events to dashboard through DOM*/
      function addEvents(){
        let event_list = document.getElementById('dailyevents');
        let temp = prompt("Please add a new event:");
        if(valid_input(temp)){
          let new_event = document.createElement('li');
          new_event.appendChild(document.createTextNode(temp));
          event_list.appendChild(new_event);
        }
      }

    </script>

  </body>
</html>
