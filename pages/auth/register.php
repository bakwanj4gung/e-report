<?php
session_start();
if ( isset($_SESSION['login']) && $_SESSION['login'] === 'Sudah Login' ) {
    header('Location: ../dashboard.php');
    exit;
}

require_once('../../process/auth.php');

if (isset($_POST['register'])) {
    $response = register($_POST);
    $message = $response['message'];

    if ($response['error']) {
        echo "<script>alert('$message');</script>";
    } else {
        echo 
        "<script>
                alert('$message');
                window.location.replace('login.php');
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
        <main>
            <div class="auth-card">
                <h1>Selamat Datang!</h1>
                <form action="" method="post">
                    <div>
                        <label for="nama">Nama</label>
                        <input type="text" name="name" id="nama" placeholder="Stephen Jhon" required>
                        <p class="important">pesan error</p>
                    </div>
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
                        <label for="pw2">Konfimasi Password</label>
                        <input type="password" name="pw2" id="pw2" required>
                        <p class="important">pesan error</p>
                    </div>
                    <div>
                        <button class="button1" type="submit" name="register">Daftar</button>
                    </div>
                </form>
                <p class="regis-offer">Sudah memiliki akun? <a href="login.php">Masuk</a></p>
            </div>
        </main>
    </body>
</html>