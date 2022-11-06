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
      <h1 class="display-4">Please Login Below</h1>
    </div>
  </div>

  <!-- Connect to databse-->
  <?php require("connect-db.php") ?>
  <?php session_start(); ?> <!-- Join session. Create session ID -->

  <!-- Username and password form -->
  <div class="container" style="width:70%; align:center">
    <br />
    <!-- Main Form -->
    <form name="userInfo" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
      <table class="table table-borderless" style="align:center">
        <tr>
          <td width="40%" align="right"><label>Username</label></td>
          <td><input type="text" name="username" id="username" class="form-control" value="" placeholder="username"></td>
        </tr>
        <tr>
          <td width="40%" align="right"><label>Password: </label></td>
          <td><input type="password" id="password" name="password" class="form-control" value="" placeholder="password"/>
          </td>
        </tr>
        <!-- Login Submit/Reset Buttons + Form Feedback -->
        <tr>
          <td colspan=2 align="center"><input type="submit" style="align:center; margin-left:270px; width:20%;" name="submitbtn" value="Submit" class="btn btn-secondary btn-md"/>
              &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" style="align:center; left:0px; width:30%;" name="createbtn" value="Click Here To Create Account" class="btn btn-secondary btn-md" /></td>
        </tr>

    </table>
    <input type="hidden" value="signin_option" value="return_user" />
    </form>

    <!-- Handles user pressing on buttons-->
    <?php
      if (isset($_POST['submitbtn']))
      {
         try
         {
           loginUser();
         }
         catch (Exception $e)       // handle any type of exception
         {
            $error_message = $e->getMessage();
            echo "<p>Error message: $error_message </p>";
         }
      }
      if (isset($_POST['createbtn']))
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

    <!-- Adds user to session -->
    <?php
      if(isset($_POST['username'])){
        $_SESSION['username'] = $_POST['username'];
      }

     ?>

     <!-- Log user in -->
    <?php
      function loginUser(){

        $username = $_POST['username'];
        $password = $_POST['password'];

        global $db;


        //check if username exists in db if it does check password if both correct log the user in
        $query = "SELECT * FROM users WHERE username = '$username'";
        $statement = $db->prepare($query);
        $statement->execute();
        $pwd_array = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor(); //let it go
        if($pwd_array && $username != ""  && $password != ""){
          $table_pwd = $pwd_array['password'];
          $_SESSION['name'] = $pwd_array['firstname'];
          if($password == $table_pwd){
            header("Location: homepage.php");
          }
          else{
            echo "<p style='color:red; margin-left:350px;'> Sorry, you entered the wrong password. </p>";
          }
        }
        else{
          echo "<p style='color:red; margin-left:350px;'> Please enter a username and password. </p>";
        }
      }

      function createAccount(){
        header("Location: create-account.php");
      }
    ?>

    </div>


    <!-- Footer -->
    <?php include('footer.php') ?>

    <!-- Javascript -->
    <script>

      //set default zoom to 90%
      document.body.style.zoom="90%";

      //User login function TODO: Convert help message DOM to php
      /*
      function login(){

          user = document.getElementById('username').value.toUpperCase();
          pass = document.getElementById('password').value.toUpperCase();

          user === "" && pass === ""

          if(user === "" && pass ===""){
            document.getElementById('HelpMessage').textContent = 'Please enter a username and a password.';
          }
          else if (user === "") {
            document.getElementById('HelpMessage').textContent = 'Please enter a username.';
          }
          else if(pass === ""){
            document.getElementById('HelpMessage').textContent = 'Please enter a password.';
          }
          else{
        }
      }
      */
  </script>


  </body>
</html>
