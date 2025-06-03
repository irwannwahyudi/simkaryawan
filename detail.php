<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';
#ambil id dari URL
$id = $_GET['id'];

$m = query("SELECT * FROM karyawan WHERE id = $id");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Karyawan</title>
  <link rel="icon" href="img/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .list-group-item {
      padding-top: 0.4rem;
      padding-bottom: 0.4rem;
      font-size: 0.95rem;
    }

    .list-group-item img {
      max-height: 100px;
      align-items: center;
    }
  </style>

</head>

<body class="bg-light">
  <div class="d-flex">
    <?php include 'sidebar.php'; ?>

    <div class="flex-grow-1 p-4">
      <div class="container-fluid">
        <div class="text-center mb-4">
          <h2 class="mt-3">Detail Karyawan</h2>
        </div>

        <ul class="list-group">
          <li class="list-group-item d-flex justify-content-center align-items-center" style="height: 110px;">
            <img src="img/<?= $m['gambar']; ?>" class="img-thumbnail" style="max-height: 110px;" alt="Foto Karyawan">
          </li>

          <li class="list-group-item"><strong>NIK:</strong> <?= $m['nik']; ?></li>
          <li class="list-group-item"><strong>Nama:</strong> <?= $m['nama']; ?></li>
          <li class="list-group-item"><strong>Jenis Kelamin:</strong> <?= $m['kelamin']; ?></li>
          <li class="list-group-item"><strong>Divisi:</strong> <?= $m['divisi']; ?></li>
          <li class="list-group-item"><strong>Tempat Lahir:</strong> <?= $m['tempat']; ?></li>
          <li class="list-group-item"><strong>Tanggal Lahir:</strong> <?= $m['lahir']; ?></li>
          <li class="list-group-item"><strong>Pendidikan:</strong> <?= $m['pendidikan']; ?></li>
          <li class="list-group-item"><strong>Telepon:</strong> <?= $m['telepon']; ?></li>
          <li class="list-group-item"><strong>Alamat:</strong> <?= $m['alamat']; ?></li>
          <li class="list-group-item"><strong>Agama:</strong> <?= $m['agama']; ?></li>
          <li class="list-group-item"><strong>Mulai Bekerja:</strong> <?= $m['daftar']; ?></li>
          <li class="list-group-item">
            <a href="ubah.php?id=<?= $m['id']; ?>" class="btn btn-warning btn-sm">Ubah</a>
            <a href="hapus.php?id=<?= $m['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?');">Hapus</a>
            <a href="index.php" class="btn btn-secondary btn-sm">Kembali</a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>