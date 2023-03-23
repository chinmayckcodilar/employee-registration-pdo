<?php
session_start();
if ($_SESSION['LoggedIn'] == true) {

    require_once realpath(__DIR__ . '/vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeload();

    $host = $_ENV['MYSQL_HOST'];
    $user = $_ENV['MYSQL_USER'];
    $password = $_ENV['MYSQL_PASSWORD'];
    $database = $_ENV['MYSQL_DATABASE'];

    // Connect to MySQL using PDO
    $dsn = "mysql:host=$host;dbname=$database";
    $pdo = new PDO($dsn, $user, $password);

    $stmt=null;

    $stmt=$pdo->prepare("SELECT * FROM employees WHERE id!=:id AND(email=:email OR phone=:phone)");
    $stmt->bindParam(":id",$_POST['id']);
    $stmt->bindParam(":email",$_POST['email']);
    $stmt->bindParam(":phone",$_POST['phone']);
    $stmt->execute();


    if($stmt->rowCount()>0){
        $id = $_GET['id'];
        echo '<script language="javascript"> alert("Email already exists");</script>';
        header("refresh:0 ,url= edit.php?id=$id");

        exit;

    }


    // Check if the form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        $id = $_POST['id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $production = $_POST['production'];

        

        // Update employee data in the database
        $stmt = $pdo->prepare("UPDATE employees SET fname = ?, lname = ?, email = ?, phone = ?, production = ? WHERE id = ?");
        $stmt->execute([$fname, $lname, $email, $phone, $production, $id]);

        // Redirect back to the employee data page
        header("Location: employee-data.php");
        exit();
    }

    // Get the employee data based on the ID from the query string
    $id = $_GET['id'];
    $sql = "SELECT * FROM employees WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch();

    // Output the form with the current employee data
    echo "<link rel='stylesheet' href='style.css'>";
    echo "<form method='POST'>";
    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
    echo "<label>First Name:</label><br>";
    echo "<input type='text' name='fname' value='" . $row['fname'] . "'required><br>";
    echo "<label>Last Name:</label><br>";
    echo "<input type='text' name='lname' value='" . $row['lname'] . "'required><br>";
    echo "<label>Email:</label><br>";
    echo "<input type='email' name='email' value='" . $row['email'] . "'required><br>";
    echo "<label>Phone:</label><br>";
    echo "<input type='tel' name='phone' value='" . $row['phone'] . "'required><br>";
    echo "<label>Production:</label><br>";
    echo "<input type='text' name='production' value='" . $row['production'] . "'><br><br><br>";
    echo "<input type='submit' value='Save'>";
    echo "</form>";

    // Close the connection
    $pdo = null;
} else {
    header("Location: index.php");
}
