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

</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100">

    <!-- NAVBAR-->
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

       <!-- ========== HERO SECTION (sederhana, tanpa gambar) ========== -->
    <div class="pt-24 bg-cover bg-center bg-no-repeat" style="background-image: url('assets/img/Media/banr.png');">
        <div class="container mx-auto px-4 py-12 md:py-16 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 leading-tight mb-4">Tentang Fishan</h1>
            <p class="text-gray-600 font-semibold text-base md:text-lg max-w-2xl mx-auto">
                Berdedikasi menghadirkan ikan berkualitas dan pengetahuan budidaya yang berkelanjutan.
            </p>
        </div>
    </div>

    <!-- ========== KONTEN UTAMA (flex-grow) ========== -->
    <main class="flex-grow container mx-auto px-4 py-10">
        <!-- Bagian 1: Tentang Perusahaan -->
        <div class="bg-white rounded-xl shadow-md p-6 md:p-8 mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-[#0D9488] flex items-center justify-center">
                    <i class="fas fa-fish text-white text-xl"></i>
                </div>
                <h2 class="text-2xl md:text-3xl font-bold text-[#1B263B]">Tentang Perusahaan</h2>
            </div>
            <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
                <p>
                    <strong class="text-[#0D9488]">Fishan</strong> didirikan pada tahun 2025 di Jakarta oleh <strong>Irfan</strong>, seorang penggemar ikan yang telah merawat ikan sejak kecil di kolam belakang rumahnya. Awalnya hanya hobi sederhana, Irfan melihat peluang besar di pasar ikan hias dan ikan konsumsi yang semakin menuntut kualitas tinggi serta perawatan prima. Ia mulai membudidayakan ikan secara profesional dengan menggabungkan dua segmen sekaligus: <strong class="text-[#1B263B]">ikan hias</strong> (seperti guppy, neon tetra, koi, dan arwana) serta <strong class="text-[#1B263B]">ikan konsumsi</strong> (nila, lele, dan gurame) yang dirawat dengan standar premium.
                </p>
                <p>
                    Dari lahan sempit di pinggiran Jakarta, Fishan berkembang menjadi usaha budidaya terintegrasi yang mengutamakan kesehatan ikan, keberlanjutan lingkungan, dan kesejahteraan hewan. Nama <strong class="text-[#0D9488]">“Fishan”</strong> sendiri berasal dari kata <em>“Fish”</em> dan <em>“ihsan”</em> (kebaikan dalam bahasa Arab), mencerminkan komitmen untuk memberikan kebaikan melalui ikan yang sehat, kuat, dan dirawat dengan penuh kasih sayang. Hingga kini, Fishan telah memasok ribuan ikan berkualitas ke toko ikan hias, restoran, dan konsumen langsung, sambil terus mengembangkan teknologi biofilter dan pakan alami untuk menjaga ekosistem kolam tetap ramah lingkungan.
                </p>
            </div>
        </div>

        <!-- Bagian 2: Visi & Misi -->
        <div class="bg-white rounded-xl shadow-md p-6 md:p-8 mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-[#0D9488] flex items-center justify-center">
                    <i class="fas fa-bullseye text-white text-xl"></i>
                </div>
                <h2 class="text-2xl md:text-3xl font-bold text-[#1B263B]">Visi & Misi</h2>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-gray-50 p-5 rounded-lg">
                    <h3 class="text-xl font-bold text-[#0D9488] mb-3"><i class="fas fa-eye mr-2"></i> Visi</h3>
                    <p class="text-gray-700 leading-relaxed">Menjadi pusat referensi dan pemasaran ikan berkualitas serta edukasi budidaya terkemuka di Indonesia yang berkelanjutan dan ramah lingkungan.</p>
                </div>
                <div class="bg-gray-50 p-5 rounded-lg">
                    <h3 class="text-xl font-bold text-[#0D9488] mb-3"><i class="fas fa-list-check mr-2"></i> Misi</h3>
                    <ul class="list-disc list-inside text-gray-700 space-y-2">
                        <li>Menyediakan platform promosi ikan yang transparan dan terpercaya.</li>
                        <li>Mengedukasi masyarakat tentang teknik budidaya ikan modern dan ramah lingkungan.</li>
                        <li>Memfasilitasi petani ikan dalam memasarkan produknya secara luas.</li>
                        <li>Mengembangkan teknologi biofilter dan pakan alami untuk keberlanjutan ekosistem.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bagian 3: Penghargaan & Mitra -->
        <div class="bg-white rounded-xl shadow-md p-6 md:p-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-[#0D9488] flex items-center justify-center">
                    <i class="fas fa-trophy text-white text-xl"></i>
                </div>
                <h2 class="text-2xl md:text-3xl font-bold text-[#1B263B]">Penghargaan & Mitra</h2>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Penghargaan -->
                <div>
                    <h3 class="text-lg font-semibold text-[#0D9488] mb-3"><i class="fas fa-medal mr-2"></i> Penghargaan</h3>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>Juara 1 Lomba Inovasi Budidaya Ikan Skala Rumahan (Kementerian Kelautan, 2024)</li>
                        <li>Penghargaan "Startup Digital Terbaik" untuk Platform Promosi Produk Perikanan (2025)</li>
                        <li>Rekomendasi dari Asosiasi Pengusaha Ikan Hias Indonesia (APII, 2026)</li>
                    </ul>
                </div>
                <!-- Mitra / Lokasi -->
                <div>
                    <h3 class="text-lg font-semibold text-[#0D9488] mb-3"><i class="fas fa-handshake mr-2"></i> Mitra & Lokasi Strategis</h3>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-1 text-gray-700">
                        <li><i class="fas fa-store text-xs mr-2"></i> Koko Kinchen Jakarta</li>
                        <li><i class="fas fa-store text-xs mr-2"></i> OPA Jakarta</li>
                        <li><i class="fas fa-location-dot text-xs mr-2"></i> Jl. Daksis</li>
                        <li><i class="fas fa-location-dot text-xs mr-2"></i> Jl. Sempurna</li>
                        <li><i class="fas fa-location-dot text-xs mr-2"></i> Jl. Banteng</li>
                        <li><i class="fas fa-location-dot text-xs mr-2"></i> Jl. Cipinang</li>
                        <li><i class="fas fa-location-dot text-xs mr-2"></i> Jl. Raya</li>
                        <li><i class="fas fa-location-dot text-xs mr-2"></i> Jl. Sukarno</li>
                        <li><i class="fas fa-location-dot text-xs mr-2"></i> Jl. Taman Masjid</li>
                        <li><i class="fas fa-location-dot text-xs mr-2"></i> Jl. Pasar Baru</li>
                        <li><i class="fas fa-location-dot text-xs mr-2"></i> Jl. Jenderal Sudirman</li>
                        <li><i class="fas fa-location-dot text-xs mr-2"></i> Jl. Jenderal Gatot Subroto</li>
                        <li><i class="fas fa-location-dot text-xs mr-2"></i> Jl. Jenderal Soedjatmiko</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

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