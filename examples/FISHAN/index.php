<?php include 'C:/xampp/htdocs/FISHAN/config/connect.php';?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>fishan</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
  <!-- NAVBAR -->
  <nav class="bg-[#1B263B] shadow-lg fixed w-full z-30 top-0 flex justify-between items-center">
    <div class="flex items-center gap-3 pl-4 py-3">
      <img src="assets/img/Logo/fishan-bg-white.png" alt="Logo Fishan" class="h-11 w-auto">
      <span class="text-3xl text-white font-semibold">FISHAN</span>
    </div>
    <!-- Menu Desktop -->
    <div class="hidden md:block">
      <div class="ml-10 flex items-baseline space-x-4 pt-3 pr-3 pb-3">
        <a href="index.php" class="text-white hover:bg-[#3f5682] px-3 py-2 rounded-md text-sm font-medium transition duration-300">Beranda</a>
        <a href="tentang.php" class="text-white hover:bg-[#3f5682] px-3 py-2 rounded-md text-sm font-medium transition duration-300">Tentang</a>
        <a href="budidaya.php" class="text-white hover:bg-[#3f5682] px-3 py-2 rounded-md text-sm font-medium transition duration-300">Budidaya</a>
        <a href="admin/login.php" class="text-white hover:bg-[#3f5682] px-3 py-2 rounded-md text-sm font-medium transition duration-300"><i class="fas fa-user-circle"></i></a>
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
      <a href="tentang.php" class="block text-gray-800 hover:bg-[#0C978B] hover:text-white px-3 py-2 rounded-md">Tentang</a>
      <a href="budidaya.php" class="block text-gray-800 hover:bg-[#0C978B] hover:text-white px-3 py-2 rounded-md">Budidaya</a>
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

<!-- HERO SECTION -->
<div class="pt-16 bg-cover bg-center bg-no-repeat" style="background-image: url('assets/img/Media/banr.png');">
  <div class="container mx-auto px-4 py-8 md:py-12">

    <!-- Flex container: column di HP, row di desktop -->
    <div class="flex flex-col-reverse md:flex-row items-center gap-8 md:gap-12">
      
      <!-- Kolom Teks (kiri di desktop) -->
      <div class="flex-1 text-center md:text-left">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 leading-tight">
          Selamat Datang di <span class="text-[#0A7A70] drop-shadow-md">FISHAN</span>
        </h1>
        <p class="text-gray-600 font-semibold mt-4 text-base md:text-lg">
          Solusi untuk kebutuhan ikan dan informasi budidaya.
          Kami hadir sebagai wadah promosi penjualan ikan serta berbagi artikel seputar budidaya yang bermanfaat.
        </p>
        <div class="mt-6 flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
          <a href="https://wa.me/628123456678?text=Halo%20saya%20mau%20tanya%20ikan" class="bg-[#0D9488] hover:bg-[#0a7a70] text-white px-6 py-3 rounded-lg font-semibold transition duration-300 text-center">
            Beli Sekarang
          </a>
          <a href="#etalase" class="border border-[#1B263B] text-[#1B263B] hover:bg-[#1B263B] hover:text-white px-6 py-3 rounded-lg font-semibold transition duration-300 text-center">
            Lihat Ikan
          </a>
        </div>
      </div>

      <!-- Kolom Gambar (kanan di desktop) -->
      <div class="flex-1">
        <img 
          src="assets\img\Media\guppy.png" 
          alt="Hero Ikan Hias"
          class="h-21 w-auto md:max-w-full"
        />
      </div>
    </div>
  </div>
</div>

<!-- TENTANG PERUSAHAAN -->
<section class="bg-white py-8 md:py-12">
  <div class="container mx-auto px-4">
    <!-- Tab Menu -->
    <div class="flex flex-wrap justify-center gap-6 md:gap-8 border-b border-gray-200">
      <button data-tab="0" class="tab-button text-gray-600 hover:text-[#0D9488] font-semibold pb-2 transition duration-300 border-b-2 border-transparent focus:outline-none">
        Tentang Perusahaan
      </button>
      <button data-tab="1" class="tab-button text-gray-600 hover:text-[#0D9488] font-semibold pb-2 transition duration-300 border-b-2 border-transparent focus:outline-none">
        Visi & Misi
      </button>
      <button data-tab="2" class="tab-button text-gray-600 hover:text-[#0D9488] font-semibold pb-2 transition duration-300 border-b-2 border-transparent focus:outline-none">
        Penghargaan
      </button>
    </div>

    <!-- Carousel dengan Grid (panah tidak overlap) -->
    <div class="relative mt-8">
      <div class="grid grid-cols-[auto_1fr_auto] items-center gap-2 md:gap-4">
        
        <!-- Panah Kiri -->
        <button id="prev-arrow" class="bg-white/80 hover:bg-white rounded-full p-2 shadow-md focus:outline-none transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 text-[#1B263B]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </button>

        <!-- Konten Slide -->
        <div class="overflow-hidden">
          <div id="slide-wrapper" class="flex transition-transform duration-500 ease-in-out">
            
            <!-- Slide 1: Tentang Perusahaan -->
            <div class="w-full flex-shrink-0">
              <div class="flex flex-col md:flex-row items-center gap-6 md:gap-10">
                <div class="md:w-2/5 flex justify-center">
                  <img src="https://placehold.co/400x350/1B263B/FFFFFF?text=Fishan+Founder" alt="Tentang Fishan" class="w-64 md:w-80 rounded-xl shadow-lg object-cover">
                </div>
                <div class="md:w-3/5">
                  <h3 class="text-2xl font-bold text-[#1B263B] mb-4">Tentang Perusahaan</h3>
                  <p class="text-gray-700 leading-relaxed text-justify">
                    <span class="font-bold text-[#0D9488]">Fishan</span> didirikan pada tahun 2025 di Jakarta oleh seorang penggemar ikan yang telah merawat ikan sejak kecil di kolam belakang rumahnya. Awalnya hanya hobi sederhana, melihat peluang besar di pasar ikan hias dan ikan konsumsi yang semakin menuntut kualitas tinggi serta perawatan prima. Ia mulai membudidayakan ikan secara profesional dengan menggabungkan dua segmen sekaligus: ikan hias (guppy, neon tetra, koi, arwana) serta ikan konsumsi (nila, lele, gurame) yang dirawat dengan standar premium.
                  </p>
                </div>
              </div>
            </div>

            <!-- Slide 2: Visi & Misi -->
            <div class="w-full flex-shrink-0">
              <div class="flex flex-col md:flex-row items-center gap-6 md:gap-10">
                <div class="md:w-2/5 flex justify-center order-2 md:order-1">
                  <img src="https://placehold.co/400x350/1B263B/FFFFFF?text=Visi+Misi" alt="Visi Misi" class="w-64 md:w-80 rounded-xl shadow-lg object-cover">
                </div>
                <div class="md:w-3/5 order-1 md:order-2">
                  <h3 class="text-2xl font-bold text-[#1B263B] mb-4">Visi & Misi</h3>
                  <div class="space-y-4 text-gray-700">
                    <div>
                      <h4 class="font-bold text-[#0D9488]">Visi</h4>
                      <p>Menjadi pusat referensi dan pemasaran ikan berkualitas serta edukasi budidaya terkemuka di Indonesia.</p>
                    </div>
                    <div>
                      <h4 class="font-bold text-[#0D9488]">Misi</h4>
                      <ul class="list-disc list-inside space-y-1">
                        <li>Menyediakan platform promosi ikan yang transparan dan terpercaya.</li>
                        <li>Mengedukasi masyarakat tentang teknik budidaya ikan modern dan ramah lingkungan.</li>
                        <li>Memfasilitasi petani ikan dalam memasarkan produknya secara luas.</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Slide 3: Penghargaan -->
            <div class="w-full flex-shrink-0">
              <div class="flex flex-col md:flex-row items-center gap-6 md:gap-10">
                <div class="md:w-2/5 flex justify-center">
                  <img src="https://placehold.co/400x350/1B263B/FFFFFF?text=Penghargaan" alt="Penghargaan" class="w-64 md:w-80 rounded-xl shadow-lg object-cover">
                </div>
                <div class="md:w-3/5">
                  <h3 class="text-2xl font-bold text-[#1B263B] mb-4">Penghargaan</h3>
                  <ul class="list-disc list-inside space-y-2 text-gray-700">
                    <li><span class="font-semibold">2024</span> - Juara 1 Lomba Inovasi Budidaya Ikan Skala Rumahan (Kementerian Kelautan)</li>
                    <li><span class="font-semibold">2025</span> - Penghargaan "Startup Digital Terbaik" untuk Platform Promosi Produk Perikanan</li>
                    <li><span class="font-semibold">2026</span> - Rekomendasi dari Asosiasi Pengusaha Ikan Hias Indonesia (APII)</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Panah Kanan -->
        <button id="next-arrow" class="bg-white/80 hover:bg-white rounded-full p-2 shadow-md focus:outline-none transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 text-[#1B263B]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </button>

      </div>
    </div>
  </div>
</section>

<script>
  const tabButtons = document.querySelectorAll('.tab-button');
  const slideWrapper = document.getElementById('slide-wrapper');
  const prevBtn = document.getElementById('prev-arrow');
  const nextBtn = document.getElementById('next-arrow');
  let currentIndex = 0;
  const totalSlides = 3;

  function updateSlide(index) {
    if (index < 0) index = totalSlides - 1;
    if (index >= totalSlides) index = 0;
    currentIndex = index;
    slideWrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
    setActiveTab(currentIndex);
  }

  function setActiveTab(index) {
    tabButtons.forEach((btn, i) => {
      if (i == index) {
        btn.classList.add('border-[#0D9488]', 'text-[#0D9488]');
        btn.classList.remove('border-transparent', 'text-gray-600');
      } else {
        btn.classList.remove('border-[#0D9488]', 'text-[#0D9488]');
        btn.classList.add('border-transparent', 'text-gray-600');
      }
    });
  }

  prevBtn.addEventListener('click', () => updateSlide(currentIndex - 1));
  nextBtn.addEventListener('click', () => updateSlide(currentIndex + 1));
  tabButtons.forEach((btn, idx) => {
    btn.addEventListener('click', () => updateSlide(idx));
  });
  setActiveTab(0);
</script>

<!--JENIS JENIS IKAN-->
<!-- Section Etalase ikan -->
<section id="etalase" class="bg-[#EEF1F7] py-12 md:py-16">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl md:text-4xl font-bold text-center text-[#1B263B] mb-4">Koleksi Ikan Unggulan</h2>
    <p class="text-center text-gray-600 mb-10">Jenis ikan pilihan dengan kualitas terbaik</p>

    <?php
    $stmt = $pdo->query("SELECT * FROM etalase ORDER BY id ASC");
    $fish_data = $stmt->fetchAll();
    $totalSlides = count($fish_data);
    ?>

    <!-- Carousel dengan arrow di kiri/kanan (absolute) -->
    <div class="relative max-w-4xl mx-auto">
      <!-- Tombol panah kiri (absolute) -->
      <button id="fish-prev" class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white hover:bg-[#0D9488] hover:text-white text-[#1B263B] rounded-full p-2 shadow-md transition duration-300 focus:outline-none ml-[-12px] md:ml-[-20px]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>

      <!-- Tombol panah kanan (absolute) -->
      <button id="fish-next" class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white hover:bg-[#0D9488] hover:text-white text-[#1B263B] rounded-full p-2 shadow-md transition duration-300 focus:outline-none mr-[-12px] md:mr-[-20px]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>

      <!-- Wrapper carousel -->
      <div class="overflow-hidden">
        <div id="fishCarousel" class="flex transition-transform duration-500 ease-in-out">

      <!--CRUD DISPLAY ETALASE IKAN-->
        <?php foreach($fish_data as $fish): ?>
                        <div class="flex-shrink-0 w-full flex justify-center px-2">
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition max-w-xs w-full">
                                <img src="assets/images/fish/<?= $fish['gambar'] ?>" alt="<?= htmlspecialchars($fish['nama_ikan']) ?>" class="w-full h-30 place-content-center object-cover">
                                <div class="p-4">
                                    <h3 class="text-lg font-bold text-[#1B263B] mb-2"><?= htmlspecialchars($fish['nama_ikan']) ?></h3>
                                    <div class="text-gray-600 text-sm space-y-1">
                                        <?php 
                                        // Jika deskripsi berisi poin-poin (pisah newline), tampilkan sebagai list
                                        $poins = explode("\n", $fish['deskripsi']);
                                        foreach($poins as $poin):
                                            if(trim($poin) != ''):
                                        ?>
                                            <li class="list-disc list-inside"><?= htmlspecialchars(trim($poin)) ?></li>
                                        <?php 
                                            endif;
                                        endforeach; 
                                        ?>
                                    </div>
                                    <div class="mt-3">
                                        <span class="text-[#0D9488] font-semibold">Rp <?= number_format($fish['harga'], 0, ',', '.') ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

    <!-- Indikator dot -->
    <div class="flex justify-center mt-6 gap-2" id="fish-dots"></div>
  </div>
</section>

<script>
  (function() {
    const carousel = document.getElementById('fishCarousel');
    const prevBtn = document.getElementById('fish-prev');
    const nextBtn = document.getElementById('fish-next');
    const dotsContainer = document.getElementById('fish-dots');
    const slides = Array.from(carousel.children);
    const totalSlides = slides.length;
    let currentIndex = 0;
    let autoInterval = null;
    let autoSlideEnabled = true; // flag untuk mengaktifkan auto slide

    // Fungsi untuk menghentikan auto slide (permanen)
    function stopAutoSlide() {
      if (autoInterval) {
        clearInterval(autoInterval);
        autoInterval = null;
      }
      autoSlideEnabled = false;
    }

    function createDots() {
      dotsContainer.innerHTML = '';
      slides.forEach((_, i) => {
        const dot = document.createElement('button');
        dot.classList.add('w-3', 'h-3', 'rounded-full', 'transition', 'duration-300');
        if (i === currentIndex) {
          dot.classList.add('bg-[#0D9488]', 'w-5');
        } else {
          dot.classList.add('bg-gray-300', 'hover:bg-gray-400');
        }
        dot.addEventListener('click', () => {
          goToSlide(i);
          if (autoSlideEnabled) stopAutoSlide(); // nonaktifkan auto slide setelah klik dot
        });
        dotsContainer.appendChild(dot);
      });
    }

    function updateDots() {
      const dots = document.querySelectorAll('#fish-dots button');
      dots.forEach((dot, i) => {
        if (i === currentIndex) {
          dot.classList.remove('bg-gray-300', 'w-3');
          dot.classList.add('bg-[#0D9488]', 'w-5');
        } else {
          dot.classList.remove('bg-[#0D9488]', 'w-5');
          dot.classList.add('bg-gray-300', 'w-3');
        }
      });
    }

    function goToSlide(index) {
      if (index < 0) index = totalSlides - 1;
      if (index >= totalSlides) index = 0;
      currentIndex = index;
      const translateX = -currentIndex * 100;
      carousel.style.transform = `translateX(${translateX}%)`;
      updateDots();
    }

    function nextSlide() { goToSlide(currentIndex + 1); }
    function prevSlide() { goToSlide(currentIndex - 1); }

    function startAutoSlide() {
      if (autoSlideEnabled) {
        autoInterval = setInterval(() => {
          nextSlide();
        }, 8000); // 8 detik (lebih lambat)
      }
    }

    // Event listeners untuk tombol panah (nonaktifkan auto slide saat pertama kali diklik)
    prevBtn.addEventListener('click', () => {
      prevSlide();
      if (autoSlideEnabled) stopAutoSlide();
    });
    nextBtn.addEventListener('click', () => {
      nextSlide();
      if (autoSlideEnabled) stopAutoSlide();
    });

    // Inisialisasi
    createDots();
    goToSlide(0);
    startAutoSlide();
  })();
</script>

<!--REVIEW PELANGGAN-->
<!-- Section Testimoni Pelanggan - Horizontal Scroll -->
<section class="bg-gray-50 py-12 md:py-16">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl md:text-4xl font-bold text-center text-[#1B263B] mb-2">Apa Kata Mereka?</h2>
    <p class="text-center text-gray-600 mb-10">Testimoni dari pelanggan setia Fishan</p>

    <div class="overflow-x-auto pb-4">
      <div class="flex gap-6" style="min-width: max-content;">
        <?php
        // Ambil testimoni yang sudah disetujui (approved = 1)
        $stmt = $pdo->prepare("SELECT * FROM testimoni WHERE approved = 1 ORDER BY created_at DESC LIMIT 10");
        $stmt->execute();
        $testimonials = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($testimonials) > 0):
          foreach ($testimonials as $t):
        ?>
        <div class="bg-white rounded-xl shadow-lg p-5 w-80 flex-shrink-0 transition hover:shadow-xl">
          <div class="flex items-center gap-3 mb-3">
            <?php if($t['foto_bukti'] && file_exists("assets/images/testimonials/" . $t['foto_bukti'])): ?>
              <img src="assets/images/testimonials/<?= $t['foto_bukti'] ?>" class="w-12 h-12 rounded-full object-cover border-2 border-[#0D9488]">
            <?php else: ?>
              <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-bold">
                <?= strtoupper(substr($t['nama'], 0, 1)) ?>
              </div>
            <?php endif; ?>
            <div>
              <h4 class="font-bold text-gray-800"><?= htmlspecialchars($t['nama']) ?></h4>
              <div class="flex text-yellow-500 text-sm">
                <?= str_repeat('★', $t['rating']) ?><?= str_repeat('☆', 5 - $t['rating']) ?>
              </div>
            </div>
          </div>
          <p class="text-gray-600 text-sm italic">"<?= nl2br(htmlspecialchars($t['komentar'])) ?>"</p>
        </div>
        <?php
          endforeach;
        else:
        ?>
        <div class="text-center text-gray-500 w-full">Belum ada testimoni. Jadilah yang pertama!</div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Optional: indikator scroll (bisa dihilangkan) -->
    <div class="flex justify-center gap-2 mt-4">
      <span class="w-2 h-2 rounded-full bg-[#0D9488]"></span>
      <span class="w-2 h-2 rounded-full bg-gray-300"></span>
      <span class="w-2 h-2 rounded-full bg-gray-300"></span>
    </div>
  </div>
</section>

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