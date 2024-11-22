<?php
// HALAMAN INI HANYA MELAKUKAN PROSES HAPUS $_SESSION SAJA.
session_start();

// HAPUS SEMUA VARIABLE $_SESSION YANG SUDAH DIBUAT
session_unset(); 

// HANCURKAN SEMUA VARIABLE $_SESSION
session_destroy();

header('Location: login.php');
exit;