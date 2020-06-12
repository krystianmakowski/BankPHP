<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.html');
    exit;
}

include "connect.php";
    // Przgotowanie aktulanego stanu konta
if ($stmt = $con->prepare('SELECT accbalance FROM accounts WHERE customerid = ?')) {
    $stmt->bind_param('i', $_SESSION['id']);
    $stmt->execute();
    $stmt->bind_result($accbalance);
    $stmt->fetch();
    $stmt->close();
    // Aktualizacja satnu konta
    $stmt = $con->prepare('UPDATE accounts SET accbalance = ? WHERE customerid = ?');
    $newValue = $accbalance + $_POST['amount'];
    $stmt->bind_param('si', $newValue, $_SESSION['id']);
    $stmt->execute();
    $stmt->close();

    //wstaw tranzakcje do tabeli
    $stmt = $con->prepare('INSERT INTO transaction (transactiondate, paymentdate, amount, customerid, type) VALUES (?, ?, ?, ?, ?)');
    $tomorrow = date("Y-m-d", time() + 86400);
    $today = date("Y-m-d");
    $type = "IN";
    $stmt->bind_param('ssdis', $today, $tomorrow, $_POST['amount'], $_SESSION['id'], $type);
    $stmt->execute();
    $stmt->close();
}
$con->close();
header('Location: profile.php');
