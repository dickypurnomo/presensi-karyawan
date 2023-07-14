<?php
session_start();
error_reporting(0);
$conn = mysqli_connect('localhost', 'root', '', 'presensi');

$username = $_POST['username'];
$password = $_POST['password'];
$submit = $_POST['submit'];

//Cek tombol login
if ($submit) {
    $AmbilDataUser = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $query = mysqli_query($conn, $AmbilDataUser);
    $row = mysqli_fetch_array($query);

    if (!empty($row)) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['isAdmin'] = $row['isAdmin'];

        if ($_SESSION['isAdmin']) {
            header("Location: dashboard.php");
            exit();
        } else {
            header("Location: presensi.php");
            exit();
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Sign In</title>
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">

<main class="form-signin">
  <form method='post' action='login.php'>
  <img class="mb-4" src="assets/KirinTech.svg" alt="" style="width: 144px; height: 114px;">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
      <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
      <label for="username">Username</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      <label for="password">Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit" name='submit' value='LOGIN'>Sign in</button>
  </form>
</main>
</body>
</html>
