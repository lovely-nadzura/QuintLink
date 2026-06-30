<?php
require_once 'C:/xampp/htdocs/FISHAN/config/connect.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $hashed   = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah username atau email sudah ada (opsional, constraint UNIQUE akan menangani)
    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'user')");
        $stmt->execute([$username, $email, $hashed]);
        $success = "Registrasi berhasil! Silakan <a href='login.php' class='text-[#0D9488] font-semibold'>login</a>.";
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            $error = "Username atau email sudah terdaftar.";
        } else {
            $error = "Terjadi kesalahan: " . $e->getMessage();
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <link rel="icon" type="image/x-icon" href="/FISHAN/admin/assetsAdmin/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar | Fishan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    input:focus {
      outline: none;
      box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.2);
      border-color: #0D9488;
    }
  </style>
</head>
<body class="bg-gray-50">

  <!-- header -->
  <nav class="bg-[#1B263B] shadow-lg fixed w-full z-30 top-0 flex justify-between items-center">
    <div class="flex items-center gap-3 pl-4 py-3">
      <img src="/FISHAN/admin/assetsAdmin/fishan-bg-white.png" alt="Logo Fishan" class="h-11 w-auto">
      <span class="text-3xl text-white font-semibold">FISHAN</span>
    </div>
  </nav>


  <!-- Form Registrasi -->
  <div class="pt-24 pb-16 px-4">
    <div class="max-w-md mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
      <div class="bg-[#1B263B] py-4 px-6">
        <h2 class="text-2xl font-bold text-white text-center">Buat Akun Baru</h2>
      </div>
      <div class="p-6">
        <?php if ($success): ?>
          <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-center">
            <?= $success ?>
          </div>
        <?php elseif ($error): ?>
          <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg text-center">
            <?= $error ?>
          </div>
        <?php endif; ?>

        <form method="POST" class="space-y-5">
          <div>
            <label class="block text-gray-700 font-semibold mb-1">Username</label>
            <input type="text" name="username" required
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-[#0D9488] transition">
          </div>
          <div>
            <label class="block text-gray-700 font-semibold mb-1">Email</label>
            <input type="email" name="email" required
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-[#0D9488] transition">
          </div>
          <div>
            <label class="block text-gray-700 font-semibold mb-1">Password</label>
            <input type="password" name="password" required
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-[#0D9488] transition">
          </div>
          <button type="submit"
                  class="w-full bg-[#0D9488] hover:bg-[#0a7a70] text-white font-bold py-2 px-4 rounded-lg transition duration-200">
            Daftar Sekarang
          </button>
        </form>

        <p class="text-center text-gray-600 mt-6">
          Sudah punya akun? <a href="login.php" class="text-[#0D9488] font-semibold hover:underline">Masuk di sini</a>
        </p>
      </div>
    </div>
  </div>

  <footer class="bg-[#1B263B] text-white text-center py-4 mt-8">
    <p class="text-sm">&copy; <?= date('Y') ?> Fishan - Platform Ikan & Budidaya</p>
  </footer>
</body>
</html>