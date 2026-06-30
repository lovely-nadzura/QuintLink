<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

require_once 'C:/xampp/htdocs/FISHAN/config/connect.php';

$success = '';
$error = '';

// Proses tambah
if (isset($_POST['tambah'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "../assets/images/konten/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
    $target_file = $target_dir . basename($gambar);
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
        $stmt = $pdo->prepare("INSERT INTO konten (judul, isi, gambar) VALUES (?, ?, ?)");
        $stmt->execute([$judul, $isi, $gambar]);
        $success = "Artikel berhasil ditambahkan.";
    } else {
        $error = "Gagal upload gambar.";
    }
}

// Proses edit (via modal, data dikirim via POST)
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "../assets/images/konten/";
        $target_file = $target_dir . basename($gambar);
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            $stmt = $pdo->prepare("UPDATE konten SET judul=?, isi=?, gambar=? WHERE id=?");
            $stmt->execute([$judul, $isi, $gambar, $id]);
            $success = "Artikel berhasil diperbarui.";
        } else {
            $error = "Gagal upload gambar baru.";
        }
    } else {
        $stmt = $pdo->prepare("UPDATE konten SET judul=?, isi=? WHERE id=?");
        $stmt->execute([$judul, $isi, $id]);
        $success = "Artikel berhasil diperbarui.";
    }
}

// Proses hapus
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    // Hapus gambar
    $stmt = $pdo->prepare("SELECT gambar FROM konten WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    if ($row && $row['gambar'] && file_exists("../assets/images/konten/".$row['gambar'])) {
        unlink("../assets/images/konten/".$row['gambar']);
    }
    $stmt = $pdo->prepare("DELETE FROM konten WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin_konten.php");
    exit;
}

// Ambil semua artikel
$artikel = $pdo->query("SELECT * FROM konten ORDER BY created_at DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="/FISHAN/admin/assetsAdmin/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Artikel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        /* Modal style */
        .modal {
            transition: opacity 0.25s ease;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-[#BEADFA] to-[#D0BFFF] p-6 min-h-screen">
    <div class="container mx-auto max-w-6xl">
        <!-- Navbar sama seperti di admin_testimoni -->
        <nav class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg mb-8 border border-white/40 card-hover">
            <div class="container mx-auto px-6 py-4 flex flex-wrap items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-[#FFF8C9] to-[#472DA4]"></div>
                    <span class="text-2xl font-bold text-[#3914BD] tracking-tight">Admin Panel Fishan</span>
                </div>
                <div class="flex gap-6 mt-2 sm:mt-0">
                    <a href="admin_fishan.php" class="text-[#472DA4] hover:text-[#755BD2] transition">Edit Etalase</a>
                    <a href="admin_konten.php" class="text-[#472DA4] font-semibold border-b-2 border-[#472DA4] pb-1 hover:pb-0 transition-all">Edit Konten Artikel</a>
                    <a href="admin_testimoni.php" class="text-[#472DA4] hover:text-[#755BD2] transition">Edit Testimoni User</a>
                </div>
            </div>
        </nav>

        <!-- Judul Halaman -->
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-extrabold neon-title" 
                style="color: white; text-shadow: 0 0 6px #BEADFA, 0 0 12px #D0BFFF, 0 0 18px #DFCCFB;">
                Kelola Artikel Budidaya
            </h1>
            <div class="w-24 h-1 bg-[#FFF8C9] mx-auto mt-2 rounded-full"></div>
        </div>

        <!-- Form Tambah Artikel -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl p-6 md:p-8 mb-10 border border-white/40 card-hover">
            <h2 class="text-2xl font-bold text-[#3914BD] mb-6 flex items-center gap-2">
                <span class="w-6 h-6 bg-gradient-to-r from-[#BEADFA] to-[#472DA4] rounded-full inline-block"></span>
                Tambah Artikel Baru
            </h2>
            <form method="POST" enctype="multipart/form-data" class="space-y-5">
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Judul Artikel</label>
                    <input type="text" name="judul" class="w-full border border-gray-300 rounded-xl p-3">
                </div>
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Isi Artikel</label>
                    <textarea name="isi" rows="5" class="w-full border border-gray-300 rounded-xl p-3"></textarea>
                </div>
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Gambar Sampul</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#BEADFA] file:text-white hover:file:bg-[#9B8CEB]">
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" name="tambah" class="bg-gradient-to-r from-[#BEADFA] to-[#D0BFFF] text-white font-bold px-8 py-3 rounded-xl shadow-md hover:shadow-lg transition transform hover:scale-[1.02]">Simpan Artikel</button>
                    <?php if($success) echo "<p class='text-green-700 bg-green-100 px-4 py-2 rounded-full'>✅ $success</p>"; ?>
                    <?php if($error) echo "<p class='text-red-700 bg-red-100 px-4 py-2 rounded-full'>❌ $error</p>"; ?>
                </div>
            </form>
        </div>

        <!-- Daftar Artikel -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl p-6 md:p-8 border border-white/40 card-hover">
            <h2 class="text-2xl font-bold text-[#3914BD] mb-6 flex items-center gap-2">
                <span class="w-6 h-6 bg-[#D0BFFF] rounded-full inline-block"></span>
                Daftar Artikel
            </h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-[#DFCCFB] rounded-xl">
                            <th class="p-3 text-left">ID</th>
                            <th class="p-3 text-left">Judul</th>
                            <th class="p-3 text-left">Gambar</th>
                            <th class="p-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($artikel)): ?>
                        <tr><td colspan="4" class="p-4 text-center text-gray-500">Belum ada artikel.<?php else: ?>
                        <?php foreach ($artikel as $a): ?>
                        <tr class="border-b border-gray-200 table-row-hover transition">
                            <td class="p-3 font-mono"><?= $a['id'] ?></td>
                            <td class="p-3 font-semibold text-gray-800"><?= htmlspecialchars($a['judul']) ?></td>
                            <td class="p-3">
                                <?php if ($a['gambar']): ?>
                                    <img src="../assets/images/konten/<?= $a['gambar'] ?>" class="w-16 h-16 object-cover rounded-xl shadow-sm">
                                <?php else: ?> - <?php endif; ?>
                            </td>
                            <td class="p-3 text-center space-x-2">
                                <button onclick="openEditModal(<?= $a['id'] ?>, '<?= htmlspecialchars($a['judul']) ?>', `<?= htmlspecialchars($a['isi']) ?>`)" 
                                        class="bg-yellow-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-yellow-600 transition">Edit</button>
                                <a href="?hapus=<?= $a['id'] ?>" class="bg-red-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-red-600 transition" onclick="return confirm('Yakin hapus artikel ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Edit Artikel -->
    <div id="editModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden transition-all duration-300">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 p-6 relative">
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h3 class="text-xl font-bold text-[#3914BD]">Edit Artikel</h3>
                <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            </div>
            <form method="POST" enctype="multipart/form-data" id="editForm">
                <input type="hidden" name="id" id="edit_id">
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Judul</label>
                    <input type="text" name="judul" id="edit_judul" class="w-full border rounded-xl p-2">
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Isi</label>
                    <textarea name="isi" id="edit_isi" rows="6" class="w-full border rounded-xl p-2"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Gambar Baru (opsional, kosongkan jika tidak ingin mengganti)</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full text-gray-600">
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeEditModal()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">Batal</button>
                    <button type="submit" name="edit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">Update</button>
                </div>
            </form>
        </div>
    </div>

    
    <script src="https://cdn.tiny.cloud/1/qp2h1iz6t9si5tdk9bukm7gnmr5y174v1hv6lz8u5y9qkyg2/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        // 1. Inisialisasi TinyMCE untuk form Tambah Artikel (textarea name=isi yang pertama)
        tinymce.init({
            selector: 'form:first-of-type textarea[name="isi"]',
            height: 400,
            menubar: true,
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
            toolbar: 'undo redo | blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | removeformat | table help'
        });

        // 2. Fungsi untuk modal edit
        function openEditModal(id, judul, isi) {
            // Isi data ke form
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_judul').value = judul;

            // Hapus editor sebelumnya jika sudah ada (supaya tidak double)
            if (tinymce.get('edit_isi')) {
                tinymce.get('edit_isi').remove();
            }

            // Set nilai textarea (sementara)
            const textarea = document.getElementById('edit_isi');
            textarea.value = isi;

            // Inisialisasi TinyMCE untuk textarea dalam modal
            tinymce.init({
                selector: '#edit_isi',
                height: 350,
                menubar: true,
                plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
                toolbar: 'undo redo | blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | removeformat | table help',
                setup: function(editor) {
                    // Setelah editor siap, masukkan konten
                    editor.on('init', function() {
                        editor.setContent(isi);
                    });
                }
            });

            // Tampilkan modal
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            // Hapus editor TinyMCE sebelum modal ditutup
            if (tinymce.get('edit_isi')) {
                tinymce.get('edit_isi').remove();
            }
            document.getElementById('editModal').classList.add('hidden');
        }

        // Tutup modal jika klik di luar area putih
        const modalBg = document.getElementById('editModal');
        modalBg.addEventListener('click', function(e) {
            if (e.target === modalBg) closeEditModal();
        });
    </script>
</body>
</html>