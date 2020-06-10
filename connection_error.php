<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>JEWISH BANK</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	</head>
<body>
<body class="loggedin">
		<nav class="navtop">
			<div>
				<a href="index.html"><i class="fas fa-money-check-alt fa-2x"> Jewish Bank</i></a>							
			</div>
        </nav>
        <div class="text-center">
            <img src="images/error.png" alt="error" >
        </div>
        <div class="text-center">
        <h1>Uh-Oh !</h1>
            <p>
                Wystąpił błąd podczas łączenia z bazą danych !<br>
            </p>
            <p>
                <b>Komunikat o błędzie: </b>
                <?php
                    if (isset($_GET['error'])) {
                        echo $_GET['error'];
                    }
                ?><br><br>
                Upewnij się, że dane logowania do bazy danych są poprawne
                i / lub serwer jest poprawnie skonfigurowany / odpowiada. <br> <br>
                Spróbuj ponownie za jakiś czas. :)
            </p>
            <div>
            <a href="index.html"><button type="button" class="btn btn-success">Idź do strony głównej</button>
            </div>
        </div>
</body>
</html>