<?php
include "daneprofil.php";
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
				<a href="wpłata.html"> <i class="fas fa-cloud-upload-alt"></i>Wpłata</a>
				<a href="wypłata.html"> <i class="fas fa-cloud-download-alt"></i>Wypłata</a>
				<a href="przelew.html"><i class="fas fa-coins"></i>Przelew</a>
				<a href="historia.php"><i class="fas fa-history"></i>Historia</a>
				<a href="kredyt.html"><i class="fas fa-coins"></i>Kredyt</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Wyloguj się</a>
			</div>
		</nav>
		<div class="content">
			<h2>Twoje Dane</h2>
			<div>
				<p>Szczegóły Twojego konta:</p>
				<table>
					<tr>
						<td>Imię i nazwisko:</td>
						<td><?=$firstname?> <?=$lastname?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
					<tr>
						<td>Stan konta:</td>
						<td><?=$accbalance?> PLN</td>
					</tr>
					<tr>
						<td>Numer konta:</td>
						<td><?=$accnumber?></td>
					</tr>
					<tr>
						<td>Karta kredytowa:</td>
						<td><?=$creditcardnumber?></td>
					</tr>
          <tr>
						<td>Wzięty kredyt:</td>
						<td><?=$amount?> PLN</td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>
