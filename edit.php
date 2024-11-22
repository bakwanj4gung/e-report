<?php
require('koneksi.php'); // -> KONEKSI SELALU DICANTUMKAN
$id = $_GET['id'];
// $query = 'UPDATE table_name SET colmn1= "data for colmn1", .... WHERE id = $id'

$queryData = "SELECT * FROM profiles WHERE id = $id"; // -> sintaks sql untuk ambil data spesifik
$result = mysqli_query($conn, $queryData);

while($loop = mysqli_fetch_assoc($result)) {
    $data = $loop;
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    $asal = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];

    $result = mysqli_query(
        $conn,
        "UPDATE profiles SET 
        nama='$nama', nis=$nis, kelas='$kelas', asal='$asal', tanggal_lahir='$tanggal_lahir'
        WHERE id=$id"
    );

    if($result) {
        echo "<script>
            alert('Data berhasil diupdate');
            document.location.href='index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal diupdate');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EDIT DATA</title>
    </head>
    <body>
        <h1>EDIT DATA <?= htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8') ?></h1>
        <form action="" method="post">
            <div>
                <label for="nama">Nama: </label>
                <!-- htmlspecialchars() => untuk escape HTML Special Character.
                Baca: https://www.w3schools.com/html/html_symbols.asp -->
                <input type="text" name="nama" id="nama" value="<?= htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <div>
                <label for="nis">NIS: </label>
                <input type="number" name="nis" id="nis" value="<?= htmlspecialchars($data['nis'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <div>
                <label for="kelas">Kelas: </label>
                <input type="text" name="kelas" id="kelas" value="<?= htmlspecialchars($data['kelas'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <div>
                <label for="alamat">Alamat: </label>
                <input type="text" name="alamat" id="alamat" value="<?= htmlspecialchars($data['asal'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <div>
                <label for="tanggal lahir">Tanggal Lahir: </label>
                <input type="date" name="tanggal_lahir" id="tanggal lahir" value="<?= htmlspecialchars($data['tanggal_lahir'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <button type="submit" name="submit">
                SIMPAN
            </button>
        </form>
    </body>
</html>