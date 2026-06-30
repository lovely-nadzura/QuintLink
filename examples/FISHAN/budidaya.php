<?php
require_once 'config/connect.php';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budidaya Ikan - Fishan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Efek hover pada kartu */
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100">

    <!-- NAVBAR (sama persis dengan sebelumnya) -->
    <nav class="bg-[#1B263B] shadow-lg fixed w-full z-30 top-0 flex justify-between items-center">
        <div class="flex items-center gap-3 pl-4 py-3">
            <img src="assets/img/Logo/fishan-bg-white.png" alt="Logo Fishan" class="h-11 w-auto">
            <span class="text-3xl text-white font-semibold">FISHAN</span>
        </div>
        <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4 pt-3 pr-3 pb-3">
                <a href="index.php" class="text-white hover:bg-[#3f5682] px-3 py-2 rounded-md text-sm font-medium transition duration-300">Beranda</a>
                <a href="tentang.php" class="text-white hover:bg-[#3f5682] px-3 py-2 rounded-md text-sm font-medium transition duration-300">Tentang</a>
                <a href="budidaya.php" class="text-white bg-[#3f5682] px-3 py-2 rounded-md text-sm font-medium transition duration-300">Budidaya</a>
                <a href="admin/login.php" class="text-white hover:bg-[#3f5682] px-3 py-2 rounded-md text-sm font-medium transition duration-300"><i class="fas fa-user-circle"></i></a>
            </div>
        </div>
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
            <a href="tentang.php" class="block text-gray-800 hover:bg-[#0C978B] hover:text-white px-3 py-2 rounded-md">Tentang</a>
            <a href="budidaya.php" class="block text-gray-800 bg-[#0C978B] text-white px-3 py-2 rounded-md">Budidaya</a>
        </div>
    </div>

    <script>
        const btn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        if (btn && menu) btn.addEventListener('click', () => menu.classList.toggle('hidden'));
    </script>

    <!-- Tombol floating WhatsApp -->
    <a href="https://wa.me/628123456789?text=Halo%20saya%20mau%20tanya%20ikan" target="_blank" 
       class="fixed bottom-6 right-6 bg-green-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-green-600 transition duration-300 z-50">
        <i class="fab fa-whatsapp text-3xl"></i>
    </a>

    <!-- Header Halaman -->
    <div class="pt-16 bg-cover bg-center bg-no-repeat" style="background-image: url('assets/img/Media/banr.png');">
    <div class="container mx-auto px-4 py-12 md:py-16 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 leading-tight mb-4">
        Informasi Budidaya Ikan
        </h1>
        <p class="text-gray-600 font-semibold text-base md:text-lg max-w-2xl mx-auto">
        Temukan panduan lengkap, tips, dan artikel terbaru seputar budidaya ikan hias dan konsumsi yang berkualitas.
        </p>
    </div>
    </div>

    <!-- Daftar Artikel -->
    <div class="container mx-auto px-4 py-12">
        <?php
        $artikel = $pdo->query("SELECT * FROM konten ORDER BY created_at DESC")->fetchAll();
        if (count($artikel) > 0):
        ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($artikel as $a): ?>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <?php if ($a['gambar']): ?>
                    <div class="h-48 overflow-hidden">
                        <img src="assets/images/konten/<?= $a['gambar'] ?>" class="w-full h-full object-cover transition duration-500 hover:scale-105" alt="<?= htmlspecialchars($a['judul']) ?>">
                    </div>
                <?php else: ?>
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-fish text-5xl text-gray-400"></i>
                    </div>
                <?php endif; ?>
                <div class="p-5">
                    <div class="flex items-center text-sm text-gray-500 mb-2">
                        <i class="far fa-calendar-alt mr-2"></i>
                        <span><?= date('d M Y', strtotime($a['created_at'])) ?></span>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2"><?= htmlspecialchars($a['judul']) ?></h2>
                    <div class="text-gray-600 text-sm mb-4 summary-text">
                        <?= strip_tags(substr($a['isi'], 0, 120)) ?>...
                    </div>
                    <a href="detail_budidaya.php?id=<?= $a['id'] ?>" class="inline-flex items-center text-[#0D9488] font-semibold hover:underline">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-2 text-xs"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="text-center py-16 bg-white rounded-lg shadow">
            <i class="fas fa-newspaper text-6xl text-gray-400 mb-4"></i>
            <p class="text-gray-500 text-lg">Belum ada artikel budidaya. Silakan kembali lagi nanti.</p>
        </div>
        <?php endif; ?>
    </div>

<!-- FOOTER -->
<footer class="bg-[#1B263B] text-white mt-16">
    <div class="container mx-auto px-6 py-10">
        <!-- Grid: 1 kolom mobile, 3 kolom desktop -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Kolom 1: Alamat -->
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

            <!-- Kolom 2: Media Sosial -->
            <div>
                <h3 class="text-xl font-semibold mb-4 flex items-center gap-2">
                    <i class="fas fa-share-alt text-[#0D9488]"></i> Media Sosial
                </h3>
                <div class="flex flex-col space-y-3">
                    <a href="#" class="flex items-center gap-3 text-gray-300 hover:text-white transition duration-300">
                        <i class="fab fa-instagram text-2xl w-6"></i> 
                        <span>@fishan.official</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 text-gray-300 hover:text-white transition duration-300">
                      <i class="fab fa-tiktok text-2xl w-6"></i> 
                      <span>@fishan.tiktok</span>
                  </a>
                </div>
            </div>

            <!-- Kolom 3: Google Maps (Embed) -->
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
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <p class="text-xs text-gray-400 mt-2">Klik peta untuk membuka navigasi</p>
            </div>
        </div>

        <!-- Divider & Copyright -->
        <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400 text-sm">
            &copy; <?= date('Y') ?> Fishan. All rights reserved. | Platform Ikan & Budidaya
        </div>
    </div>
</footer>

</body>
</html>