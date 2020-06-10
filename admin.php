<?php
// Użycie sesji
session_start();
// Jeśli użytkownik jest nie zalogowany, nastąpi przekierowanie do strony logowania
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
include "connect.php";
// Pozyskanie adresu email i hasła z bazy danych (nie przetrzymujemy w sesji)
$stmt = $con->prepare('SELECT * FROM accounts WHERE username = ?');
// Odnalezienie użytkownika po jego ID
$stmt->bind_param('i', $_SESSION['username']);
$stmt->execute();
$stmt->bind_result($email, $saldo, $kredyt, $karta);
$stmt->fetch();
$stmt->close();


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Twój Profil</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Jewish Bank</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Twój profil</a>
				<a href="przelew.html"><i class="fas fa-coins"></i>Zrób przelew</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Wyloguj się</a>
			</div>
		</nav>
		<div class="content">
			<h2>Twoje Dane</h2>
			<div>
				<p>Szczegóły użytowników:</p>
				<table>
					<tr>
						<td>Użytkownik:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
					<tr>
						<td>Stan konta:</td>
						<td><?=$saldo?> PLN</td>
					</tr>
					<tr>
						<td>Wzięty kredyt:</td>
						<td><?=$kredyt?> PLN</td>
					</tr>	
					<tr>
						<td>Karta kredytowa:</td>
						<td><?=$karta?> PLN</td>
					</tr>				
				</table>
			</div> 
		</div>					
	</body>
</html>