<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

//jika id tidak ada di URL
if (!isset($_GET['id'])) {
  header("location: dashboard.php");
  exit;
}

//ambil id dari url
$id = $_GET['id'];

//query data karyawan berdasarkan id
$m = query("SELECT * FROM karyawan WHERE id=$id");

//cek apakah tombol ubah sudah di klik
if (isset($_POST['ubah'])) {
  if (ubah($_POST) > 0) {
    echo "<script>
            alert('Data berhasil diubah');
            document.location.href='detail.php?id=$id';
          </script>";
  } else {
    echo "<script>
            alert('Data gagal diubah');
            document.location.href='detail.php?id=$id';
          </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ubah Data Karyawan</title>
  <link rel="icon" href="img/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .form-label {
      font-weight: 500;
    }

    .img-preview {
      max-height: 100px;
      display: block;
      margin-top: 10px;
    }
  </style>
</head>

<body class="bg-light">
  <div class="d-flex">
    <?php include 'sidebar.php'; ?>

    <div class="flex-grow-1 p-4">
      <div class="container">
        <h2 class="mb-4">Ubah Data Karyawan</h2>

        <form action="" method="POST" enctype="multipart/form-data" class="border p-4 rounded bg-white shadow-sm">
          <input type="hidden" name="id" value="<?= $m['id']; ?>">
          <input type="hidden" name="gambar_lama" value="<?= $m['gambar']; ?>">

          <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
              <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" class="form-control" required value="<?= $m['nama']; ?>">
              </div>

              <div class="mb-3">
                <label for="tempat" class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat" id="tempat" class="form-control" required value="<?= $m['tempat']; ?>">
              </div>

              <div class="mb-3">
                <label for="lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="lahir" id="lahir" class="form-control" required value="<?= $m['lahir']; ?>">
              </div>

              <div class="mb-3">
                <label for="kelamin" class="form-label">Jenis Kelamin</label>
                <select name="kelamin" id="kelamin" class="form-select" required>
                  <option value="" disabled>-- Pilih Jenis Kelamin --</option>
                  <option value="Laki-laki" <?= $m['kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                  <option value="Perempuan" <?= $m['kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="pendidikan" class="form-label">Pendidikan Terakhir</label>
                <select name="pendidikan" id="pendidikan" class="form-select" required>
                  <option value="" disabled>-- Pilih Tingkat Pendidikan --</option>
                  <option value="SMA" <?= $m['pendidikan'] == 'SMA' ? 'selected' : '' ?>>SMA sederajat</option>
                  <option value="D3" <?= $m['pendidikan'] == 'D3' ? 'selected' : '' ?>>Diploma 3</option>
                  <option value="S1" <?= $m['pendidikan'] == 'S1' ? 'selected' : '' ?>>Strata 1</option>
                  <option value="S2" <?= $m['pendidikan'] == 'S2' ? 'selected' : '' ?>>Strata 2</option>
                  <option value="S3" <?= $m['pendidikan'] == 'S3' ? 'selected' : '' ?>>Strata 3</option>
                  <option value="dr" <?= $m['pendidikan'] == 'dr' ? 'selected' : '' ?>>dokter</option>
                  <option value="Sp" <?= $m['pendidikan'] == 'Sp' ? 'selected' : '' ?>>dokter Spesialis</option>
                  <option value="Dr" <?= $m['pendidikan'] == 'Dr' ? 'selected' : '' ?>>Doktoral</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" rows="3" required><?= $m['alamat']; ?></textarea>
              </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
              <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" name="nik" id="nik" class="form-control" required value="<?= $m['nik']; ?>">
              </div>

              <div class="mb-3">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" name="telepon" id="telepon" class="form-control" required value="<?= $m['telepon']; ?>">
              </div>

              <div class="mb-3">
                <label for="divisi" class="form-label">Divisi</label>
                <select name="divisi" id="divisi" class="form-select" required>
                  <option value="" disabled>-- Divisi --</option>
                  <option value="Medis" <?= $m['divisi'] == 'Medis' ? 'selected' : '' ?>>Medis</option>
                  <option value="Non Medis" <?= $m['divisi'] == 'Non Medis' ? 'selected' : '' ?>>Non Medis</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="agama" class="form-label">Agama</label>
                <select name="agama" id="agama" class="form-select" required>
                  <option value="" disabled>-- Pilih Agama --</option>
                  <option value="Islam" <?= $m['agama'] == 'Islam' ? 'selected' : '' ?>>Islam</option>
                  <option value="Non Islam" <?= $m['agama'] == 'Non Islam' ? 'selected' : '' ?>>Non Islam</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="daftar" class="form-label">Mulai Bekerja</label>
                <input type="date" name="daftar" id="daftar" class="form-control" required value="<?= $m['daftar']; ?>">
              </div>

              <div class="mb-3">
                <label for="gambar" class="form-label">Foto</label>
                <input class="form-control" type="file" name="gambar" id="gambar" onchange="previewImage()">
                <img src="img/<?= $m['gambar']; ?>" class="img-preview" id="preview" alt="Preview">
              </div>
            </div>
          </div>

          <button type="submit" name="ubah" class="btn btn-primary w-100">Simpan Perubahan</button>
          <a href="detail.php?id=<?= $m['id']; ?>" class="btn btn-secondary w-100 mt-2">Batal</a>
        </form>

      </div>
    </div>
  </div>

  <script>
    function previewImage() {
      const fileInput = document.querySelector('input[name="gambar"]');
      const imgPreview = document.querySelector('.img-preview');

      const file = fileInput.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          imgPreview.src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    }
  </script>
</body>

</html>