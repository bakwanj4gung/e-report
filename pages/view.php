<?php
session_start();
if ( !isset($_SESSION['login']) && $_SESSION['login'] !== 'Sudah Login' ) {
    header('Location: auth/login.php');
    exit;
}

require_once('../process/crud.php');

$reports = read();
$i = 1;

$formatter = new IntlDateFormatter(
    'id_ID',
    IntlDateFormatter::FULL, 
    IntlDateFormatter::NONE 
);
// object, so use [->]
$formatter->setPattern('EEEE, dd MMMM yyyy'); 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Pengaduan</title>
    <link rel="stylesheet" href="../style/view.css">
</head>
<body>
    <?php include_once('../layout/navbar.php') ?>
    <main class="content">
        <h1>Daftar Pengajuan Anda</h1>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal Pengaduan</th>
                    <th>Tanggal Kejadian</th>
                    <th>Subjek</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if( mysqli_num_rows($reports) < 1 ) { ?>
                    <tr>
                        <td colspan="5" text-align="center"> Tidak Ada Data </td>
                    </tr>
                <?php } ?>
                <?php while ($row = mysqli_fetch_assoc($reports)) {  ?>
                    <?php //make new object time with data from db 
                    $uploadDate = new DateTime($row['upload_date']); 
                    $incidentDate = new DateTime($row['date']); 
                    ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $formatter->format($uploadDate); ?></td>
                    <td><?= $formatter->format($incidentDate); ?></td>
                    <td><?= $row['subject'] ?></td>
                    <td>
                        <form title="Edit Pengajuan" action="edit.php" method="get">
                            <input type="hidden" name="id" readonly value=<?= $row['id'] ?>>
                            <button type="submit"><?php include("../assets/image/edit.svg") ?></button>
                        </form>
                        <form id="delete" title="Hapus Pengajuan" action="../process/delete.php" method="post">
                        <input type="hidden" name="id" readonly value=<?= $row['id'] ?>>
                            <button onclick="confirmDelete(event)" type="submit"><?php include("../assets/image/delete.svg") ?></button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
                
            </tbody>
        </table>
    </main>
</body>
<script>
function confirmDelete(event) {
    if (confirm("Are you sure you want to delete this data?")) {
        document.querySelector("#delete").submit();
    } else {
        
        event.preventDefault();
    }
}
</script>
</html>