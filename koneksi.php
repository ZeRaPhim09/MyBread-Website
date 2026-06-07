<?php
$host = "localhost";
$user = "root";       // Default username XAMPP
$pass = "";           // Default password XAMPP (kosong)
$db   = "mybread_db"; // Nama database yang baru saja dibuat

// Membuat koneksi
$conn = mysqli_connect($host, $user, $pass, $db);

// Mengecek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>