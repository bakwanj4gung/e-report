<?php
session_start();

if ( !isset($_SESSION['login']) && $_SESSION['login'] !== 'Sudah Login' ) {
    header('Location: ../pages/auth/login.php');
    exit;
}

require('crud.php');

if ( isset($_POST['id']) && !empty($_POST['id']) ) {
    $id = $_POST['id'];

    $result = mysqli_query($conn, "DELETE FROM reports WHERE id = $id");

    if($result) {
        echo "<script>
            alert('Data berhasil dihapus');
            window.location.replace('../pages/view.php');
        </script>";
    } else {
        echo "<script>
            alert('Data gagal dihapus');
            window.location.replace('../pages/view.php');
        </script>";
    }
}