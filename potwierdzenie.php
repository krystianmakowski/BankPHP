<?php
include "daneprzelewu.php";
?>
<html>
<head>
  <meta charset="utf-8">
  <title>Twój Profil</title>
  <link href="style.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body class="loggedin">
  <nav class="navtop">
    <div>
      <h1>Jewish Bank</h1>
      <a href="profile.php"><i class="fas fa-user-circle"></i>Twój profil</a>
			<a href="wpłata.html"> <i class="fas fa-cloud-upload-alt"></i>Wpłata</a>
			<a href="wypłata.html"> <i class="fas fa-cloud-download-alt"></i>Wypłata</a>
			<a href="przelew.html"><i class="fas fa-coins"></i>Przelew</a>
			<a href="historia.php"><i class="fas fa-history"></i>Historia</a>
			<a href="kredyt.html"><i class="fas fa-coins"></i>Kredyt</a>
			<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Wyloguj się</a>
    </div>
  </nav>
  <script> // Przekazanie numeru konta i stanu w sesji  
    window.onload = function() {
      document.getElementById('nrkonta').value = sessionStorage.getItem('nrkonta');
      document.getElementById('amount').value = sessionStorage.getItem('amount');
    };
  </script>
  <div class="content">
    <h2>Dane przelewu</h2>
    <div>
      <form method="POST" action="potwierdzprzelew.php">
      <table>
        <tr>
          <td>Numer konta odbiorcy:</td>
          <td><input style="border:none" size="60" name="nrkonta" id="nrkonta"></td>
        </tr>
        <tr>
          <td>Nazwa banku odbiorcy:</td>
          <td><?=$bankname?></td>
        </tr>
        <tr>
          <td>Kwota przelewu:</td>
          <td><input style="border:none" size="60" name="amount" id="amount"></td>
        </tr>
      </table>
        <button type="submit" class="btn btn-block btn-primary">Potwierdź przelew</button>
      </form>
    </div>
  </div>
</body>

</html>
