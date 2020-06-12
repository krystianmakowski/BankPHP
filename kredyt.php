<?php
// Użycie sesji
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.html');
    exit;
}

include "connect.php";
    // Pobranie wartości aktulanego kredytu
if ($stmt = $con->prepare('SELECT amount FROM loan WHERE customerid = ?')) {
    $stmt->bind_param('i', $_SESSION['id']);
    $stmt->execute();
    $stmt->bind_result($amount);
    $stmt->fetch();
    $stmt->close();
    // Aktualizacja tabeli z kredytem
    $stmt = $con->prepare('UPDATE loan SET amount = ? WHERE customerid = ?');
    $newValue = $amount + $_POST['amount'];
    $stmt->bind_param('di', $newValue, $_SESSION['id']);
    $stmt->execute();
    $stmt->close();

    // Wstaw tranzakcje do tabeli
    $stmt = $con->prepare('INSERT INTO transaction (transactiondate, paymentdate, amount, customerid, type) VALUES (?, ?, ?, ?, ?)');
    $tomorrow = date("Y-m-d", time() + 86400);
    $today = date("Y-m-d");
    $type = "LOAN";
    $stmt->bind_param('ssdis', $today, $tomorrow, $_POST['amount'], $_SESSION['id'], $type);
    $stmt->execute();
    $stmt->close();
}
$con->close();
header('Location: profile.php');
