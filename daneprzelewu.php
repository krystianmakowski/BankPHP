<?php
// Połączenie z bazą danych 
include "connect.php";
// Pobranie z bazy nazwy banku potrzebnej do przelewu
$stmt = $con->prepare('SELECT bankname FROM freeaccounts WHERE accnumber = ?');
$stmt->bind_param('s', $_POST['nrkonta']);
$stmt->execute();
$stmt->bind_result($bankname);
$stmt->fetch();
$stmt->close();
$con->close();
