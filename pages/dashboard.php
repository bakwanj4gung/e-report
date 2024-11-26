<?php
session_start();
if ( !isset($_SESSION['login']) && $_SESSION['login'] !== 'Sudah Login' ) {
    header('Location: auth/login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="../style/dashboard.css">
</head>
<body>
    <?php include_once('../layout/navbar.php') ?>
    <main class="content">
        <h1>Selamat Datang, <?=$_SESSION['nama'] ?>!</h1>
        <p class="offer1">Silakan pilih menu <a href="add.php">Ajukan Pengaduan</a> untuk mengajukan pengaduan.</p>
        <a href="view.php" class="offer2">Lihat Proses Pengaduan Anda</a>
    </main>
</body>
</html>