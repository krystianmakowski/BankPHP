<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'bank';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
// Tworzenie połączenia
// Sprawdzanie połączenia
if (!$con)
  {
    header("location:connection_error.php?error=$con->mysqli_connect_errno");
  die("Błąd połączenia: " . mysqli_connect_errno());
  }
?>
