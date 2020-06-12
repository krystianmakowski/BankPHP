<?php
// Użycie sesji
session_start();
// Jeśli użytkownik jest nie zalogowany, nastąpi przekierowanie do strony logowania
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.html');
    exit;
}
// Podłączenie bazy danych
include "connect.php";
// Pobranie z tabeli customers rekordów imię, nazwisko i email
$stmt = $con->prepare('SELECT firstname, lastname, email FROM customers WHERE customerid = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($firstname, $lastname, $email);
$stmt->fetch();
$stmt->close();
// Pobranie z tabeli accounts numeu konta, karty kredytowej i stanu konta 
$stmt = $con->prepare('SELECT accnumber, accbalance, creditcardnumber FROM accounts WHERE customerid = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($accnumber, $accbalance, $creditcardnumber);
$stmt->fetch();
$stmt->close();
// Pobranie z tabeli loan wartości kredytu
$stmt = $con->prepare('SELECT amount FROM loan WHERE customerid = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($amount);
$stmt->fetch();
$stmt->close();
$con->close();
