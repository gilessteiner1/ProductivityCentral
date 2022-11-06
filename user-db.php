<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />

  <title>PHP and MySQL database</title>
</head>
<body>

  <!--

  <div class="container">
    <h1>PHP and MySQL database</h1>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
      <input type="submit" name="btnaction" value="create" class="btn btn-light" />
      <input type="submit" name="btnaction" value="insert" class="btn btn-light" />
      <input type="submit" name="btnaction" value="select" class="btn btn-light" />
      <input type="submit" name="btnaction" value="update" class="btn btn-light" />
      <input type="submit" name="btnaction" value="delete" class="btn btn-light" />
      <input type="submit" name="btnaction" value="drop" class="btn btn-light" />
    </form>
  </div>

-->

  <h1>PHP and MySQL database</h1>

  <?php require('connect-db.php'); ?> <!-- Connect to sql database -->
  <p1> Please enter username and password:</p1>
  <form name="createAccount" action="user-db.php" >
    <input type="text" name="username" id="username" class="form-control" value="" placeholder="username">
    <input type="text" name="password" id="password" class="form-control" value="" placeholder="password">
    <input type="button" style="align:center; margin-left:40px; min-width:12%;" value="Submit" class="btn btn-secondary btn-md" onclick="createAccount()"/>
  </form>

  <script>

    function createAccount(){
      alert("asd");
      //alert(document.getElementById('username').textContent);
    }


  </script>



</body>
</html>
