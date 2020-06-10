<?php
// Użycie sesji
session_start();
// Jeśli użytkownik jest nie zalogowany, nastąpi przekierowanie do strony logowania
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>JEWISH BANK</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1><i class="fas fa-money-check-alt fa-1x"> Jewish Bank</i></h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Twój profil</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Wyloguj się</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>

			<div class="row">
			<div class="col">
			<p><h2>Witam ponownie, <?=$_SESSION['name']?>!</h2></p>			
			</div>
			<div class="col">
				Twój stan konta: 
			</div>
			<div class="col">
				Twoje kredyty:
			</div>
			</div>	
		</div>
	</body>
</html>