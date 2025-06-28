<?php
// File: config/koneksi.php

$host = "localhost";
$user = "root";        // default user Laragon
$pass = "iyan";            // default password Laragon (kosong)
$db   = "perpus";      // nama database

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
