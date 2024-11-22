<?php
try { 
    $conn = mysqli_connect('localhost', 'root', '', 'data-santri'); 
    if (!$conn) { 
        throw new Exception("Gagal melakukan koneksi. Silakan periksa konfigurasi server."); 
    }
} catch (Exception $error) {
    echo "Ada masalah di database. MySQL start? Nama Database? Kolom? Nama Host? Username? Password? <br>" . $error->getMessage(); 
    exit;
}