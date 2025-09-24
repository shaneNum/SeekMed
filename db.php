<?php
$host = "localhost";
$user = "root";        // default di XAMPP
$pass = "";            // default kosong
$db   = "seekmed";     // nama database yang kamu buat

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
