<?php
session_start(); // -> harus ditambahkan ketika menggunakan session

// REDIRECT USER YANG BELUM LOGIN KE HALAMAN LOGIN
if ( !isset($_SESSION['login']) ) { // -> APAKAH $_SESSION['LOGIN'] BELUM DIDEKLARASI?
    header('Location: auth/login.php');
    exit;
}

include('koneksi.php');

// CEK APAKAH TOMBOL SUBMIT SUDAH DIPENCET?
if(isset($_GET['submit'])) { // -> isset() => mengecek apakah variable $_GET['submit'] sudah dideklarasi atau belum
    
    $id = '';
    $nama = $_GET['nama']; // -> $_GET['nama'] berasal dari name="nama"
    $nis = $_GET['nis'];
    $asal = $_GET['alamat'];
    $kelas = $_GET['kelas'];
    $tanggal_lahir = $_GET['tanggal_lahir'];
    
    // QUERY INSERT DATA SANTRI.
    $result = mysqli_query(
        $conn, 
        "INSERT INTO profiles(id, nama, nis, kelas, asal, tanggal_lahir)
            VALUES ('$id', '$nama', '$nis', '$kelas', '$asal', '$tanggal_lahir')"
    );

    // CEK HASIL QUERY
    if ($result) {
        echo "<script>
            alert('Berhasil menambahkan data $nama');
            window.location.replace('index.php');
        </script>";
    } else {
        echo "<script>
            alert('Gagal menambahkan data.');
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>INSERT DATA</title>
    </head>
    <body>
        
        <!-- atribut action="" => mengarahkan data akan diolah dimana -->
        <!-- atribut method="" => memilih HTTP METHOD -->
        <form action="create.php" method="get">
            <div>
                <label for="nama">Nama: </label>
                <input type="text" name="nama" id="nama">
            </div>
            <div>
                <label for="nis">NIS: </label>
                <input type="number" name="nis" id="nis">
            </div>
            <div>
                <label for="kelas">Kelas: </label>
                <input type="text" name="kelas" id="kelas">
            </div>
            <div>
                <label for="alamat">Alamat: </label>
                <input type="text" name="alamat" id="alamat">
            </div>
            <div>
                <label for="tanggal lahir">Tanggal Lahir: </label>
                <input type="date" name="tanggal_lahir" id="tanggal lahir">
            </div>
            <button type="submit" name="submit">
                SIMPAN
            </button>
        </form>
    </body>
</html>