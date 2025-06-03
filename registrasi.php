<?php
require 'functions.php';

if (isset($_POST['registrasi'])) {
  if (registrasi($_POST) > 0) {
    echo "<script>
            alert('User baru berhasil ditambahkan. Silahkan login');
            document.location.href = 'login.php';
          </script>";
  } else {
    echo 'user gagal ditambahkan!';
  };
}
?>

<!DOCTYPE html>
<html lang="en">

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
      <div class="container-fluid">
        <div class="text-center mb-4">
          <img src="img/logo.png" alt="Logo RSIY PDHI" class="img-fluid mx-auto d-block" style="max-width: 100px;">
          <h2 class="mt-3">Tambah User Baru</h2>
        </div>

        <div class="row justify-content-center">
          <div class="col-md-6 col-lg-5">
            <form action="" method="POST" class="border p-4 rounded bg-white shadow-sm">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" autofocus autocomplete="off" required>
              </div>
              <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" required>
              </div>
              <div class="mb-3">
                <label for="password1" class="form-label">Password</label>
                <input type="password" name="password1" id="password1" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="password2" class="form-label">Konfirmasi Password</label>
                <input type="password" name="password2" id="password2" class="form-control" required>
              </div>

              <button type="submit" name="registrasi" class="btn btn-primary w-100">Daftar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/script.js"></script>
</body>


</html>