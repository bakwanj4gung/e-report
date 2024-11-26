<?php
if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../pages/auth/login.php");
    exit();
} else {
    header("Location: ../index.php");
    exit();
}