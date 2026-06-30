<?php
$host = 'localhost';
$dbname = 'fishan_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn = $pdo;   // tambahkan baris ini agar $conn tersedia
} catch(PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>