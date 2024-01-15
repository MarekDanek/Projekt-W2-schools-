<?php
// používání relace, zahajování 
session_start();
// Pokud uživatel není přihlášen, přesměruje se na přihlašovací stránku
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'projekt';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Není heslo ani e-mailové informace uložené v relacích, získání výsledky z databáze.
$stmt = $con->prepare('SELECT password, email FROM users1 WHERE id = ?');
// získání informací o účtu použít ID účtu.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Profil</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="icon_guitar.jpg">
	<style>
		/* Základní styly stránky */
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f3f4f7;
		}

		.container {
			max-width: 1000px;
			margin: 0 auto;
			padding: 20px;
		}

		/* Navigační panel */
		.navbar {
			background-color: #333;
			color: #fff;
			padding: 10px;
		}

		.navbar h1 {
			margin: 0;
			font-size: 24px;
			font-weight: bold;
		}

		.navbar .nav-link {
			color: #fff;
			text-decoration: none;
			padding: 10px;
		}

		/* Obsah profilové stránky */
		.profile {
			background-color: #fff;
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
		}

		.profile h2 {
			margin: 0 0 20px;
			padding-bottom: 10px;
			border-bottom: 1px solid #ccc;
			font-size: 24px;
			color: #333;
		}

		.profile-table {
			width: 100%;
			margin-top: 20px;
			border-collapse: collapse;
		}

		.profile-table td {
			padding: 10px;
			border-bottom: 1px solid #ccc;
		}

		.profile-table td:first-child {
			font-weight: bold;
			width: 150px;
		}

		/* Hlavička stránky */
		.header {
			background-image: url("guitar_banner.jpg");
			background-size: cover;
			background-position: center;
			height: 300px;
			text-align: center;
			color: #fff;
			padding: 40px;
			box-sizing: border-box;
		}

		.header h1 {
			margin: 0;
			font-size: 36px;
			font-weight: bold;
		}

		/* Odhlášení tlačítko */
		.logout-button {
			margin-top: 20px;
			text-align: right;
		}

		.logout-button a {
			background-color: #333;
			color: #fff;
			padding: 10px 20px;
			text-decoration: none;
			border-radius: 3px;
			font-weight: bold;
		}
	</style>
</head>

<body>
	<header class="header">
		<h1>Guitar Tabs & Chords</h1>
	</header>

	<div class="container">
		<nav class="navbar">
			<h1>Profil</h1>
			<a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Odhlásit</a>
			<!-- Ostatní odkazy navigačního panelu zde -->
		</nav>

		<div class="profile">
			<h2>Profilová stránka</h2>
			<div>
				<p>Informace o tvém účtu:</p>
				<table class="profile-table">
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
		</div>

		<div class="logout-button">
			<a href="logout.php"><i class="fas fa-sign-out-alt"></i> Odhlásit se</a>
		</div>
	</div>
</body>
</html>
