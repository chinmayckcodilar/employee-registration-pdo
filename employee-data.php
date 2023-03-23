<!DOCTYPE html>
<html>
<head>
	<title>Employee Data</title>
	<style>
		body{
			margin-left: 25%;
			font-family: sans-serif;
			background-color: azure;
		}

		table{
			border-spacing: 20px;
		}

		input[type="submit"]{
			border-radius: 10px;
			width: 60px;
		}
	</style>
</head>
<body>
	<h1>Employee Data</h1>
	<form action="logout.php" method="post">
		<input type="submit" value="Logout" >
	</form>
	<table>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Department</th>
		</tr>

		<?php

    session_start();
    if($_SESSION['LoggedIn']==true){

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

    // Retrieve employee data
    $sql = "SELECT fname, lname, email, phone, production FROM employees";
    $stmt = $pdo->query($sql);

    // Output employee data in table rows
    if ($stmt->rowCount() > 0) {
        while($row = $stmt->fetch()) {
            echo "<tr><td>" . $row["fname"] . "</td><td>" . $row["lname"] . "</td><td>" . $row["email"] . "</td><td>". $row["phone"] . "</td><td>" . $row["production"] . "</td></tr>";
        }
    } else {
        echo "0 results";
    }

    // Close the connection
    $pdo = null;
}

	else{
		header("location: index.php");
	}
		?>

	</table>
	<br>
	<a href='employee-reg.php'>Registration</a>

</body>
</html>
