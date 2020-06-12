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
			<h2>Historia</h2>
			<div>
        <?php
        // Użycie sesji
        session_start();
        if (!isset($_SESSION['loggedin'])) {
            header('Location: login.html');
            exit;
        }
        // Podłączenie do bazy danych
        include "connect.php";
        // Pobranie z tabeli transaction danych potrzebnych do historii danego profilu
        $stmt = $con->prepare('SELECT transactiondate, paymentdate, amount, type FROM transaction WHERE customerid = ?');
        $stmt->bind_param('i', $_SESSION['id']);
        $stmt->execute();
        $stmt->bind_result($transactiondate, $paymentdate, $amount, $type);
        echo "<table border='1'>
        <tr>
        <th>Data przelewu</th>
        <th>Data wykonania przelewu</th>
        <th>Kwota przelewu</th>
        <th>Typ tranzakcji</th>
        </tr>";
        // Rozdzielenie poszczegółnych rekordów z zapytania SQL
        while ($stmt->fetch()) {
            $trazType = "";
            if ($type == "IN") {
                $trazType = "Wpłata";
            } elseif ($type == "OUT") {
                $trazType = "Wypłata";
            } elseif ($type == "CLIENT") {
                $trazType = "Przelew";
            } elseif ($type == "LOAN") {
                $trazType = "Kredyt";
            }
            echo "<tr>";
            echo "<td>" . $transactiondate . "</td>";
            echo "<td>" . $paymentdate . "</td>";
            echo "<td>" . $amount . " PLN" . "</td>";
            echo "<td>" . $trazType . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        $stmt->close();
        ?>
			</div>
		</div>
	</body>
</html>
