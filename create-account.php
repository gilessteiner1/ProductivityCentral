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

    <!-- Focus -->
     <script type="text/javascript">
      function setFocus(){
        document.userInfo.username.focus();
      }
     </script>
  </head>

  <!-- Body -->
  <body onload="setFocus()">

    <!-- Fluid Jumbotron -->
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">Please Create an Account Below</h1>
    </div>
  </div>


  <!-- Connect to databse-->
  <?php require("connect-db.php") ?>

  <!-- Username and password form -->
  <div class="container" style="width:70%; align:center">
    <br />
    <!-- Main Form -->
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
      <table class="table table-borderless" style="align:center">
        <tr>
          <td width="40%" align="right"><label>Email Address: </label></td>
          <td><input type="text" name="email" id="email" class="form-control" value="" placeholder="Email Address"></td>
        </tr>
        <tr>
          <td width="40%" align="right"><label>First Name: </label></td>
          <td><input type="text" name="firstname" id="firstname" class="form-control" value="" placeholder="First Name"></td>
        </tr>
        <tr>
          <td width="40%" align="right"><label>Last Name: </label></td>
          <td><input type="text" name="lastname" id="name" class="form-control" value="" placeholder="Last Name"></td>
        </tr>
        <tr>
          <td width="40%" align="right"><label>Username: </label></td>
          <td><input type="text" name="username" id="username" class="form-control" value="" placeholder="username"></td>
        </tr>
        <tr>
          <td width="40%" align="right"><label>Password: </label></td>
          <td><input type="password" id="password" name="password" class="form-control" value="" placeholder="password"/>
          </td>
        </tr>
        <!-- Login Submit/Reset Buttons + Form Feedback -->
        <tr>
          <td colspan=2 align="center"><input type="submit" style="align:center; margin-right:50px; min-width:12%;" name="btnaction" value="Submit" class="btn btn-secondary btn-md" onclick="createAccount()"/>
          </td>
        </tr>
        <tr>
        </tr>
    </table>
    <input type="hidden" value="signin_option" value="return_user" />
    </form>

    <?php
    if (isset($_POST['btnaction']))
    {
       try
       {
         createAccount();
       }
       catch (Exception $e)       // handle any type of exception
       {
          $error_message = $e->getMessage();
          echo "<p>Error message: $error_message </p>";
       }
    }
    ?>



    <?php

        //SQL to create account Database TODO - hash
        function createAccount(){
          //pull user info from form
          $email_add = $_POST['email'];
          $first_name = $_POST['firstname'];
          $last_name = $_POST['lastname'];
          $username = $_POST['username'];
          $password = $_POST['password'];

          if($email_add && $first_name && $last_name && $username && $password){

              global $db;
              //Create New Account
              $query = "INSERT INTO users(email,firstname,lastname,username,password) VALUES (:email,:firstname,:lastname,:username,:password)";
              $statement = $db->prepare($query); //transfers into executable version
              $statement->bindValue(':email',$email_add);
              $statement->bindValue(':firstname',$first_name);
              $statement->bindValue(':lastname',$last_name);
              $statement->bindValue(':username',$username);
              $statement->bindValue(':password',$password);
              $statement->execute();
              $statement->closeCursor(); //let it go

              //create table to store user data
              $query = "CREATE TABLE $username(tasks VARCHAR(255),calendar VARCHAR(255) NOT NULL)";
              $statement = $db->prepare($query); //transfers into executable version
              $statement->execute();
              $statement->closeCursor(); //let it go
              header("Location: login.php");
          }
          else{
            echo "<p style='color:red; margin-left:350px;'> Please fill out the required fields. </p>";
          }


        }
      ?>

    </div>

    <!-- Footer -->
    <?php include('footer.php') ?>

    <!-- Javascript -->
    <script>

      //set default zoom to 90%
      document.body.style.zoom="90%";


  </script>


  </body>
</html>
