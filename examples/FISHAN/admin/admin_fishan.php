<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}
require_once 'C:/xampp/htdocs/FISHAN/config/connect.php';

// ======================== PROSES ETALASE (IKAN) ========================
// Proses tambah data
if(isset($_POST['tambah'])) {
    $nama = $_POST['nama_ikan'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    
    // Upload gambar
    // Tentukan folder tujuan absolut
    $target_dir = __DIR__ . '/../assets/images/fish/';
    // Buat folder jika belum ada
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $gambar = $_FILES['gambar']['name'];
    $target_file = $target_dir . basename($gambar);
    if(move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
        // Simpan hanya nama file ke database (tanpa path)
        $sql = "INSERT INTO etalase (nama_ikan, deskripsi, harga, gambar) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama, $deskripsi, $harga, $gambar]);
        $success = "Ikan berhasil ditambahkan.";
    } else {
        $error = "Gagal upload gambar.";
}
}

// Proses hapus
if(isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    // Ambil nama gambar dulu untuk dihapus dari folder
    $stmt = $pdo->prepare("SELECT gambar FROM etalase WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    if($row && file_exists("assets/images/fish/".$row['gambar'])) {
        unlink("assets/images/fish/".$row['gambar']);
    }
    $stmt = $pdo->prepare("DELETE FROM etalase WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin_fish.php");
    exit;
}

// Ambil semua data etalase
$stmt = $pdo->query("SELECT * FROM etalase ORDER BY id DESC");
$items = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="/FISHAN/admin/assetsAdmin/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Fishan Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styling untuk efek soft dan modern */
        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.15);
        }
        .neon-title {
            text-shadow: 0 0 5px #FFF8C9, 0 0 10px #FFF8C9, 0 0 15px #D0BFFF;
        }
        .table-row-hover:hover {
            background-color: #DFCCFB;
            transition: background-color 0.2s;
        }
        input, textarea, select {
            transition: all 0.2s ease;
        }
        input:focus, textarea:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(190, 173, 250, 0.5);
            border-color: #BEADFA;
        }
        button {
            transition: all 0.2s ease;
        }
        button:active {
            transform: scale(0.97);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-[#BEADFA] to-[#D0BFFF] p-6 min-h-screen">
    <div class="container mx-auto max-w-6xl">
        
        <!-- Navbar -->
        <nav class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg mb-8 border border-white/40 card-hover">
            <div class="container mx-auto px-6 py-4 flex flex-wrap items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-[#FFF8C9] to-[#472DA4]"></div>
                    <span class="text-2xl font-bold text-[#472DA4] tracking-tight">Admin Panel Fishan</span>
                </div>
                <div class="flex gap-6 mt-2 sm:mt-0">
                    <a href="admin_fish.php" class="text-[#472DA4] font-semibold border-b-2 border-[#472DA4] pb-1 hover:pb-0 transition-all">Edit Etalase</a>
                    <a href="admin_konten.php" class="text-[#472DA4] hover:text-[#755BD2] transition">Edit Konten Artikel</a>
                    <a href="admin_testimoni.php" class="text-[#472DA4] hover:text-[#755BD2] transition">Edit Testimoni User</a>
                </div>
            </div>
        </nav>

        <!-- Judul Halaman dengan efek neon -->
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-extrabold neon-title" 
                style="color: white; text-shadow: 0 0 6px #BEADFA, 0 0 12px #D0BFFF, 0 0 18px #DFCCFB;">
                Kelola Etalase Ikan
            </h1>
            <div class="w-24 h-1 bg-[#FFF8C9] mx-auto mt-2 rounded-full"></div>
        </div>

        <!-- Form Tambah Ikan -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl p-6 md:p-8 mb-10 border border-white/40 card-hover">
            <h2 class="text-2xl font-bold text-[#472DA4] mb-6 flex items-center gap-2">
                <span class="w-6 h-6 bg-gradient-to-r from-[#BEADFA] to-[#472DA4] rounded-full inline-block"></span>
                Tambah Ikan Baru
            </h2>
            <form action="" method="POST" enctype="multipart/form-data" class="space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Nama Ikan</label>
                        <input type="text" name="nama_ikan" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-[#BEADFA] focus:border-transparent" placeholder="Contoh: Blue Diamond Guppy" required>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Harga (Rp)</label>
                        <input type="number" name="harga" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-[#BEADFA] focus:border-transparent" placeholder="25000" required>
                    </div>
                </div>
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Deskripsi (poin-poin, pisahkan dengan newline)</label>
                    <textarea name="deskripsi" rows="3" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-[#BEADFA] focus:border-transparent" placeholder="Contoh:&#10;Biru Metalik&#10;Berkilau&#10;Anggun"></textarea>
                </div>
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Gambar Ikan</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#BEADFA] file:text-white hover:file:bg-[#9B8CEB]" required>
                </div>
                <div class="flex items-center justify-between pt-2">
                    <button type="submit" name="tambah" class="bg-gradient-to-r from-[#BEADFA] to-[#D0BFFF] text-white font-bold px-8 py-3 rounded-xl shadow-md hover:shadow-lg transition transform hover:scale-[1.02] active:scale-95">
                    Simpan Ikan
                    </button>
                    <?php if(isset($success)) echo "<p class='text-green-700 bg-green-100 px-4 py-2 rounded-full'>✅ $success</p>"; ?>
                    <?php if(isset($error)) echo "<p class='text-red-700 bg-red-100 px-4 py-2 rounded-full'>❌ $error</p>"; ?>
                </div>
            </form>
        </div>

        <!-- Tabel Daftar Ikan -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl p-6 md:p-8 border border-white/40 card-hover">
            <h2 class="text-2xl font-bold text-[#3914BD] mb-6 flex items-center gap-2">
                <span class="w-6 h-6 bg-[#D0BFFF] rounded-full inline-block"></span>
                Daftar Ikan
            </h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-[#DFCCFB] rounded-xl">
                            <th class="p-3 text-left">ID</th>
                            <th class="p-3 text-left">Gambar</th>
                            <th class="p-3 text-left">Nama</th>
                            <th class="p-3 text-left">Deskripsi</th>
                            <th class="p-3 text-left">Harga</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($items as $item): ?>
                        <tr class="border-b border-gray-200 table-row-hover transition">
                            <td class="p-3 font-mono"><?= $item['id'] ?></td>
                            <td class="p-3">
                                <img src="../assets/images/fish/<?= $item['gambar'] ?>" class="w-16 h-16 object-cover rounded-xl shadow-sm">
                            </td>
                            <td class="p-3 font-semibold text-gray-800"><?= htmlspecialchars($item['nama_ikan']) ?></td>
                            <td class="p-3 text-gray-600 text-sm"><?= nl2br(htmlspecialchars($item['deskripsi'])) ?></td>
                            <td class="p-3 font-bold text-[#3914BD]">Rp <?= number_format($item['harga'],0,',','.') ?></td>
                            <td class="p-3 text-center">
                                <a href="?hapus=<?= $item['id'] ?>" class="inline-block bg-red-100 text-red-600 px-4 py-1 rounded-full hover:bg-red-600 hover:text-white transition" onclick="return confirm('Yakin ingin menghapus ikan ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
</html>