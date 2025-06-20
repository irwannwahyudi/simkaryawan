<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';
$karyawan = query("SELECT * FROM karyawan");

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

<body class="w-100">
  <div class="d-flex w-100">
    <?php include 'sidebar.php'; ?>

    <div class="flex-grow-1 pt-4 px-4">
      <div class="mb-4">
        <h2 class="dashboard-title">DATA KARYAWAN</h2>
        <p class="text-muted">Rumah Sakit Islam Yogyakarta PDHI</p>
      </div>


      <div class="d-flex justify-content-end mb-3">
        <form class="d-flex" action="" method="POST" style="max-width: 400px; width: 100%;">
          <input type="text" name="keyword" placeholder="Cari karyawan..." class="form-control me-2" autocomplete="off" autofocus>
          <button type="submit" name="cari" class="btn btn-primary">Cari</button>
        </form>
      </div>

      <!-- Table -->
      <div class="table-responsive">
        <table class="table table-bordered table-striped w-100">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Foto</th>
              <th>Nama</th>
              <th>Divisi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($karyawan)) : ?>
              <tr>
                <td colspan="4" class="text-danger text-center">DATA KARYAWAN TIDAK DITEMUKAN!</td>
              </tr>
            <?php endif; ?>
            <?php $i = 1;
            foreach ($karyawan as $m) : ?>
              <tr>
                <td><?= $i++; ?></td>
                <td><img src="img/<?= htmlspecialchars($m['gambar']); ?>" width="60" alt="Foto"></td>
                <td><?= htmlspecialchars($m['nama']); ?></td>
                <td><?= htmlspecialchars($m['divisi']); ?></td>
                <td><a href="detail.php?id=<?= $m['id']; ?>" class="btn btn-info btn-sm">Lihat Detail</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
