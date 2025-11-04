<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Pencocokan Istilah & Definisi </title>
    <?php include("../shared/link.php"); ?>
</head>
<body class="min-h-screen font-sans">

<?php include("../shared/header.php"); ?>
<div class="bg-subtle">
<main class="container mx-auto px-4 py-6 max-w-6xl">

    <!-- Judul Game -->
    <h1 class="text-3xl font-extrabold text-center text-gray-800 mb-2">🎮 Game Pencocokan Istilah & Definisi</h1>
    <p class="text-center text-gray-600 mb-8">Drag & drop istilah ke kotak definisi yang sesuai. Cek jawaban untuk melihat hasilnya!</p>

    <!-- Area Game -->
    <div class="flex flex-col lg:flex-row gap-8 justify-between">

        <!-- Kolom Istilah -->
        <div class="bg-white rounded-xl shadow-lg p-6 w-full lg:w-1/3">
            <h2 class="text-xl font-bold text-blue-600 border-b-2 border-blue-300 pb-2 mb-4">Istilah</h2>
            <div id="terms-container" class="space-y-3">
                <!-- Isi akan diisi oleh JavaScript -->
            </div>
        </div>

        <!-- Kolom Definisi -->
        <div class="bg-white rounded-xl shadow-lg p-6 w-full lg:w-2/3">
            <h2 class="text-xl font-bold text-blue-600 border-b-2 border-blue-300 pb-2 mb-4">Definisi</h2>
            <div id="definitions-container" class="space-y-4">
                <!-- Isi akan diisi oleh JavaScript -->
            </div>
        </div>

    </div>

    <!-- Tombol Aksi -->
    <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
        <button id="check-btn" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg shadow-md transition transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-300 w-full sm:w-auto">
            ✅ Cek Jawaban
        </button>
        <button id="reset-btn" class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-lg shadow-md transition transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-300 w-full sm:w-auto">
            🔄 Reset Game
        </button>
    </div>

    <!-- Pesan Status -->
    <div id="status-message" class="mt-6 p-4 rounded-lg shadow-md font-semibold text-center hidden"></div>

    <!-- Popup Peringatan -->
    <div id="popup-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl p-6 max-w-sm w-full text-center">
            <h3 id="popup-title" class="text-xl font-bold text-gray-800 mb-3">⚠️ Peringatan</h3>
            <p id="popup-message" class="text-gray-600 mb-5">Harap masukkan istilah ke semua kotak definisi sebelum mengecek jawaban.</p>
            <button id="popup-close-btn" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-6 rounded-lg transition duration-200">
                Tutup
            </button>
        </div>
    </div>

</main>
</div>
<?php include("../shared/footer.php"); ?>

<!-- Script -->
<script src="../script/gamepertama.js"></script>
<script src="../script/tema.js"></script>
<script src="../script/header.js"></script>

</body>
</html>