<?php
session_start();
if ( isset($_SESSION['login']) && $_SESSION['login'] === 'Sudah Login' ) {
    header('Location: ../dashboard.php');
    exit;
}

require '../../process/auth.php';

if (isset($_POST['login'])) {
    $response = login($_POST);

    if (!$response['error']) {
        header('Location: ../dashboard.php');
        exit;
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
                        <?php if( isset($response['errorEmail']) ) { ?><p class="important"><?= $response['messageEmail'] ?></p><?php } ?>
                    </div>
                    <div>
                        <label for="pw">Password</label>
                        <input type="password" name="pw" id="pw" required>
                        <?php if( isset($response['errorPw']) ) { ?><p class="important"><?= $response['messagePw'] ?></p><?php } ?>
                    </div>
                    <div>
                        <button class="button1" type="submit" name="login">Masuk</button>
                    </div>
                </form>
                <p class="regis-offer">Belum memiliki akun? <a href="register.php">Daftar Sekarang!</a></p>
        </main>
    </body>
</html>