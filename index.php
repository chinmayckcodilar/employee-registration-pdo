<?php
session_start();
if($_SESSION['LoggedIn']==true){
    header("location: employee-data.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-login</title>
</head>
<body>
    <form action="admin-auth.php" method="post">
        <label for="uname">Username:</label>
        <input type="text" id="uname" name="uname"><br><br>
        <label for="pass">Password:</label>
        <input type="text" id="pass" name="pass"><br><br>
        <input type="submit" name="submit">
    </form>
    <br>
<a href='employee-reg.php'>Registration</a>
</body>
</html>