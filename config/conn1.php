<?php
$conn = new mysqli("localhost", "root", "", "plazaNet");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
} else {
    echo "Koneksi berhasil!";
}
?>