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

// Edit Data Divisi
if ($_POST['submit']) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];

    // Query untuk mengedit data divisi
    $query = "UPDATE divisi SET nama='$nama', deskripsi='$deskripsi' WHERE id='$id'";
    $result = mysqli_query($conn, $query);
}

// Ambil data divisi berdasarkan ID
$id = $_GET['id'];
$AmbilDataDivisi = "SELECT * FROM divisi WHERE id='$id'";
$result = mysqli_query($conn, $AmbilDataDivisi);
$row = mysqli_fetch_assoc($result);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Divisi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
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
            <h2 class="mb-3 border-bottom pb-3">Edit Data Divisi</h2>
            <?php
            if ($_POST['submit']) {
                echo '
          <div class="alert alert-success" role="alert">
          Data divisi berhasil diperbarui
          </div>';
            }
            ?>
            <h5>Edit Data Divisi</h5>
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Divisi:</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required
                           value="<?php echo $row['nama']; ?>">
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Divisi:</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi"
                              placeholder="Deskripsi"><?php echo $row['deskripsi']; ?></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary" name="submit" value="Simpan Perubahan">Simpan</button>
                    <a href="tambahdivisi.php" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </main>
    </div>
</div>

<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
    integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE"
    crossorigin="anonymous"></script>
<script src="script/dashboard.js"></script>
</body>
</html>
