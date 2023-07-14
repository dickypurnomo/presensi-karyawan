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

// Tambah Data Divisi
if ($_POST['submit']) {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];

    // Query untuk menambah data ke tabel divisi
    $query = "INSERT INTO divisi (nama, deskripsi) VALUES ('$nama', '$deskripsi')";
    $result = mysqli_query($conn, $query);
}

// Periksa apakah tombol Delete diklik
if ($_GET['delete']) {
    $id = $_GET['delete'];

    // Hapus data dari tabel divisi berdasarkan id
    $DeleteDataUser = "DELETE FROM divisi WHERE id='$id'";
    mysqli_query($conn, $DeleteDataUser);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Divisi</title>
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
      <h2 class="mb-3 border-bottom pb-3">Tambah Data Divisi</h2>
      <?php
      if ($_POST['submit']) {
          echo '
          <div class="alert alert-success" role="alert">
          Divisi baru berhasil ditambahkan!
          </div>';
      }
      
      if ($_GET['delete']) {
        echo "
        <div class='alert alert-success' role='alert'>
          Data berhasil dihapus!
        </div>";
    }
      ?>
      <h5>Masukkan Data Divisi</h5>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Divisi:</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required autofocus>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Divisi:</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi" required></textarea>
            </div>
            <div class="col-12 border-bottom pb-3">
            <button type="submit" class="btn btn-primary" name="submit" value="Tambah Data">Tambah Data</button>
        </div>    
        </form>

        <div class="mt-4">
        <h5>Data Divisi</h5>
        <div class="table-responsive">
            <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Nama Divisi</th>
                <th scope="col" class="col-lg-10">Deskripsi</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM divisi";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['nama'] . '</td>';
                echo '<td>' . $row['deskripsi'] . '</td>';
                echo '<td>
                        <a href="editdivisi.php?id=' . $row['id'] . '"><span data-feather="edit" class="text-dark"></span></a>
                        <a href="tambahdivisi.php?delete=' . $row['id'] . '" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')" class="text-dark"><span data-feather="trash-2"></span></a>
                        </td>';
                echo '</tr>';
                }
                ?>
            </tbody>
            </table>
        </div>
        </div>
    </main>
  </div>
</div>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
      <script src="script/dashboard.js"></script>
  </body>
</html>