<?php
session_start();
error_reporting(0);
$conn = mysqli_connect('localhost', 'root', '', 'presensi');


// Digunakan untuk Logout
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

// Cek jika tombol Submit diklik
if ($_POST['submit']) {
    $nama_presensi = $nama;
    $divisi_presensi = $divisi;
    $status_presensi = $_POST['status'];
    $jam = date('H:i:s');
    $tanggal = date('Y-m-d');

    // Simpan data presensi ke database
    $InsertDataPresensi = "INSERT INTO absen (nama, divisi, status, tanggal, jam) VALUES ('$nama_presensi', '$divisi_presensi', '$status_presensi', '$tanggal', '$jam')";
    mysqli_query($conn, $InsertDataPresensi);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Presensi</title>
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
        <h1 class="h2">Presensi</h1>
    <?php 
    if ($_POST['submit']) {
        echo '
        <div class="alert alert-success" role="alert">
            Terima kasih untuk presensinya
        </div>';
    }
    ?>
      <form action="" method="POST">
        <div class="mb-3">
        <label for="nama" class="form-label">Nama:</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>" disabled>
        </div>
        <div class="mb-3">
        <label for="nama" class="form-label">Divisi:</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $divisi; ?>" disabled>
        </div>
        <div class="mb-3">
        <label for="status" class="form-label">Status Presensi:</label>
        <select class="form-select" name="status" required>
        <option disabled selected>Pilih status presensi</option>
                <option value="Hadir">Hadir</option>
                <option value="Izin">Izin</option>
                <option value="Sakit">Sakit</option>
                <option value="Cuti">Cuti</option>
        </select>
        </div>
        <div class="col-12 my-3">
    <button type="submit" class="btn btn-primary" name="submit" value="Presensi">Presensi</button>
  </div>    
</form>
      </div>
    </main>
  </div>
</div>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
      <script src="script/dashboard.js"></script>
  </body>
</html>