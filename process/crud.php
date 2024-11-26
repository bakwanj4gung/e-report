<?php
require('connection.php');

function read() {
    global $conn;
    $id = $_SESSION['id'];
    $result = mysqli_query($conn, "SELECT * FROM reports WHERE user_id = '$id'");
    if ($result) {
        return $result;
    } else {
        return false;
    }
}

function view($id) {
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM reports WHERE id = '$id'");
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            return $row;
        }
    } else {
        return false;
    }
}

function create($request) {
    if (!isset($_SESSION['login']) || $_SESSION['login'] !== 'Sudah Login') {
        header('Location: auth/login.php');
        exit;
    }

    global $conn;
    $id = '';
    $user_id = $_SESSION['id'];
    $subjek = htmlspecialchars($request['subject'], ENT_QUOTES, 'UTF-8');
    $tgl = htmlspecialchars($request['date'], ENT_QUOTES, 'UTF-8');
    $pihak = htmlspecialchars($request['party'], ENT_QUOTES, 'UTF-8');
    $deskripsi = htmlspecialchars($request['desc'], ENT_QUOTES, 'UTF-8');

    $result = mysqli_query(
        $conn, 
        "INSERT INTO reports(id, user_id,subject, date, party, description)
            VALUES ('$id', $user_id,'$subjek', '$tgl', '$pihak', '$deskripsi' )"
    );

    if ($result) {
        return [
            'error' => false,
            'message' => 'Pengaduan berhasil dikirim'
        ];
    } else {
        return [
            'error' => true,
            'message' => 'Pengaduan gagal dikirim'
        ];
    }
}

function edit($request, $id) {
    if (!isset($_SESSION['login']) || $_SESSION['login'] !== 'Sudah Login') {
        header('Location: auth/login.php');
        exit;
    }

    global $conn;
    $subjek = htmlspecialchars($request['subject'], ENT_QUOTES, 'UTF-8');
    $tgl = htmlspecialchars($request['date'], ENT_QUOTES, 'UTF-8');
    $pihak = htmlspecialchars($request['party'], ENT_QUOTES, 'UTF-8');
    $deskripsi = htmlspecialchars($request['desc'], ENT_QUOTES, 'UTF-8');

    $result = mysqli_query(
        $conn, 
        "UPDATE reports
            SET subject = '$subjek', date = '$tgl', party = '$pihak', description = '$deskripsi'
            WHERE id = '$id'"
    );

    if ($result) {
        return [
            'error' => false,
            'message' => 'Pengaduan berhasil diubah'
        ];
    } else {
        return [
            'error' => true,
            'message' => 'Pengaduan gagal diubah'
        ];
    }
}

function delete($request) {
    global $conn;
    $id = $request['id'];

    if (!isset($_SESSION['login']) || $_SESSION['login'] !== 'Sudah Login') {
        header('Location: auth/login.php');
        exit;
    }

    $result = mysqli_query(
        $conn, 
        "DELETE FROM reports WHERE id = '$id'"
    );

    if ($result) {
        return [
            'error' => false,
            'message' => 'Pengaduan berhasil dihapus'
        ];  
    } else {
        return [
            'error' => true,
            'message' => 'Pengaduan gagal dihapus'
        ];
    }
}