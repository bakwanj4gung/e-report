<?php
session_start(); // -> harus ditambahkan ketika menggunakan session

// REDIRECT USER YANG SUDAH BELUM LOGIN KE HALAMAN LOGIN
if ( !isset($_SESSION['login']) ) {
    header('Location: auth/login.php');
    exit;
}

require('koneksi.php');

if ( isset($_POST['id']) && !empty($_POST['id']) ) {
    // TANGKAP ID LALU TARUH DI VARIABLE
    $id = $_POST['id'];

    // HAPUS DATA BERDASARKAN ID
    $result = mysqli_query($conn, "DELETE FROM profiles WHERE id = $id");

    if($result) {
        echo "<script>
            alert('Data berhasil dihapus');
            window.location.replace('index.php');
        </script>";
    } else {
        echo "<script>
            alert('Data gagal dihapus');
            window.location.replace('index.php');
        </script>";
    }
}