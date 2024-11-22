<?php
session_start(); // -> harus ditambahkan ketika menggunakan session

// REDIRECT USER YANG BELUM LOGIN KE HALAMAN LOGIN
if ( !isset($_SESSION['login']) ) { // -> APAKAH $_SESSION['LOGIN'] BELUM DIDEKLARASI?
    header('Location: auth/login.php');
    exit;
}

require('koneksi.php');
// include('koneksi.php');

// AMBIL DATA SANTRI / QUERY DATA SANTRI
// mysqli_query($conn, SQL SYNTAX)
// nama variable untuk menampung hasi query biasanya -> $result
$result = mysqli_query($conn, 'SELECT * FROM profiles'); // -> Inti Manipulasi data ada di QUERY

// VARIABLE UNTUK NOMOR
$i = 1;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Santri</title>
    </head>
    <body>
        <h1>Data Santri</h1>
        <p><a href="create.php">TAMBAH DATA BARU</a></p>
        <form action="auth/logout.php" method="post">
            <button type="submit">LOG OUT</button>
        </form>
        <table border="1" cellpadding="3" cellspacing="0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Aksi</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>Asal</th>
                    <th>Tanggal Lahir</th>
                </tr>
            </thead>
            <tbody>
                <?php while($baris = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $baris['id']?>">EDIT</a> |
                            <!-- MENGGUNAKAN POST AGAR ID YANG DIKIRIM TIDAK TERLIHAT -->
                            <!-- Proses delete terjadi di file proses-delete.php -->
                            <form action="proses-delete.php" method="post">
                                <!-- input tidak terlihat dan tidak bisa diubah, hanya untuk mengirim id -->
                                <input readonly type="hidden" name="id" value="<?= $baris['id'] ?>">
                                <button 
                                    style="background-color: transparent; display: inline; border: none; cursor:pointer" 
                                    type="submit" 
                                    name="delete"
                                >DELETE</button>
                            </form>
                        </td>
                        <td><?php echo $baris['nama'] ?></td>
                        <td><?php echo $baris['nis'] ?></td>
                        <td><?php echo $baris['kelas'] ?></td>
                        <td><?php echo $baris['asal'] ?></td>
                        <td><?php echo $baris['tanggal_lahir'] ?></td>
                    </tr>
                <?php $i++; } ?>
            </tbody>
        </table>
    </body>
</html>