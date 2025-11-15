<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Pencocokan Istilah & Definisi - Versi 2.0</title>
    <?php include("../shared/link.php"); ?>
    <!-- Hapus include CSS kustom -->
    <!-- <link rel="stylesheet" href="../shared/gamepertama.css"> -->
</head>
<body class="bg-subtle min-h-screen font-sans">

<?php include("../shared/header.php"); ?>

<main class="container mx-auto px-4 py-8 max-w-6xl">
    <!-- Judul Game -->
    <h1 class="text-3xl md:text-4xl font-extrabold text-center text-gray-800 mb-3">🎮 Game Pencocokan Istilah & Definisi</h1>
    <p class="text-center text-gray-600 mb-8 text-lg">Drag & drop istilah ke kotak definisi yang sesuai. Cek jawaban untuk melihat hasilnya!</p>

    <!-- Area Game -->
    <div class="flex flex-col lg:flex-row gap-8 justify-between">

        <!-- Kolom Istilah -->
        <div class="bg-white rounded-2xl shadow-xl p-6 w-full lg:w-1/3 border border-gray-200">
            <h2 class="text-xl font-bold text-blue-600 border-b-2 border-blue-300 pb-2 mb-4">Istilah</h2>
            <div id="terms-container" class="space-y-4">
                <!-- Isi akan diisi oleh JavaScript -->
            </div>
        </div>

        <!-- Kolom Definisi -->
        <div class="bg-white rounded-2xl shadow-xl p-6 w-full lg:w-2/3 border border-gray-200">
            <h2 class="text-xl font-bold text-blue-600 border-b-2 border-blue-300 pb-2 mb-4">Definisi</h2>
            <div id="definitions-container" class="space-y-5">
                <!-- Isi akan diisi oleh JavaScript -->
            </div>
        </div>

    </div>

    <!-- Tombol Aksi -->
    <div class="mt-10 flex flex-col sm:flex-row gap-5 justify-center">
        <button id="check-btn" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-3 px-8 rounded-xl shadow-md transition transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-green-300 w-full sm:w-auto">
            ✅ Cek Jawaban
        </button>
        <button id="reset-btn" class="bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-bold py-3 px-8 rounded-xl shadow-md transition transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-gray-300 w-full sm:w-auto">
            🔄 Reset Game
        </button>
    </div>

    <!-- Pesan Status -->
    <div id="status-message" class="mt-6 p-4 rounded-lg shadow-md font-semibold text-center hidden"></div>

    <!-- Popup Peringatan -->
    <div id="popup-overlay" class="hidden fixed inset-0 bg-black bg-opacity-60 z-[1000] flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl p-6 max-w-sm w-full text-center transform transition-all duration-300 scale-95 animate-popIn">
            <h3 id="popup-title" class="text-xl font-bold text-gray-800 mb-3">⚠️ Peringatan</h3>
            <p id="popup-message" class="text-gray-600 mb-5">Harap masukkan istilah ke semua kotak definisi sebelum mengecek jawaban.</p>
            <button id="popup-close-btn" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-medium py-3 px-6 rounded-xl shadow-md w-full transition duration-200">
                Tutup
            </button>
        </div>
    </div>

</main>

<?php include("../shared/footer.php"); ?>

<!-- Script -->
<script src="../script/gamepertama.js"></script>
<script src="../script/tema.js"></script>
<script src="../script/header.js"></script>

<!-- Tambahkan style inline sementara untuk animasi popup jika Tailwind tidak mendukung -->
<style>
    @keyframes popIn {
        0% { transform: scale(0.95); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
    .animate-popIn {
        animation: popIn 0.3s ease-out forwards;
    }
</style>

</body>
</html>