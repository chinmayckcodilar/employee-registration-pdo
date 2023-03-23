<?php
require_once realpath(__DIR__ . '/vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeload();

$host = $_ENV['MYSQL_HOST'];
$user = $_ENV['MYSQL_USER'];
$password = $_ENV['MYSQL_PASSWORD'];
$database = $_ENV['MYSQL_DATABASE'];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}


$stmt=$pdo->prepare("SELECT * FROM employees WHERE email = :email");
$stmt->bindParam(':email', $_POST["email"]);
$stmt->execute();

if($stmt->rowCount() > 0){
    echo '<script language="javascript"> alert("Email or Phone already exists");</script>';
    header("refresh:0 ,url= employee-reg.php");
    exit;
}

$stmt=null;

$stmt=$pdo->prepare("SELECT * FROM employees WHERE phone = :phone");
$stmt->bindParam(':phone', $_POST["phone"]);
$stmt->execute();

if($stmt->rowCount() > 0){
    echo '<script language="javascript"> alert("Mobile number already exists");</script>';
    header("refresh:0 , url= employee-reg.php");
    exit;
}


$stmt = $pdo->prepare("INSERT INTO employees (fname,lname, email, phone, production) VALUES (:fname, :lname, :email, :phone, :production)");

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$prod = $_POST["production"];

$stmt->bindParam(':fname', $fname);
$stmt->bindParam(':lname', $lname);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':phone', $phone);
$stmt->bindParam(':production', $prod);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->errorInfo()[2];
}

$stmt = null;
$pdo = null;
echo"<br>";
echo"<a href='index.php'>Admin Login</a>";
echo"<br>";
echo"<a href='employee-reg.php'>Registration</a>";

?>

