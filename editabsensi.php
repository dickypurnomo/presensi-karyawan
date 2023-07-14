<?php
session_start();
error_reporting(0);
$conn = mysqli_connect('localhost', 'root', '', 'presensi');

// Periksa status login admin
if ($_SESSION['isAdmin'] != true) {
  header("Location: login.php");
  exit();
}

  // Logout
  if ($_GET['logout']) {
    session_destroy();
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$AmbilDataAbsensi = "SELECT * FROM absen WHERE id = '$id'";
$resultAbsensi = mysqli_query($conn, $AmbilDataAbsensi);
$rowAbsensi = mysqli_fetch_assoc($resultAbsensi);

// Periksa apakah tombol Submit/Update diklik
if ($_POST['update']) {
  $status = $_POST['status'];
  $tanggal = $_POST['tanggal'];
  $jam = $_POST['jam'];

  // Update data di tabel absensi dengan membatasi hanya data dengan ID yang sesuai
  $UpdateDataAbsensi = "UPDATE absen SET status='$status', tanggal='$tanggal', jam='$jam' WHERE id='$id'";
  mysqli_query($conn, $UpdateDataAbsensi);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Absensi</title>
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
            <a class="nav-link" href="dashboard.php">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tambahkaryawan.php">
              <span data-feather="user-plus"></span>
              Tambah Data Karyawan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="datakaryawan.php">
              <span data-feather="users"></span>
              Data Karyawan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="datauser.php">
              <span data-feather="users"></span>
              Data Users
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dataabsensi.php">
              <span data-feather="file-text"></span>
              Data Absensi
            </a>
          </li>
            </ul>
        </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3 pb-2 mb-3">
      <h2>Edit Data Karyawan</h2>
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
        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $rowAbsensi['nama']; ?>" disabled>
        </div>
        <div class="mb-3">
        <label for="divisi" class="form-label">Divisi:</label>
        <input type="text" class="form-control" name="divisi" value="<?php echo $rowAbsensi['divisi']; ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select class="form-select" name="status">
                <option disabled selected>Pilih status presensi</option>
                <option value="Hadir" <?php if ($rowAbsensi['status'] == 'Hadir') echo 'selected'; ?>>Hadir</option>
                <option value="Izin" <?php if ($rowAbsensi['status'] == 'Izin') echo 'selected'; ?>>Izin</option>
                <option value="Sakit" <?php if ($rowAbsensi['status'] == 'Sakit') echo 'selected'; ?>>Sakit</option>
                <option value="Cuti" <?php if ($rowAbsensi['status'] == 'Cuti') echo 'selected'; ?>>Cuti</option>
            </select>
        </div>
        <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal:</label>
        <input type="date('Y-m-d')" class="form-control" id="tanggal" name="tanggal" value="<?php echo $rowAbsensi['tanggal']; ?>">
        </div>
        <div class="mb-3">
        <label for="jam" class="form-label">Jam:</label>
        <input type="date('H:i:s')" class="form-control" id="jam" name="jam" value="<?php echo $rowAbsensi['jam']; ?>">
        </div>
        <div class="col-12">
    <button type="submit" class="btn btn-primary" name="update" value="Tambah Data">Simpan</button>
    <a href="dataabsensi.php" class="btn btn-secondary">Kembali</a>
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