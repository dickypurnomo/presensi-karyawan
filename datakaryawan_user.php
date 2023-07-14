<?php
session_start();
error_reporting(0);
$conn = mysqli_connect('localhost', 'root', '', 'presensi');

  // Logout
  if ($_GET['logout']) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Ambil username pengguna yang login
$username = $_SESSION['username'];

// Gunakan username untuk mengambil ID dari tabel user
$AmbilDataUser = "SELECT id FROM user WHERE username='$username'";
$result = mysqli_query($conn, $AmbilDataUser);
$row = mysqli_fetch_assoc($result);
$id = $row['id'];

// Mendapatkan data pengguna dari database
$AmbilDataKaryawan = "SELECT * FROM karyawan WHERE id = $id";
$result = mysqli_query($conn, $AmbilDataKaryawan);
$row = mysqli_fetch_assoc($result);

$nama = $row['nama'];
$divisi = $row['divisi'];
$nomor_telepon = $row['nomor_telepon'];
$alamat = $row['alamat'];

// Periksa apakah tombol Submit/Update diklik
if ($_POST['update']) {
  $nomor_telepon = $_POST['nomor_telepon'];
  $alamat = $_POST['alamat'];

  // Update data di tabel member berdasarkan ID
  $UpdateDataKaryawan = "UPDATE karyawan SET nomor_telepon='$nomor_telepon', alamat='$alamat' WHERE id='$id'";
  mysqli_query($conn, $UpdateDataKaryawan);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Kirin Technology</a>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="?logout=true">Logout <span data-feather="log-out"></span></a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="presensi.php">
              <span data-feather="check-square"></span>
              Presensi
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="datakaryawan_user.php">
              <span data-feather="users"></span>
              Data Karyawan
            </a>
          </li>
            </ul>
        </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3 pb-2 mb-3">
      <h2>Data Karyawan</h2>
      <?php
      // Alert jika data berhasil diperbarui
if ($_POST['update']) {
    echo '
    <div class="alert alert-success" role="alert">
        Data berhasil diperbarui!
    </div>';
}
?>
      <form action="" method="POST">
        <div class="mb-3">
        <label for="nama" class="form-label">Nama:</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" disabled>
        </div>
        <div class="mb-3">
        <label for="divisi" class="form-label">Divisi:</label>
        <input type="text" class="form-control" id="divisi" name="divisi" value="<?php echo $row['divisi']; ?>" disabled>
        </div>
        <div class="mb-3">
        <label for="nomor_telepon" class="form-label">Nomor Telepon:</label>
        <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="<?php echo $row['nomor_telepon']; ?>">
        </div>
        <div class="mb-3">
        <label for="alamat" class="form-label">Alamat:</label>
        <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>">
        </div>
        <div class="col-12">
    <button type="submit" class="btn btn-primary" name="update" value="Tambah Data">Simpan</button>
  </div>    
</form>
    </main>
  </div>
</div>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="script/dashboard.js"></script>
  </body>
</html>

