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
    <link rel="stylesheet" href="style/contact.css"/>
    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </head>

  <!-- Body -->
  <body>

    <?php require("header.php") ?>

    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Contact Me</h1>
        <p class="lead">Id be happy to help.</p>
      </div>
    </div>

    </br>



    <form class="needs-validation" novalidate>
      <div class="form-row">
        <div class="col-md-5 mb-3 mx-4">
          <label for="validationTooltip01" style="margin-left:20px;">First name</label>
          <input type="text" class="form-control" id="firstname" placeholder="Please enter your first name" value="" required style="margin-left:20px;">
          <div class="valid-tooltip">
            Looks good!
          </div>
        </div>
        <div class="col-md-5 mb-3 mx-4">
          <label for="validationTooltip02">Last name</label>
          <input type="text" class="form-control" id="lastname" placeholder="Please enter your last name" required>
          <div class="valid-tooltip">
            Looks good!
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-5 mb-3 mx-4">
          <label for="validationTooltipUsername" style="margin-left:20px;">Username</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="margin-left:20px;" id="validationTooltipUsernamePrepend">@</span>
            </div>
            <input type="text" class="form-control" id="username" placeholder="Please enter your username" aria-describedby="validationTooltipUsernamePrepend" required>
          </div>
        </div>
        <div class="col-md-5 mb-3 mx-4">
          <label for="validationTooltip04">Email</label>
          <input type="text" class="form-control" id="email" placeholder="Please enter your email address" required>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-10 mb-3 mx-4">
          <div class = "md-form">
            <label for="validationTooltip03" style="margin-left:20px;">Message</label>
            <textarea type="text" style="margin-left:20px;" id="message" name="message" rows="7" class="form-control md-textarea" placeholder="Let me know how I can help!" required></textarea>
          </div>
        </div>
      </div>
      <input type="text" style="margin-left:44px;" value="Submit" class="btn btn-secondary" onclick="formSubmit()"/>
    </form>
    </br>
    <p id="SubmissionSuccess" style ="align:center; margin-left:44px; color:green; font-size:20px;"></p>


    <!-- Footer -->
    <?php include('footer.php') ?>


    <script>

      //set default zoom to 90%
      document.body.style.zoom="90%";

      //Controls contact form submission. Responds to event listener
      function formSubmit(){

        //Use DOM to set local variables
        let fn = document.getElementById('firstname').value;
        let ln = document.getElementById('lastname').value;
        let username = document.getElementById('username').value;
        let email = document.getElementById('email').value;
        let message = document.getElementById('message').value;

        //Email format validation code from: https://stackoverflow.com/questions/46155/how-to-validate-an-email-address-in-javascript
        let emailformat = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        if(fn === ""){
          document.getElementById('SubmissionSuccess').textContent = 'Please enter a first name';
          document.getElementById('SubmissionSuccess').style.color = "red";
        }
        else if(ln === ""){
          document.getElementById('SubmissionSuccess').textContent = 'Please enter a last name';
          document.getElementById('SubmissionSuccess').style.color = "red";
        }
        else if(username === ""){
          document.getElementById('SubmissionSuccess').textContent = 'Please enter a username';
          document.getElementById('SubmissionSuccess').style.color = "red";
        }
        else if(email === "" || emailformat.test(email.toLowerCase()) == false){
          document.getElementById('SubmissionSuccess').textContent = 'Please enter a valid email address';
          document.getElementById('SubmissionSuccess').style.color = "red";
        }
        else if(message == ""){
          document.getElementById('SubmissionSuccess').textContent = 'Please enter a message';
          document.getElementById('SubmissionSuccess').style.color = "red";
        }
        else{
          window.location.href = "mailto:gilessteiner1@gmail.com";
          document.getElementById('SubmissionSuccess').textContent = 'Thank you for leaving a message. I will get back to you soon';
          document.getElementById('SubmissionSuccess').style.color = "green";
        }
      }
      </script>


    </body>
</html>
