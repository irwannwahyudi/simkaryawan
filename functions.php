<?php

function koneksi()
{
  return mysqli_connect('localhost', 'root', '', 'simkaryawan');
}

function query($query)
{
  $conn = koneksi();
  $result = mysqli_query($conn, $query);

  # jika data hanya 1
  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  }
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function upload()
{
  // var_dump($_FILES);
  // die;

  $nama_file = $_FILES['gambar']['name'];
  $tipe_file = $_FILES['gambar']['type'];
  $ukuran_file = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmp_file = $_FILES['gambar']['tmp_name'];

  // ketika tidak ada gambar yang dipilih
  if ($error == 4) {
    // echo "<script>
    //         alert('pilih gambar terlebih dahulu!');
    //       </script>";

    return 'nophoto.jpg';
  }

  //cek ekstensi file
  $daftar_gambar = ['jpg', 'jpeg', 'png'];
  $ekstensi_file = explode('.', $nama_file);
  $ekstensi_file = strtolower(end($ekstensi_file));
  // var_dump($ekstensi_file);
  // die;
  if (!in_array($ekstensi_file, $daftar_gambar)) {
    echo "<script>
            alert('yang anda pilih bukan gambar');
          </script>";
    return false;
  }

  //cek tipe file
  if ($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
    echo "<script>
            alert('yang anda pilih bukan gambar');
          </script>";
    return false;
  }

  //cek ukuran file
  // maksimal 5Mb = 5000000
  if ($ukuran_file > 5000000) {
    echo "<script>
            alert('Ukuran terlalu besar. Maksimal ukuran file adalah 5MB.');
          </script>";
    return false;
  }


  //lolos pengecekan
  //siap upload file
  // generate nama file baru
  $nama_file_baru = uniqid();
  $nama_file_baru .= '.';
  $nama_file_baru .= $ekstensi_file;
  move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);

  return $nama_file_baru;
}

function tambah($data)
{
  $conn = koneksi();
  $nama = htmlspecialchars($data['nama']);
  $nik = htmlspecialchars($data['nik']);
  $kelamin = htmlspecialchars($data['kelamin']);
  $divisi = htmlspecialchars($data['divisi']);
  $tempat = htmlspecialchars($data['tempat']);
  $lahir = htmlspecialchars($data['lahir']);
  $pendidikan = htmlspecialchars($data['pendidikan']);
  $telepon = htmlspecialchars($data['telepon']);
  $alamat = htmlspecialchars($data['alamat']);
  $agama = htmlspecialchars($data['agama']);
  $daftar = htmlspecialchars($data['daftar']);
  // $gambar = htmlspecialchars($data['gambar']);
  //upload gambar
  $gambar = upload();
  if (!$gambar) {
    return false;
  }
  $query = "INSERT INTO
              karyawan
              VALUES 
              ('','$nama', '$nik', '$kelamin', '$divisi', '$tempat', '$lahir', '$pendidikan', '$telepon', '$alamat', '$agama', '$daftar', '$gambar');
              ";
  mysqli_query($conn, $query);
  echo mysqli_error($conn);
  return mysqli_affected_rows($conn);
}

function hapus($id)
{
  $conn = koneksi();

  //menghapus gambar di folder img
  $mhs = query("SELECT * FROM karyawan WHERE id = $id");
  if ($mhs['gambar'] != 'nophoto.jpg') {
    unlink('img/' . $mhs['gambar']);
  }

  mysqli_query($conn, "DELETE FROM karyawan WHERE id=$id");
  return mysqli_affected_rows($conn);
}

function ubah($data)
{
  $conn = koneksi();
  $id = $data['id'];
  $nama = htmlspecialchars($data['nama']);
  $nik = htmlspecialchars($data['nik']);
  $kelamin = htmlspecialchars($data['kelamin']);
  $divisi = htmlspecialchars($data['divisi']);
  $tempat = htmlspecialchars($data['tempat']);
  $lahir = htmlspecialchars($data['lahir']);
  $pendidikan = htmlspecialchars($data['pendidikan']);
  $telepon = htmlspecialchars($data['telepon']);
  $alamat = htmlspecialchars($data['alamat']);
  $agama = htmlspecialchars($data['agama']);
  $daftar = htmlspecialchars($data['daftar']);
  $gambar_lama = htmlspecialchars($data['gambar_lama']);

  $gambar = upload();
  if (!$gambar) {
    return false;
  }

  if ($gambar == 'nophoto.jpg') {
    $gambar = $gambar_lama;
  }

  $query = "UPDATE karyawan SET
              nama = '$nama',
              nik = '$nik',
              kelamin = '$kelamin',
              divisi = '$divisi',
              tempat = '$tempat',
              lahir = '$lahir',
              pendidikan = '$pendidikan',
              telepon = '$telepon',
              alamat = '$alamat',
              agama = '$agama',
              daftar = '$daftar',
              gambar = '$gambar'
            WHERE id='$id'";
  mysqli_query($conn, $query);
  echo mysqli_error($conn);
  return mysqli_affected_rows($conn);
}

function cari($keyword)
{
  $conn = koneksi();
  $query = "SELECT * FROM karyawan
            WHERE
            nama LIKE '%$keyword%' OR
            nik LIKE '%$keyword%'";
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function login($data)
{
  $conn = koneksi();

  $username = htmlspecialchars($data['username']);
  $password = htmlspecialchars($data['password']);

  // cek dulu username
  if ($user = query("SELECT * FROM user WHERE username = '$username'")) {
    //cek password
    if (password_verify($password, $user['password'])) {
      //set session
      $_SESSION['login'] = true;

      header("Location: index.php");
      exit;
    }
  }
  return [
    'error' => true,
    'pesan' => 'Username / Password Salah!'
  ];
}

function registrasi($data)
{
  $conn = koneksi();
  // Tambahkan ini
  $username = htmlspecialchars(strtolower($data['username']));
  $nama = htmlspecialchars($data['nama']);
  $password1 = mysqli_real_escape_string($conn, $data['password1']);
  $password2 = mysqli_real_escape_string($conn, $data['password2']);

  if (empty($username) || empty($nama) || empty($password1) || empty($password2)) {
    echo "<script>
            alert('semua field wajib diisi!');
            document.location.href = 'registrasi.php';
          </script>";
    return false;
  }

  if (query("SELECT * FROM user WHERE username = '$username'")) {
    echo "<script>
            alert('username sudah terdaftar!');
            document.location.href = 'registrasi.php';
          </script>";
    return false;
  }

  if ($password1 !== $password2) {
    echo "<script>
            alert('Konfirmasi password tidak sesuai!');
            document.location.href = 'registrasi.php';
          </script>";
    return false;
  }

  if (strlen($password1) < 4) {
    echo "<script>
            alert('Password terlalu pendek!');
            document.location.href = 'registrasi.php';
          </script>";
    return false;
  }

  $password_baru = password_hash($password1, PASSWORD_DEFAULT);

  // ✅ Tambahkan kolom nama_lengkap di sini
  $query = "INSERT INTO user 
              (id, username, nama, password) 
            VALUES 
              (NULL, '$username', '$nama', '$password_baru')";
  mysqli_query($conn, $query) or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);
}
