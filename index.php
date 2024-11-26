<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pengaduan Pamijahan</title>
        <link rel="stylesheet" href="style/index.css">
    </head>
    <body>
        <main class="content1">
            <p class="sub1">Resah? Gundah? Ada Masalah?</p>
            <?php session_start(); ?>
            <p class="sub2">Write down your problem, our staff fix the problem</p>
            <?php if ( isset($_SESSION['login']) && $_SESSION['login'] === 'Sudah Login' ) { ?>
            <a href="pages/dashboard.php" class="login-offer">Menuju ke Halaman Utama</a>
            <?php } else { ?>
            <a href="pages/auth/login.php" class="login-offer">Login untuk melakukan pengaduan</a>
            <p class="regis-offer">Belum memiliki akun? <a href="pages/auth/register.php">Daftar Sekarang!</a></p>
            <?php } ?>
        </main>
    </body>
</html>