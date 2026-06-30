<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

require_once 'C:/xampp/htdocs/FISHAN/config/connect.php'; // path ke folder config di atas admin

// ======================== PROSES TESTIMONI ========================
// Tambah testimoni
if(isset($_POST['tambah_testimoni'])) {
    $nama = $_POST['nama'];
    $komentar = $_POST['komentar'];
    $rating = $_POST['rating'];
    
    // Upload foto bukti
    $foto = $_FILES['foto_bukti']['name'];
    $target_dir = __DIR__ . '/../assets/images/testimonials/';
    if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
    $target_file = $target_dir . basename($foto);
    $upload_ok = true;
    if($foto) {
        if(!move_uploaded_file($_FILES['foto_bukti']['tmp_name'], $target_file)) {
            $error_testi = "Gagal upload foto bukti.";
            $upload_ok = false;
        }
    } else {
        $foto = null;
    }
    
    if($upload_ok) {
        $sql = "INSERT INTO testimoni (nama, komentar, rating, foto_bukti, approved, created_at) VALUES (?, ?, ?, ?, 0, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama, $komentar, $rating, $foto]);
        $success_testi = "Testimoni berhasil ditambahkan, menunggu persetujuan.";
    }
}

// Approve testimoni (set approved = 1)
if(isset($_GET['approve_testimoni'])) {
    $id = $_GET['approve_testimoni'];
    $stmt = $pdo->prepare("UPDATE testimoni SET approved = 1 WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin_testimoni.php");
    exit;
}

// Unapprove testimoni (set approved = 0)
if(isset($_GET['unapprove_testimoni'])) {
    $id = $_GET['unapprove_testimoni'];
    $stmt = $pdo->prepare("UPDATE testimoni SET approved = 0 WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin_testimoni.php");
    exit;
}

// Hapus testimoni
if(isset($_GET['hapus_testimoni'])) {
    $id = $_GET['hapus_testimoni'];
    // Ambil nama file foto dulu untuk dihapus
    $stmt = $pdo->prepare("SELECT foto_bukti FROM testimoni WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    if($row && $row['foto_bukti']) {
        $file_path = __DIR__ . '/../assets/images/testimonials/' . $row['foto_bukti'];
        if(file_exists($file_path)) unlink($file_path);
    }
    $stmt = $pdo->prepare("DELETE FROM testimoni WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin_testimoni.php");
    exit;
}

// Ambil semua data testimoni, urut dari terbaru
$stmt_testi = $pdo->query("SELECT * FROM testimoni ORDER BY created_at DESC");
$testimonials = $stmt_testi->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="/FISHAN/admin/assetsAdmin/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Testimoni</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .card-hover { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 25px -12px rgba(0,0,0,0.15); }
        .neon-title { text-shadow: 0 0 5px #FFF8C9, 0 0 10px #FFF8C9, 0 0 15px #D0BFFF; }
        .table-row-hover:hover { background-color: #DFCCFB; transition: background-color 0.2s; }
        input, textarea, select { transition: all 0.2s ease; }
        input:focus, textarea:focus, select:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(190, 173, 250, 0.5);
            border-color: #BEADFA;
        }
        button { transition: all 0.2s ease; }
        button:active { transform: scale(0.97); }
    </style>
</head>
<body class="bg-gradient-to-br from-[#BEADFA] to-[#D0BFFF] p-6 min-h-screen">
    <div class="container mx-auto max-w-6xl">
        <!-- Navbar -->
        <nav class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg mb-8 border border-white/40 card-hover">
            <div class="container mx-auto px-6 py-4 flex flex-wrap items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-[#FFF8C9] to-[#472DA4]"></div>
                    <span class="text-2xl font-bold text-[#3914BD] tracking-tight">Admin Panel Fishan</span>
                </div>
                <div class="flex gap-6 mt-2 sm:mt-0">
                    <a href="admin_fishan.php" class="text-[#472DA4] hover:text-[#755BD2] transition">Edit Etalase</a>
                    <a href="admin_konten.php" class="text-[#472DA4] hover:text-[#755BD2] transition">Edit Konten Artikel</a>
                    <a href="admin_testimoni.php" class="text-[#472DA4] font-semibold border-b-2 border-[#472DA4] pb-1 hover:pb-0 transition-all">Edit Testimoni User</a>
                </div>
            </div>
        </nav>

        <!-- Judul Halaman -->
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-extrabold neon-title" style="color: white; text-shadow: 0 0 6px #BEADFA, 0 0 12px #D0BFFF, 0 0 18px #DFCCFB;">
                Kelola Testimoni Pelanggan
            </h1>
            <div class="w-24 h-1 bg-[#FFF8C9] mx-auto mt-2 rounded-full"></div>
        </div>

        <!-- Form Tambah Testimoni -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl p-6 md:p-8 mb-10 border border-white/40 card-hover">
            <h2 class="text-2xl font-bold text-[#3914BD] mb-6 flex items-center gap-2">
                <span class="w-6 h-6 bg-gradient-to-r from-[#BEADFA] to-[#472DA4] rounded-full inline-block"></span>
                Tambah Testimoni Baru
            </h2>
            <form action="" method="POST" enctype="multipart/form-data" class="space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Nama Pelanggan</label>
                        <input type="text" name="nama" class="w-full border border-gray-300 rounded-xl p-3" placeholder="Contoh: Nazhe Vanyren" required>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Rating</label>
                        <select name="rating" class="w-full border border-gray-300 rounded-xl p-3">
                            <option value="5">5 ★ - Sangat Baik</option>
                            <option value="4">4 ★ - Baik</option>
                            <option value="3">3 ★ - Cukup</option>
                            <option value="2">2 ★ - Kurang</option>
                            <option value="1">1 ★ - Buruk</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Review</label>
                    <textarea name="komentar" rows="3" class="w-full border border-gray-300 rounded-xl p-3" placeholder="Masukan review pelanggan disini..." required></textarea>
                </div>
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Foto Bukti (opsional)</label>
                    <input type="file" name="foto_bukti" accept="image/*" class="w-full text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#BEADFA] file:text-white hover:file:bg-[#9B8CEB]">
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" name="tambah_testimoni" class="bg-gradient-to-r from-[#BEADFA] to-[#D0BFFF] text-white font-bold px-8 py-3 rounded-xl shadow-md hover:shadow-lg transition transform hover:scale-[1.02]">Kirim Testimoni</button>
                    <?php if(isset($success_testi)) echo "<p class='text-green-700 bg-green-100 px-4 py-2 rounded-full'>✅ $success_testi</p>"; ?>
                    <?php if(isset($error_testi)) echo "<p class='text-red-700 bg-red-100 px-4 py-2 rounded-full'>❌ $error_testi</p>"; ?>
                </div>
            </form>
        </div>

        <!-- Daftar Testimoni -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl p-6 md:p-8 border border-white/40 card-hover">
            <h2 class="text-2xl font-bold text-[#3914BD] mb-6 flex items-center gap-2">
                <span class="w-6 h-6 bg-[#D0BFFF] rounded-full inline-block"></span>
                Daftar Testimoni
            </h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-[#DFCCFB] rounded-xl">
                            <th class="p-3 text-left">ID</th>
                            <th class="p-3 text-left">Nama</th>
                            <th class="p-3 text-left">Rating</th>
                            <th class="p-3 text-left">Komentar</th>
                            <th class="p-3 text-left">Foto Bukti</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($testimonials)): ?>
                        <tr><td colspan="7" class="p-4 text-center text-gray-500">Belum ada testimoni.</td></tr>
                        <?php else: ?>
                        <?php foreach($testimonials as $t): ?>
                        <tr class="border-b border-gray-200 table-row-hover transition">
                            <td class="p-3 font-mono"><?= $t['id'] ?></td>
                            <td class="p-3 font-semibold text-gray-800"><?= htmlspecialchars($t['nama']) ?></td>
                            <td class="p-3"><?= str_repeat('⭐', $t['rating']) ?> (<?= $t['rating'] ?>)</td>
                            <td class="p-3 text-gray-600"><?= nl2br(htmlspecialchars($t['komentar'])) ?></td>
                            <td class="p-3">
                                <?php if($t['foto_bukti']): ?>
                                    <img src="../assets/images/testimonials/<?= $t['foto_bukti'] ?>" class="w-16 h-16 object-cover rounded-xl shadow-sm">
                                <?php else: ?> - <?php endif; ?>
                            </td>
                            <td class="p-3">
                                <?php if($t['approved']): ?>
                                    <span class="bg-green-200 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Disetujui</span>
                                <?php else: ?>
                                    <span class="bg-yellow-200 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">Menunggu</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-3 text-center space-x-2">
                                <?php if(!$t['approved']): ?>
                                    <a href="?approve_testimoni=<?= $t['id'] ?>" class="inline-block bg-green-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-green-600 transition">Approve</a>
                                <?php else: ?>
                                    <a href="?unapprove_testimoni=<?= $t['id'] ?>" class="inline-block bg-yellow-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-yellow-600 transition">Batalkan</a>
                                <?php endif; ?>
                                <a href="?hapus_testimoni=<?= $t['id'] ?>" class="inline-block bg-red-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-red-600 transition" onclick="return confirm('Yakin hapus testimoni ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>