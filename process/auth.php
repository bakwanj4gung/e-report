<?php
require_once('connection.php');

function register($request) {
    global $conn;
    $name   = trim($request['name']);
    $email  = filter_var(strtolower(trim($request['email'])), FILTER_SANITIZE_EMAIL);
    $pw = mysqli_real_escape_string($conn, $request['pw']);
    $pw2 = mysqli_real_escape_string($conn, $request['pw2']);

    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return [
            'error' => true, 
            'message' => 'Email tidak valid.'
        ];
    }

    $fetchUser = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if( mysqli_num_rows($fetchUser) > 0 ) {
        return [
            'error' => true, 
            'message' => 'Email sudah digunakan. Coba email lain'
        ];
    }

    if ($pw !== $pw2) {
        return [
            'error' => true, 
            'message' => 'Password tidak cocok.'
        ];
    }

    $pw = password_hash($pw, PASSWORD_DEFAULT);
    $pw2 = password_hash($pw2, PASSWORD_DEFAULT);

    $result = mysqli_query($conn, "INSERT INTO users (id, name, email, password) VALUES('', '$name', '$email', '$pw')");
    
    if($result) {
        return [
            'error' => false, 
            'message' => 'Berhasil melakukan registrasi. Silakan menuju ke halaman login.'
        ];
    } else {
        return [
            'error' => true, 
            'message' => 'Terjadi kesalahan saat menyimpan data.'
        ];
    }
}

function login($request) {
    global $conn;

    $email = filter_var(strtolower(trim($request['email'])), FILTER_SANITIZE_EMAIL);
    $pw = mysqli_real_escape_string($conn, $request['pw']);

    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return [
            'error' => true, 
            'message' => 'Email tidak valid.'
        ];
    }

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

    if(mysqli_num_rows($result) === 1) {

        $dataFetch = mysqli_fetch_assoc($result);
        if( password_verify($pw, $dataFetch['password']) ) {

            if ( $dataFetch['role'] === 1 ) {
                $_SESSION['atmin'] = 'Saia Atmin';
                $_SESSION['login'] = 'Sudah Login';
            } else {
                $_SESSION['user'] = 'Saia User';
                $_SESSION['login'] = 'Sudah Login';
            }
            $_SESSION['id'] = $dataFetch['id'];
            $_SESSION['nama'] = $dataFetch['name'];
            $_SESSION['email'] = $dataFetch['email'];
            header('Location: ../dashboard.php');
            exit;
        } else {
            return [
                'error' => true, 
                'message' => 'Password tidak valid.'
            ];
        }
    } else {
        return [
            'error' => true, 
            'message' => 'Email salah.'
        ];
    }
}