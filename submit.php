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

$stmt = $pdo->prepare("INSERT INTO employees (name, email, phone) VALUES (:name, :email, :phone)");

$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];

$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':phone', $phone);

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

