<?php
session_start();
if ( isset($_SESSION['login']) && $_SESSION['login'] === 'Sudah Login' ) {
    header('Location: ../dashboard.php');
    exit;
}

require '../../process/auth.php';

if (isset($_POST['login'])) {
    $result = login($_POST);

    if ($result['error']) {
        echo "<script>
            alert('" . $result['message'] . "');
        </script>";
    }
}
?>

<!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Login</title>
        <link rel="stylesheet" href="../../style/auth.css">
    </head>
    <body>
        <main class="auth-card">
                <h1>Selamat Datang Kembali!</h1>
                <form action="" method="post">
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="stephen@email.com" required>
                        <p class="important">pesan error</p>
                    </div>
                    <div>
                        <label for="pw">Password</label>
                        <input type="password" name="pw" id="pw" required>
                        <p class="important">pesan error</p>
                    </div>
                    <div>
                        <button class="button1" type="submit" name="login">Masuk</button>
                    </div>
                </form>
                <p class="regis-offer">Belum memiliki akun? <a href="register.php">Daftar Sekarang!</a></p>
        </main>
    </body>
</html>