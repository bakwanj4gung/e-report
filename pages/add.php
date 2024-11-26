<?php
session_start();
if ( !isset($_SESSION['login']) && $_SESSION['login'] !== 'Sudah Login' ) {
    header('Location: auth/login.php');
    exit;
}

require_once('../process/crud.php');

if (isset($_POST['send'])) {
    $response = create($_POST);
    $message = $response['message'];

    if ($response['error']) {
        echo "<script>alert('$message');</script>";
    } else {
        echo "<script>
                alert('$message');
                window.location.replace('view.php');
        </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Pengaduan</title>
    <link rel="stylesheet" href="../style/add.css">
</head>
<body>
    <?php include_once('../layout/navbar.php') ?>
    <main class="content">
        <h1>Formulir Pengajuan Pengaduan</h1>
        <form action="" method="post">
            <div>
                <label for="subject">Subjek <span class="important">*</span></label>
                <input type="text" name="subject" id="subject" placeholder="Tuliskan Subjek Pengaduan" required>
            </div>
            <div class="inputs">
                <div class="input1">
                    <label for="date">Tanggal Kejadian <span class="important">*</span></label>
                    <input type="date" name="date" id="date" placeholder="Tuliskan Subjek Pengaduan" required>
                </div>
                <div class="input1">
                    <label for="party">Pihak Terkait</label>
                    <select name="party" id="party">
                        <option value="" disabled selected> --Pilih Pihak Terkait(Opsional)-- </option>
                        <option value="General Affair">GA</option>
                        <option value="Dormitory SMP">Asrama SMP</option>
                        <option value="Dormitory SMA">Asrama SMA</option>
                        <option value="Curriculum SMP">Kurikulum SMP</option>
                        <option value="Curriculum SMA">Kurikulum SMA</option>
                    </select>
                </div>
            </div>
            <div>
                <label for="description">Deskripsi</label>
                <textarea rows="5" name="desc" id="description" placeholder="Tuliskan Deskripsi Pengaduan"></textarea>
            </div>
            <div>
                <button class="button1" type="submit" name="send">Kirim</button>
            </div>
        </form>
        <p class="important">* wajib diisi</p>
    </main>
</body>
</html>