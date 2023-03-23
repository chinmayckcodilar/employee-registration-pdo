<?php
session_start();
if ($_SESSION['LoggedIn'] == true) {
} else {
  header("location: index.php");
  exit;
}
?>

<!DOCTYPE html>
<html>

<head>
  <style>
    body {
      background-color: antiquewhite;
      margin-left: 35%;
      margin-top: 15%;
      font-family: sans-serif;
    }

    input {
      border-radius: 10px;
    }

    input[type="submit"] {
      width: 100px;
    }

    input[id="email"] {
      margin-left: 39px;
    }

    input[id="phone"] {
      margin-left: 33px;
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
    <label for="fname">First Name:</label>
    <input type="text" id="fname" name="fname" /><br /><br />

    <label for="lname">Last Name:</label>
    <input type="text" id="lname" name="lname" /><br /><br />

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" /><br /><br />

    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" /><br /><br />

    <label for="production">Production:</label>
    <input list="dept" id="production" name="production">
    <datalist id="dept">
      <option value="Production">
      <option value="Business">
    </datalist><br><br>

        <input type="submit" id="submit" value="Submit" />
  </form><br>

  <a href='index.php'>Employee-Data</a>

</body>

</html>