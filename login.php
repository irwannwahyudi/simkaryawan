<?php
session_start();

if (isset($_SESSION['login'])) {
  header("Location: index.php");
  exit;
}

require 'functions.php';

//ketika tombol login ditekan
if (isset($_POST['login'])) {
  $login = login($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - SIM Karyawan</title>
  <link rel="icon" href="img/logo.png">
  <link rel="stylesheet" href="style-login.css">
</head>

<body>
  <div class="logo-container">
    <img src="img/logo.png" alt="Logo RSIY PDHI" class="logo">
  </div>
  <?php if (isset($login['error'])) : ?>
    <p style="color: red; font:style: italic;"><?= $login['pesan']; ?></p>
  <?php endif ?>
  <form action="" method="POST">
    <ul>
      <li class="judul">SIM KARYAWAN RSIY PDHI</li>
      <li class="petunjuk">Masukkan Username dan Password</li>
      <li>
        <label>
          <input type="text" name="username" placeholder="Username" autofocus>
        </label>
      </li>
      <li>
        <label>
          <input type="password" name="password" autocomplete="off" placeholder="Password" required>
        </label>
      </li>
      <li class="button-container">
        <button type="submit" name="login" required>LOGIN</button>
      </li>
    </ul>
  </form>
</body>

</html>