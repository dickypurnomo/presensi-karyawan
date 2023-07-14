<?php
session_start();
error_reporting(0);

// Periksa sesi login sebagai admin
if ($_SESSION['isAdmin'] != true) {
  header("Location: login.php");
  exit();
}

// Digunakan untuk Logout
if ($_GET['logout']) {
  session_destroy();
  header("Location: login.php");
  exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
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
      <h2>Dashboard</h2>

    <div class="row align-items-md-stretch mb-3">
      <div class="col-md-6">
        <div class="h-100 p-5 bg-light rounded-3">
          <h2>Lorem Ipsum</h2>
          <p>Ea consectetur ex sint id ex excepteur incididunt ex tempor ut mollit. In excepteur qui velit anim consectetur veniam deserunt laborum. Labore aute culpa labore laboris.</p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="h-100 p-5 bg-light rounded-3">
          <h2>Lorem Ipsum</h2>
          <p>Cillum esse exercitation enim pariatur veniam. Ipsum ipsum officia fugiat ad aute ullamco tempor eu. Tempor deserunt minim nostrud cillum ipsum elit reprehenderit irure in officia aliquip enim.</p>
        </div>
      </div>
    </div>

    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Lorem Ipsum</h1>
        <p class="col-md-8 fs-4">Proident esse anim laboris voluptate mollit amet culpa. Irure excepteur non aliquip nostrud dolore ipsum elit ea. Amet ex sint enim dolor ullamco dolor enim incididunt dolor ad excepteur cillum officia. Amet qui fugiat qui excepteur et enim fugiat laborum. Culpa labore eiusmod cillum reprehenderit sit ut adipisicing aute culpa.</p>
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