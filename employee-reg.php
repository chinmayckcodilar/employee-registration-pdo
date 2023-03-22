<?php
session_start();
if($_SESSION['LoggedIn']==true){
    
}

else{
  header("location: index.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <style>
      body{
        margin-left: 35%;
        margin-top:15%;
        font-family: sans-serif;
      }
      input{
        border-radius: 10px;
      }

      input[type="submit"]{
        width:100px;
      }

      
    </style>

    <title>Employee Form</title>
    <script>
      function validateForm() {
        var name = document.forms["employeeForm"]["name"].value;
        var email = document.forms["employeeForm"]["email"].value;
        var phone = document.forms["employeeForm"]["phone"].value;
        var emailRegex = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
        var phoneRegex = /^[0-9]{10}$/;
        
        if (name == "") {
          alert("Name must be filled out");
          return false;
        }
        
        if (!email.match(emailRegex)) {
          alert("Invalid email format");
          return false;
        }
        
        if (!phone.match(phoneRegex)) {
          alert("Invalid phone number format");
          return false;
        }
      }
    </script>
  </head>
  <body>
    <h1>Employee Form</h1>
    <form name="employeeForm" action="submit.php" method="post" onsubmit="return validateForm()">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" /><br /><br />

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" /><br /><br />

      <label for="phone">Phone:</label>
      <input type="text" id="phone" name="phone" /><br /><br />

      <input type="submit" id="submit" value="Submit" />
    </form>

	<a href='index.php'>Admin-login</a>

  </body>
</html>

