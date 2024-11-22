<?php
require('../koneksi.php');

function register($request) {
    global $conn;
    // AMBIL EMAIL DARI INPUT LALU SIMPAN DI VARIABLE
    // Sanitasi email agar huruf kecil semua dan tidak ada spasi di awal dan akhir
    $email = strtolower(trim($request['email'])); 

    // CEK APAKAH $email TIDAK SESUAI DENGAN FORMAT
    if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
        echo "<script>
            alert('Format email tidak sesuai!');
        </script>";
        return;
    }

    // CEK APAKAH EMAIL SUDAH ADA DI DATABASE
    $resultCheckEmail = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");
    // jika mysqli_num_row($resultCheckEmail) == 1 atau bahkan lebih dari 1, maka email tersebut sudah digunakan user lain 
    if (mysqli_num_rows($resultCheckEmail) > 0) { 
        echo "<script>
            alert('Email sudah dipakai! Ganti dengan email lain!');
        </script>";
        return;
    }

    // AMBIL PW DARI INPUT LALU SIMPAN DI VARIABLE
    $pw = mysqli_real_escape_string($conn, $request['pw']);
    $pw2 = mysqli_real_escape_string($conn, $request['pw2']);

    // CEK PW1 === PW2 ?
    if ($pw !== $pw2) {
        echo "<script>
            alert('Password tidak sama!');
        </script>";
        return;
    }

    // HASH PW -> mengacak pw
    $pw = password_hash($pw, PASSWORD_DEFAULT);
    $pw2 = password_hash($pw2, PASSWORD_DEFAULT);

    // SIMPAN(INSERT) EMAIL DAN PW KE DATABASE
    $result = mysqli_query($conn, "INSERT INTO users VALUES('', '$email', '$pw')");
    
    if ($result) {
        echo "<script>
                alert('Berhasil membuat akun! Silakan login ulang');
                window.location.replace('login.php');
            </script>";
    } else {
        mysqli_error($conn);
    }
}

function login($request) {
    global $conn;

    // AMBIL EMAIL & PW DARI INPUT LALU SIMPAN DI VARIABLE
    $email = trim($request['email']);
    $pw = $request['pw'];

    // QUERY(AMBIL DATA) EMAIL DARI DATABASE YANG SAMA DENGAN $email
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

    // CEK HASIL QUERY ADA ATAU TIDAK
    if(mysqli_num_rows($result) === 1) {

        // FETCH DATA
        $dataFetch = mysqli_fetch_assoc($result);

        // CEK APAKAH PW SAMA DENGAN YANG DI DATABASE
        if( password_verify($pw, $dataFetch['password']) ) {

            // SET SESI => VARIABLE INI AKAN DIGUNAKAN DI HALAMAN-HALAMAN LAIN.
            $_SESSION['login'] = true;
            header('Location: ../index.php');
            exit;
        } else {
            echo "<script>
                alert('Password tidak sesuai');
            </script>";
            return;
        }

    } else {
        echo "<script>
                alert('Email tidak sesuai');
            </script>";
            return;
    }
}