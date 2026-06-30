<?php
require_once 'C:/xampp/htdocs/FISHAN/config/connect.php';
$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM konten WHERE id = ?");
$stmt->execute([$id]);
$artikel = $stmt->fetch();
if (!$artikel) {
    die("Artikel tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="/FISHAN/admin/assetsAdmin/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($artikel['judul']) ?> - Fishan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Custom styling untuk konten artikel */
        .artikel-content p {
            margin-bottom: 1.25rem;
            line-height: 1.8;
        }
        .artikel-content h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            color: #1B263B;
        }
        .artikel-content h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-top: 1.25rem;
            margin-bottom: 0.75rem;
        }
        .artikel-content img {
            max-width: 100%;
            height: auto;
            border-radius: 0.75rem;
            margin: 1.5rem 0;
        }
        .artikel-content ul, .artikel-content ol {
            margin-left: 1.5rem;
            margin-bottom: 1.25rem;
        }
        .artikel-content li {
            margin-bottom: 0.5rem;
        }
        .artikel-content a {
            color: #0D9488;
            text-decoration: underline;
        }
        .artikel-content blockquote {
            border-left: 4px solid #0D9488;
            padding-left: 1rem;
            font-style: italic;
            margin: 1.5rem 0;
            color: #4b5563;
        }
        /* Navbar dan footer sudah menggunakan Tailwind, tinggal sesuaikan */
    </style>
</head>
<body class="bg-gray-50">

    <!-- NAVBAR (copy dari halaman utama) -->
    <nav class="bg-[#1B263B] shadow-lg fixed w-full z-30 top-0 flex justify-between items-center">
        <div class="flex items-center gap-3 pl-4 py-3">
            <img src="assets/img/Logo/fishan-bg-white.png" alt="Logo Fishan" class="h-11 w-auto">
            <span class="text-3xl text-white font-semibold">FISHAN</span>
        </div>
        <!-- Menu Desktop -->
        <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4 pt-3 pr-3 pb-3">
                <a href="index.php" class="text-white hover:bg-[#3f5682] px-3 py-2 rounded-md text-sm font-medium transition duration-300">Beranda</a>
                <a href="#" class="text-white hover:bg-[#3f5682] px-3 py-2 rounded-md text-sm font-medium transition duration-300">Tentang</a>
                <a href="budidaya.php" class="text-white hover:bg-[#3f5682] px-3 py-2 rounded-md text-sm font-medium transition duration-300">Budidaya</a>
                <a href="#" class="text-white hover:bg-[#3f5682] px-3 py-2 rounded-md text-sm font-medium transition duration-300">Kontak</a>
            </div>
        </div>
        <!-- Tombol Hamburger -->
        <div class="md:hidden">
            <button id="mobile-menu-button" class="pr-3 text-white focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </nav>

    <!-- Menu Mobile -->
    <div id="mobile-menu" class="md:hidden hidden bg-white shadow-lg mt-16 fixed w-full z-20">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="index.php" class="block text-gray-800 hover:bg-[#0C978B] hover:text-white px-3 py-2 rounded-md">Beranda</a>
            <a href="#" class="block text-gray-800 hover:bg-[#0C978B] hover:text-white px-3 py-2 rounded-md">Tentang</a>
            <a href="budidaya.php" class="block text-gray-800 hover:bg-[#0C978B] hover:text-white px-3 py-2 rounded-md">Budidaya</a>
            <a href="#" class="block text-gray-800 hover:bg-[#0C978B] hover:text-white px-3 py-2 rounded-md">Kontak</a>
        </div>
    </div>

    <script>
        const button = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        if (button && menu) {
            button.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        }
    </script>

    <!-- Tombol floating WhatsApp -->
    <a href="https://wa.me/628123456789?text=Halo%20saya%20mau%20tanya%20ikan" target="_blank" 
       class="fixed bottom-6 right-6 bg-green-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-green-600 transition duration-300 z-50">
        <i class="fab fa-whatsapp text-3xl"></i>
    </a>

    <!-- Konten Utama Artikel -->
    <div class="container mx-auto px-4 pt-28 pb-12 max-w-4xl">
        <!-- Card Artikel -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Gambar Sampul (jika ada) -->
            <?php if ($artikel['gambar']): ?>
                <div class="w-full h-64 md:h-96 overflow-hidden">
                    <img src="assets/images/konten/<?= $artikel['gambar'] ?>" 
                         alt="<?= htmlspecialchars($artikel['judul']) ?>" 
                         class="w-full h-full object-cover">
                </div>
            <?php endif; ?>
            
            <div class="p-6 md:p-8">
                <!-- Judul -->
                <h1 class="text-3xl md:text-4xl font-bold text-[#1B263B] mb-4"><?= htmlspecialchars($artikel['judul']) ?></h1>
                
                <!-- Meta info (tanggal) -->
                <div class="flex items-center text-gray-500 text-sm mb-6">
                    <i class="far fa-calendar-alt mr-2"></i>
                    <span><?= date('d F Y', strtotime($artikel['created_at'])) ?></span>
                </div>
                
                <!-- Isi Artikel (dengan styling custom) -->
                <div class="artikel-content prose max-w-none text-gray-700">
                    <?= strip_tags($artikel['isi'], '<p><br><strong><em><ul><ol><li><img><h1><h2><h3><h4><div><span><a><blockquote>') ?>
                </div>
                
                <!-- Tombol Kembali -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <a href="budidaya.php" class="inline-flex items-center text-[#0D9488] hover:text-[#0a7a70] font-medium transition">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Artikel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer (sama seperti halaman utama) -->
    <footer class="bg-[#1B263B] text-white mt-12">
        <div class="container mx-auto px-6 py-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Alamat -->
                <div>
                    <h3 class="text-xl font-semibold mb-4 flex items-center gap-2">
                        <i class="fas fa-map-marker-alt text-[#0D9488]"></i> Alamat
                    </h3>
                    <p class="text-gray-300 leading-relaxed">
                        Jl. Ikan Hias No. 123,<br>
                        Kelurahan Aquarium, Kecamatan Guppy,<br>
                        Kota Cupang, 12345
                    </p>
                </div>
                <!-- Media Sosial -->
                <div>
                    <h3 class="text-xl font-semibold mb-4 flex items-center gap-2">
                        <i class="fas fa-share-alt text-[#0D9488]"></i> Media Sosial
                    </h3>
                    <div class="flex flex-col space-y-3">
                        <a href="#" class="flex items-center gap-3 text-gray-300 hover:text-white transition">
                            <i class="fab fa-instagram text-2xl w-6"></i> 
                            <span>@fishan.official</span>
                        </a>
                        <a href="#" class="flex items-center gap-3 text-gray-300 hover:text-white transition">
                            <i class="fab fa-tiktok text-2xl w-6"></i> 
                            <span>@fishan.tiktok</span>
                        </a>
                    </div>
                </div>
                <!-- Google Maps -->
                <div>
                    <h3 class="text-xl font-semibold mb-4 flex items-center gap-2">
                        <i class="fas fa-map text-[#0D9488]"></i> Lokasi Kami
                    </h3>
                    <div class="rounded-lg overflow-hidden shadow-md">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521276995754!2d106.828671!3d-6.207477!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3f1b6a1b3b1%3A0x7a1e7c3c9f8e5d4c!2sMonas!5e0!3m2!1sen!2sid!4v1650000000000!5m2!1sen!2sid" 
                            width="100%" 
                            height="180" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400 text-sm">
                &copy; <?= date('Y') ?> Fishan. All rights reserved. | Platform Ikan & Budidaya
            </div>
        </div>
    </footer>

</body>
</html>