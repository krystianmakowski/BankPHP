<?php
include "connect.php";

// Teraz sprawdzamy, czy dane zostały przesłane, funkcja isset () sprawdzi, czy dane istnieją.
if (!isset($_POST['pesel'], $_POST['password'], $_POST['email'], $_POST['firstname'], $_POST['lastname'])) {
    exit('Proszę uzupełnij formularz rejestracji!');
}
// Upewniamy się ze przeslane dane nie sa wartosciami pustymi.
if (empty($_POST['pesel']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['firstname']) || empty($_POST['lastname'])) {
    exit('Proszę uzupełnij formularz rejestracji!');
}
// Walidacja adresu email
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    exit('Email nie jest prawidłowy!');
}
// Walidacja nazwy użytkownika
if (preg_match('/[0-9]{11}/', $_POST['pesel']) == 0) {
    exit('Numer PESEL jest nieprawidłowy!');
}
// Walidacja hasła
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
    exit('Hasło musi posiadać od 5 do 20 znaków!');
}
// Musimy sprawdzić, czy istnieje konto o tej nazwie użytkownika.
if ($stmt = $con->prepare('SELECT customerid FROM customers WHERE pesel = ? AND email = ?')) {
    // Parametryzowanie zapytań, hashowanie hasła
    $stmt->bind_param('ss', $_POST['pesel'], $_POST['email']);
    $stmt->execute();
    $stmt->store_result();
    // Wynik zapisany, możemy sprawdzić czy konto istnieje w bazie.
    if ($stmt->num_rows > 0) {
        echo 'Użytkownik o podanym numerze PESEL oraz mailu istnieje!';
    } else {
        // Dodawanie użytkownika
        if ($stmt = $con->prepare('INSERT INTO customers (pesel, password, email, firstname, lastname) VALUES (?, ?, ?, ?, ?)')) {
            // pobierz wolne, nieaktywne konto, przypisz je do użytkownika
            if ($stmtAcc = $con->prepare("SELECT accnumber, creditcardnumber FROM freeaccounts WHERE status = 'NOTACTIVE'")) {
                $stmtAcc->execute();
                $stmtAcc->store_result();

                if ($stmtAcc->num_rows > 0) {
                    $stmtAcc->bind_result($accnumber, $creditcardnumber);
                    $stmtAcc->fetch();
                    $stmtAcc->close();

                    // Nie chcemy ujawniać haseł w naszej bazie danych, więc haszujemy hasło i używamy password_verify, gdy użytkownik się zaloguje.
                    // dodaj usera i pobierz jego id
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $stmt->bind_param('sssss', $_POST['pesel'], $password, $_POST['email'], $_POST['firstname'], $_POST['lastname']);
                    $stmt->execute();
                    $last_id = $con->insert_id;

                    //dodaj numer konta bankowego i przypisz do usera
                    $stmtAcc = $con->prepare('INSERT INTO accounts (accnumber, customerid, accbalance, creditcardnumber) VALUES (?, ?, ?, ?)');
                    $value = 0.00;
                    $stmtAcc->bind_param('sids', $accnumber, $last_id, $value, $creditcardnumber);
                    $stmtAcc->execute();
                    $stmtAcc->close();

                    //ustaw konto bankowe jako aktywne (wykorzystane)
                    $stmtAcc = $con->prepare("UPDATE freeaccounts SET status = 'ACTIVE' WHERE accnumber = ?");
                    $stmtAcc->bind_param('s', $accnumber);
                    $stmtAcc->execute();
                    $stmtAcc->close();

                    $stmtAcc = $con->prepare('INSERT INTO loan (amount, customerid) VALUES (?, ?)');
                    $amount = 0.00;
                    $stmtAcc->bind_param('di', $amount, $last_id);
                    $stmtAcc->execute();
                    $stmtAcc->close();
                    $stmt->close();
                    echo 'Rejestracja przebiegła pomyślnie, możesz się teraz zalogować!';
                    header('Location: login.html');
                } else {
                    echo "Brak wolnych kont! Dodaj wolne konta do bazy danych";
                }
            }
        } else {
            // Coś jest nie tak z danymi sql, sprawdź, czy konto zawiera wszystkie 3 pola.
            echo 'Nie można wykonać zapytania!';
        }
    }
} else {
    // Coś jest nie tak z danymi sql, sprawdź, czy konto zawiera wszystkie 3 pola.
    echo 'Nie można wykonać zapytania!';
}
$con->close();
