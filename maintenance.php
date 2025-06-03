<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';
$karyawan = query("SELECT * FROM karyawan");

// Dummy data – bisa diganti filter berdasarkan jenis karyawan di database
$jumlahTetap = 0;
$jumlahKontrak = 0;

if (isset($_POST['cari'])) {
  $karyawan = cari($_POST['keyword']);
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIM KARYAWAN RSIY PDHI</title>
  <link rel="icon" href="img/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .container {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      /* Vertikal center */
      align-items: center;
      /* Horizontal center */
      text-align: center;
    }

    .logo {
      width: 190px;
      height: auto;
      margin-bottom: 20px;
      margin-left: 170px;
      align-items: center;
      /* Horizontal center */
    }

    .btn-dashboard {
      margin-top: 30px;
      padding: 10px 20px;
      background-color: #0d6efd;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .btn-dashboard:hover {
      background-color: #0b5ed7;
    }
  </style>

</head>

<body class="bg-light">
  <div class="d-flex">
    <?php include 'sidebar.php'; ?>

    <div class="flex-grow-1 d-flex justify-content-center align-items-center bg-light" style="min-height: 100vh;">
      <div class="text-center p-4">
        <img src="img/logo.png" alt="Logo" class="logo img-fluid mb-4">
        <h1 class="mb-3">Halaman Sedang Dalam Perbaikan</h1>
        <p class="mb-4">
          Kami sedang melakukan pemeliharaan sistem untuk meningkatkan layanan.<br>
          Silakan kembali beberapa saat lagi.
        </p>
        <a href="index.php" class="btn-dashboard d-inline-block">Kembali ke Halaman Utama</a>
      </div>
    </div>


  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>