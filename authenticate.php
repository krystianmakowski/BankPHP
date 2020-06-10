<?php
session_start();
include "connect.php";

// Teraz sprawdzamy, czy dane zostały przesłane, funkcja isset () sprawdzi, czy dane istnieją.
if ( !isset($_POST['username'], $_POST['password']) ) {
	exit('Proszę uzupełnij pole użytkownika i hasło!');
}
//Przygotowanie nazy SQL, instrukcji SQL
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
    // Parametryzowanie zapytań, nazwa użytkownika, s - string
	$stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    // Wynik zapisany, możemy sprawdzić czy konto istnieje w bazie.
	$stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Konto istnieje, weryfikacja hasła
        if (password_verify($_POST['password'], $password)) {
            // Weryfikacja pomyślna, użytkownik jest zalogowany.
            // Stworzenie sesji użytkownika zalogowanego.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header('Location: profile.php');
        } else {
            echo 'Nieprawidłowe hasło!';
        }
    } else {
        echo 'Nieprawidłowa nazwa użytkownika!';
    }

	$stmt->close();
}
?>