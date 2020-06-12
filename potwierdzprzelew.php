<?php
session_start();
include "connect.php";

if (!isset($_POST['nrkonta'], $_POST['amount'])) {
    exit('Proszę uzupełnij formularz!');
}
if (empty($_POST['nrkonta']) || empty($_POST['amount'])) {
    exit('Proszę uzupełnij formularz!');
}

//sprawdź czy istnieje konto
$stmt = $con->prepare('SELECT accnumber, accbalance, customerid FROM accounts WHERE accnumber = ?');
$stmt->bind_param('s', $_POST['nrkonta']);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($accnumber, $accbalanceto, $customertoid);
    $stmt->fetch();
    $stmt->close();

    // sprawdz czy na koncie jest wystarczająca ilość pieniedzy
    $stmt = $con->prepare('SELECT accbalance FROM accounts WHERE customerid = ?');
    $stmt->bind_param('i', $_SESSION['id']);
    $stmt->execute();
    $stmt->bind_result($accbalance);
    $stmt->fetch();
    $stmt->close();

    if ($accbalance > $_POST['amount']) {
        // odejmnij środki z konta
        $stmt = $con->prepare('UPDATE accounts SET accbalance = ? WHERE customerid = ?');
        $newValue = $accbalance - $_POST['amount'];
        $stmt->bind_param('si', $newValue, $_SESSION['id']);
        $stmt->execute();
        $stmt->close();

        //dodaj środki na przelane Konto
        $stmt = $con->prepare('UPDATE accounts SET accbalance = ? WHERE accnumber = ?');
        $newValue = $accbalanceto + $_POST['amount'];
        $stmt->bind_param('ds', $newValue, $_POST['nrkonta']);
        $stmt->execute();
        $stmt->close();

        //wstaw tranzakcje do tabeli
        $stmt = $con->prepare('INSERT INTO transaction (transactiondate, paymentdate, amount, customerid, type) VALUES (?, ?, ?, ?, ?)');
        $tomorrow = date("Y-m-d", time() + 86400);
        $today = date("Y-m-d");
        $type = "CLIENT";
        $stmt->bind_param('ssdis', $today, $tomorrow, $_POST['amount'], $_SESSION['id'], $type);
        $stmt->execute();
        $stmt->close();
        header('Location: profile.php');
    } else {
        echo 'Brak środków na koncie do przelewu!';
    }
} else {
    echo 'Brak numeru konta w systemie!';
}
$con->close();
