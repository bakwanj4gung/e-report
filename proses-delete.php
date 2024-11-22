<?php
session_start(); // -> harus ditambahkan ketika menggunakan session

// REDIRECT USER YANG SUDAH BELUM LOGIN KE HALAMAN LOGIN
if ( !isset($_SESSION['login']) ) {
    header('Location: auth/login.php');
    exit;
}

require('koneksi.php');

// CEK APAKAH ADA VARIABLE $_POST['id'] DAN VARIABLE TERSEBUT TIDAK KOSONG
if ( isset($_POST['id']) && !empty($_POST['id']) ) {
    // TANGKAP id LALU TARUH DI VARIABLE $id
    $id = $_POST['id'];

    // HAPUS DATA BERDASARKAN $id
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