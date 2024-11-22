<?php
session_start(); // -> harus ditambahkan setiap kali menggunakan session

// REDIRECT USER YANG SUDAH LOGIN KE INDEX
if ( isset($_SESSION['login']) ) { // -> APAKAH $_SESSION['LOGIN'] SUDAH DIDEKLARASI?
    header('Location: ../index.php');
    exit;
}

include('functions.php'); // -> MENYERTAKAN FILE LAIN KE FILE INI

if( isset($_POST['register']) ) { // -> APAKAH $POST['register'] SUDAH DIDEKLARASI?
    register($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            label, button {
                display: block;
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <h1>DAFTAR AKUN ANDA</h1>
        <!-- PAKAI METHOD POST AGAR DATA YANG DIKIRIMKAN AMAN -->
        <form action="" method="post">
            <ul>
                <li>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </li>
                <li>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="pw" required>
                </li>
                <li>
                    <label for="password2">Confirm Password</label>
                    <input type="password" id="password2" name="pw2" required>
                </li>
                <li>
                    <button type="submit" name="register">BUAT AKUN</button>
                </li>
            </ul>
        </form>
    </body>
</html>