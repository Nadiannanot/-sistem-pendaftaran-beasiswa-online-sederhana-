<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_beasiswa";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
	die("Koneksi gagal: " . $conn->connect_error);
}

// NAMA : NADIA KHOERUNISA
// NIM  : 123456789
// KELAS: 4C
