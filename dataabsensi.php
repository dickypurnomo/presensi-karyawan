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

// Periksa apakah tombol Delete diklik
if ($_GET['delete']) {
  $id = $_GET['delete'];

  // Hapus data dari tabel absensi berdasarkan id
  $DeleteDataAbsensi = "DELETE FROM absen WHERE id='$id'";
  mysqli_query($conn, $DeleteDataAbsensi);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Absensi</title>
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
            <a class="nav-link" href="tambahdivisi.php">
              <span data-feather="user-plus"></span>
              Tambah Divisi
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
      <h2>Data Absensi</h2>
      <?php 
      if ($_GET['delete']) {
          echo "
          <div class='alert alert-success' role='alert'>
            Data berhasil dihapus!
          </div>";
      }
      ?>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Nama</th>
              <th scope="col">Divisi</th>
              <th scope="col">Status</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Jam</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php
    // Ambil data dari tabel absensi
    $AmbilDataAbsensi = "SELECT * FROM absen";
    $resultAbsensi = mysqli_query($conn, $AmbilDataAbsensi);

    while ($rowAbsensi = mysqli_fetch_assoc($resultAbsensi)) {
        echo "<tr>";
        echo "<td>" . $rowAbsensi['nama'] . "</td>";
        echo "<td>" . $rowAbsensi['divisi'] . "</td>";
        echo "<td>" . $rowAbsensi['status'] . "</td>";
        echo "<td>" . $rowAbsensi['tanggal'] . "</td>";
        echo "<td>" . $rowAbsensi['jam'] . "</td>";
        echo "<td>
        <a href='editabsensi.php?id=" . $rowAbsensi['id'] . "' class='text-dark'><span data-feather='edit'></span></a>
        <a href='dataabsensi.php?delete=" . $rowAbsensi['id'] . "' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\" class='text-dark'><span data-feather='trash-2'></span></a>
    </td>";
        echo "</tr>";
    }
    ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
      <script src="script/dashboard.js"></script>
  </body>
</html>