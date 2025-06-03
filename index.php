<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}


require 'functions.php';
$karyawan = query("SELECT * FROM karyawan");
$medis = query("SELECT * FROM karyawan WHERE divisi = 'Medis'");
$nonmedis = query("SELECT * FROM karyawan WHERE divisi = 'Non Medis'");


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
  <link rel="stylesheet" href="style-index.css">
  <style>
    body {
      overflow-x: hidden;
    }

    .dashboard-title {
      font-weight: 600;
      font-size: 1.5rem;
    }

    .card h1 {
      font-size: 2.5rem;
    }
  </style>
</head>

<body class="bg-light">
  <div class="d-flex">
    <?php include 'sidebar.php'; ?>

    <div class="flex-grow-1 p-4">
      <!-- Judul -->
      <div class="mb-4">
        <h2 class="dashboard-title">Selamat Datang di SIM KARYAWAN</h2>
        <p class="text-muted">Rumah Sakit Islam Yogyakarta PDHI</p>
      </div>

      <!-- Cards -->
      <div class="row g-4">
        <div class="col-md-6 col-xl-4">
          <div class="card border-0 shadow-sm text-bg-primary h-100">
            <div class="card-body d-flex flex-column justify-content-between">
              <div>
                <h5 class="card-title">Jumlah Total Karyawan</h5>
                <h1><?= count($karyawan); ?></h1>
              </div>
              <div class="text-end">
                <a href="data_karyawan.php" class="btn btn-light btn-sm">Tampilkan</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-xl-4">
          <div class="card border-0 shadow-sm text-bg-success h-100">
            <div class="card-body d-flex flex-column justify-content-between">
              <div>
                <h5 class="card-title">Divisi Medis</h5>
                <h1><?= count($medis); ?></h1>
              </div>
              <div class="text-end">
                <a href="data_medis.php" class="btn btn-light btn-sm">Tampilkan</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-xl-4">
          <div class="card border-0 shadow-sm text-bg-warning h-100">
            <div class="card-body d-flex flex-column justify-content-between">
              <div>
                <h5 class="card-title">Divisi Nonmedis</h5>
                <h1><?= count($nonmedis); ?></h1>
              </div>
              <div class="text-end">
                <a href="data_nonmedis.php" class="btn btn-light btn-sm">Tampilkan</a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>