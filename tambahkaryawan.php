<?php
error_reporting(0);

session_start();
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

// Periksa apakah tombol Submit diklik
if ($_POST['submit']) {
    $nama = $_POST['nama'];
    $divisi = $_POST['divisi'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simpan data ke tabel karyawan
    $InsertDataKaryawan = "INSERT INTO karyawan ( nama, divisi, nomor_telepon, alamat) VALUES ( '$nama', '$divisi', '$nomor_telepon', '$alamat')";
    mysqli_query($conn, $InsertDataKaryawan);

    // Simpan data ke tabel user
    $InsertDataUser = "INSERT INTO user ( username, password, nama, divisi) VALUES ( '$username', '$password', '$nama', '$divisi')";
    mysqli_query($conn, $InsertDataUser);

    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Karyawan</title>
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
      <h2 class="mb-3 border-bottom pb-3">Tambah Data Karyawan</h2>
      <?php
      if ($_POST['submit']) {
          echo '
          <div class="alert alert-success" role="alert">
              <p><strong>Ini adalah data yang digunakan untuk Login :</strong></p>
              <p><strong>Username:</strong> ' . $_SESSION['username'] . '</p>
              <p><strong>Password:</strong> ' . $_SESSION['password'] . '</p>
          </div>';
      }  
      ?>
      <h5>Masukan Data Karyawan</h5>
      <form action="" method="POST">
        <div class="mb-3">
        <label for="nama" class="form-label">Nama:</label>
        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required autofocus>
        </div>
        <div class="mb-3">
            <label for="divisi" class="form-label">Divisi:</label>
            <select class="form-select" name="divisi" required>
                <option disabled selected>Silahkan pilih divisi</option>
                <?php
                // Query untuk mengambil data divisi dari tabel divisi
                $query = "SELECT nama FROM divisi";
                $result = mysqli_query($conn, $query);

                // Tampilkan data divisi sebagai pilihan dalam select
                while ($row = mysqli_fetch_assoc($result)) {
                    $namaDivisi = $row['nama']; 
                    echo '<option value="' . $namaDivisi . '">' . $namaDivisi . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
        <label for="nomor_telepon" class="form-label">Nomor Telepon:</label>
        <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="081212121212" required>
        </div>
        <div class="mb-3">
        <label for="alamat" class="form-label">Alamat:</label>
        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Indonesia" required>
        </div>
        <h5 class="my-3 border-top pt-3">Masukan Username dan Password Karyawan</h5>
        <div class="mb-3">
        <label for="username" class="form-label">Username:</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required unique>
        </div>
        <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input type="text" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="col-12">
    <button type="submit" class="btn btn-primary" name="submit" value="Tambah Data">Tambah Data</button>
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