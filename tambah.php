<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

if (isset($_POST['tambah'])) {
  if (tambah($_POST) > 0) {
    echo "<script>
          alert('Data berhasil ditambahkan');
          document.location.href='data_karyawan.php';
          </script>";
  } else {
    echo "Data gagal ditambahkan!";
  }
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

    .img-preview {
      display: block;
      margin-top: 10px;
      max-width: 120px;
    }

    .dashboard-title {
      font-weight: 600;
      font-size: 1.5rem;
    }

    textarea {
      resize: vertical;
    }
  </style>
</head>

<body class="bg-light">
  <div class="d-flex">
    <?php include 'sidebar.php'; ?>

    <div class="flex-grow-1 p-4">
      <!-- Header -->
      <div class="text-center mb-4">
        <h2 class="mt-3">Tambah Data Karyawan</h2>
      </div>

      <!-- Form -->
      <div class="container-fluid">
        <form action="" method="POST" enctype="multipart/form-data" class="border p-4 rounded bg-white shadow-sm">
          <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
              <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" autofocus required>
              </div>
              <div class="mb-3">
                <label for="tempat" class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat" id="tempat" class="form-control" autocomplete="off" required>
              </div>
              <div class="mb-3">
                <label for="lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="lahir" id="lahir" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="kelamin" class="form-label">Jenis Kelamin</label>
                <select name="kelamin" id="kelamin" class="form-select" required>
                  <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="pendidikan" class="form-label">Pendidikan Terakhir</label>
                <select name="pendidikan" id="pendidikan" class="form-select" required>
                  <option value="" disabled selected>-- Pilih Tingkat Pendidikan --</option>
                  <option value="SMA">SMA sederajat</option>
                  <option value="D3">Diploma 3</option>
                  <option value="S1">Strata 1</option>
                  <option value="S2">Strata 2</option>
                  <option value="S3">Strata 3</option>
                  <option value="dr">dokter</option>
                  <option value="Sp">dokter Spesialis</option>
                  <option value="Dr">Doktoral</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" rows="3" required></textarea>
              </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
              <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" name="nik" id="nik" class="form-control" autocomplete="off" required>
              </div>
              <div class="mb-3">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="tel" name="telepon" id="telepon" class="form-control" autocomplete="off" required>
              </div>
              <div class="mb-3">
                <label for="divisi" class="form-label">Divisi</label>
                <select name="divisi" id="divisi" class="form-select" required>
                  <option value="" disabled selected>-- Divisi --</option>
                  <option value="Medis">Medis</option>
                  <option value="Non Medis">Non Medis</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="agama" class="form-label">Agama</label>
                <select name="agama" id="agama" class="form-select" required>
                  <option value="" disabled selected>-- Pilih Agama --</option>
                  <option value="Islam">Islam</option>
                  <option value="nonislam">Non Islam</option>
                </select>
              </div>


              <div class="mb-3">
                <label for="daftar" class="form-label">Mulai Bekerja</label>
                <input type="date" name="daftar" id="daftar" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="gambar" class="form-label">Foto</label>
                <input class="form-control" type="file" name="gambar" id="gambar" onchange="previewImage()">
                <img src="img/nophoto.jpg" class="img-preview" id="preview" alt="Preview">
              </div>
            </div>
          </div>

          <button type="submit" name="tambah" class="btn btn-primary w-100">Tambah Data</button>
        </form>


      </div>
    </div>
  </div>

  <script>
    function previewImage() {
      const fileInput = document.querySelector('#gambar');
      const preview = document.querySelector('#preview');
      const file = fileInput.files[0];
      const reader = new FileReader();

      reader.onload = function(e) {
        preview.src = e.target.result;
      }

      if (file) {
        reader.readAsDataURL(file);
      }
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>