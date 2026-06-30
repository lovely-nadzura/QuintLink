<?php
require_once __DIR__ . '/config/connect.php';
echo "✅ Koneksi ke database BERHASIL NIH!<br><br>";
echo "Database: fishan_db<br>";

// Cek apakah $conn ada
if (!isset($conn)) {
    die("❌ Variabel \$conn tidak ditemukan. Periksa file connect.php");
}

$result = $conn->query("SHOW TABLES");
if ($result) {
    echo "Tabel yang ada:<br>";
    while ($row = $result->fetch(PDO::FETCH_NUM)) {
        echo "- " . $row[0] . "<br>";
    }
} else {
    echo "❌ Query gagal: " . $conn->errorInfo()[2];
}
?>