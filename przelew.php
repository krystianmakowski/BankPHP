<?php
include "connect.php";

if (!isset($_POST['nrkonta'], $_POST['saldo'])) {
	exit('Proszę uzupełnij formularz !');
}
if (empty($_POST['nrkonta']) || empty($_POST['saldo'])) {
	exit('Proszę uzupełnij formularz !');
}

if ($stmt = $con->prepare('SELECT saldo FROM accounts WHERE nrkonta = ?')) {
    $stmt->bind_param('s', $_POST['saldo']);
	$stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
		echo 'Podana nazwa użytkownika już istnieje, podaj inną!';
	} else {
        if ($stmt = $con->prepare('INSERT INTO accounts (saldo) VALUES (?)')) {
            $stmt->bind_param('s', $_POST['saldo']);
            $stmt->execute();  
        echo 'pomyślnie wykonano przelew';
        }}
        $stmt->close();
    }
?>

