<?php
session_start();
$user=$_POST["uname"];
$password=$_POST["pass"];

require_once realpath(__DIR__ . '/vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeload();



if ($user == $_ENV['ADMIN_NAME'] && $password == $_ENV['ADMIN_PASS']){
    $_SESSION['LoggedIn']=true;
    header("location: employee-data.php");
    exit;
}
header("location: index.php");
?>