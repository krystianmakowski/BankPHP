<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.html');
    exit;
}

include "connect.php";

if ($stmt = $con->prepare('SELECT accbalance FROM accounts WHERE customerid = ?')) {
    $stmt->bind_param('i', $_SESSION['id']);
    $stmt->execute();
    $stmt->bind_result($accbalance);
    $stmt->fetch();
    $stmt->close();

    if ($accbalance > $_POST['amount']) {
        $stmt = $con->prepare('UPDATE accounts SET accbalance = ? WHERE customerid = ?');
        $newValue = $accbalance - $_POST['amount'];
        $stmt->bind_param('si', $newValue, $_SESSION['id']);
        $stmt->execute();
        $stmt->close();

        //wstaw tranzakcje do tabeli
        $stmt = $con->prepare('INSERT INTO transaction (transactiondate, paymentdate, amount, customerid, type) VALUES (?, ?, ?, ?, ?)');
        $tomorrow = date("Y-m-d", time() + 86400);
        $today = date("Y-m-d");
        $type = "OUT";
        $stmt->bind_param('ssdis', $today, $tomorrow, $_POST['amount'], $_SESSION['id'], $type);
        $stmt->execute();
        $stmt->close();
        header('Location: profile.php');
    } else {
        echo "Za mała ilość środków na koncie!";
    }
}
$con->close();
