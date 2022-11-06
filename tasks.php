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
    <link rel="stylesheet" href="style/tasks.css"/>
    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!--  jQuery -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

  <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
  <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

  <!-- Bootstrap Date-Picker Plugin -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>


  </head>


  <!-- Body -->
  <body>

      <?php require("header.php") ?>


    <!-- Fluid Jumbotron -->
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Tasks</h1>
        <p class="lead">Things to work on.</p>
      </div>
    </div>
    </br>

    <!--
    <div class="container">


      <form name="mainform" >

        <div class="form-group">
          <label for="taskdesc">Task Description</label>
          <input type="text" id="taskdesc" class="form-control" name="desc" placeholder="Please enter a task description"/>
          <span class="error" id="taskdesc-note"></span>
        </div>



        <div class="bootstrap-iso">

            <form method="">
              <div class="form-group">
                <label class="control-label" style="font-weight:normal; font-size:14px;" for="duedate">Date</label>
                <input class="form-control" id="duedate" name="duedate" placeholder="MM/DD/YYY" type="text"/>
              </div>
             </form>
        </div>
        <div class="form-group">
          <label for="schoolclass">Class</label>
          <select id="schoolclass" class="form-control" placeholder="Please enter a due date">
            <option value='MAE 2320'>MAE 2320</option>
            <option value='APMA 3110'>APMA 3110</option>
            <option value='CS 4640'>CS 4640</option>
            <option value='MAE 2310'>MAE 2310</option>
            <option value='MAE 2330'>MAE 2330</option>
          </select>
        </div>
      </form>

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <input type="submit" style="" class="btn btn-light" name="addtaskbtn" id="add" value="Add Task"/>
            </div>
          </div>
        </div>
      </form>




      <br/>

      <!-- Tasks Table -->
      <!--
      <div id="todo">
        <table id="todoTable" class="table table-light table-bordered table-striped table-hover table-sm" style="width:70%" cellspacing="0" width="100%" >
          <thead class="thead-dark">
            <tr>
              <th>Task Description</th>
              <th>Due Date</th>
              <th>Class</th>
              <th>(Remove)</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>

  </div>
    -->

     <!-- Add new task here -->
     <form action="<?php $_SERVER['PHP_SELF']?>" method="">
       <div class="container">
         <div class="row">
           <div class="col-md-4">
             <input type="text" name="tasks" id="tasks" class="form-control" value="" placeholder="Enter A Task">
           </div>
           <div class="col-md-4">
             <input type="text" name="date" id="date" class="form-control" value="" placeholder="Due Date">
           </div>
           <div class="col-md-4">
             <input type="text" name="delete" id="date" class="form-control" value="" placeholder="Delete Task">
           </div>
         </div>
       </br>
         <div class="row">
           <div class="col-md-4">
             <input type="submit" style="" class="btn btn-light" name="addtaskbtn" id="add" value="Add New Task"/>
           </div>
           <div class="col-md-4">
             <input type="submit" style="margin-left:380px" class="btn btn-light" name="deletetaskbtn" id="add" value="Delete a Task"/>
           </div>
         </div>
       </div>
     </form>
   </br>

     <!-- Add task to sql table -->
     <?php
         if (isset($_GET['addtaskbtn'])){ //add task to sql
           $username = $_SESSION['username'];
           global $db;

           $query = "INSERT INTO $username(tasks,calendar) VALUES (:tasks,:calendar)";
           $statement = $db->prepare($query); //transfers into executable version
           $statement->bindValue(':tasks',$_GET['tasks']);
           $statement->bindValue(':calendar',$_GET['date']);
           $statement->execute();
           $statement->closeCursor(); //let it go
         }
         else{
         }
      ?>

      <!-- Print tasks from sql table -->
      <?php
            global $db;
            $username = $_SESSION['username'];

            $query = "SELECT * FROM $username WHERE TRUE";
            $statement = $db->prepare($query);
            $statement->execute();
            $row_array = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement->closeCursor(); //let it go

            echo "<table class='table'> <thead>";
            echo "<tr>
              <th>Task</th>
              <th>Due Date</th>
            </tr></thead><tbody>";
            foreach($row_array as $row){
              echo "<tr><td>" . $row['tasks'] . "</td><td>" .  $row['calendar'] .  "</td></tr>";
            }

            echo "</tbody></table>";

          //cross off task if finished

        ?>

        <!-- Delete a task -->
        <?php

          if(isset($_GET['deletetaskbtn'])){
            global $db;
            $username = $_SESSION['username'];
            $delete = $_GET['delete'];

            $query = "DELETE FROM $username WHERE tasks = '$delete'";
            $statement = $db->prepare($query);
            $statement->execute();
            $statement->closeCursor(); //let it go
          }
         ?>

         <!-- Footer -->
         <?php include('footer.php') ?>

         <script>
           //set default zoom to 90%
           document.body.style.zoom="90%";
         </script>


    </body>
</html>
