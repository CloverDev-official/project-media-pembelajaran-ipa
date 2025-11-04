<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Puzzle Urutan - Edukasi IPA</title>
    <?php include '../shared/link.php';?>
</head>
<body class="min-h-screen font-sans"> <!-- Tambahkan min-h-screen dan font-sans -->

<?php include '../shared/header.php'; ?>
<div class="bg-subtle">
<main class="container mx-auto px-4 py-8 max-w-6xl"> <!-- Tambahkan py-8 untuk jarak atas/bawah -->

    <!-- Judul Halaman -->
    <h1 class="text-3xl md:text-4xl font-extrabold text-center text-gray-800 mb-6">🧩 Game Puzzle Urutan</h1>
    <p class="text-center text-gray-600 mb-8">Susun item-item berikut ke dalam urutan yang benar!</p>

    <!-- Dropdown untuk memilih urutan -->
    <div class="w-full max-w-md mb-10 mx-auto">
        <label for="sequenceSelect" class="block text-lg font-semibold mb-3 text-gray-700">Pilih Puzzle:</label>
        <select id="sequenceSelect" class="w-full p-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-200 bg-white shadow-sm transition duration-200">
            <option value="">-- Pilih Puzzle --</option>
            <!-- Opsi akan diisi oleh JavaScript -->
        </select>
    </div>

    <!-- Area untuk menampilkan deskripsi dan puzzle -->
    <div id="gameArea" class="hidden w-full max-w-5xl mx-auto">
        <div id="sequenceInfo" class="bg-white rounded-2xl shadow-xl p-6 mb-8 border border-gray-200">
            <h2 id="sequenceTitle" class="text-2xl md:text-3xl font-bold mb-3 text-blue-700"></h2>
            <p id="sequenceDescription" class="text-gray-700 text-base md:text-lg"></p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8"> <!-- Tambahkan gap dan ubah layout untuk layar besar -->
            <!-- Area Item yang Bisa Di-Drag -->
            <div id="itemContainer" class="bg-gray-300 p-6 rounded-2xl shadow-lg flex-grow flex flex-wrap gap-3 justify-center max-h-[800px] min-h-[200px]">
                <!-- Item-item akan diisi oleh JavaScript -->
            </div>

            <!-- Area Tujuan untuk Disusun -->
            <div id="dropContainer" class="bg-gradient-to-br from-blue-50 to-cyan-50 p-6 rounded-2xl shadow-lg min-h-[250px] w-full lg:w-2/5 border-2 border-dashed border-blue-400 flex flex-col gap-4">
                <!-- Slot-slot untuk menempatkan item akan diisi oleh JavaScript -->
            </div>
        </div>

        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
            <button id="validateBtn" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-3 px-8 rounded-xl shadow-md transition transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-green-300">
                ✅ Cek Jawaban
            </button>
            <button id="resetBtn" class="bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-bold py-3 px-8 rounded-xl shadow-md transition transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-gray-300">
                🔄 Reset
            </button>
            <button id="nextLevelBtn" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-3 px-8 rounded-xl shadow-md transition transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300 hidden">
                🎯 Level Selanjutnya
            </button>
        </div>
    </div>
</main>
</div>
<!-- Popup untuk notifikasi -->
<div id="notificationPopup" class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center p-4 z-[1000]">
    <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full transform transition-all duration-300 scale-95 animate-popIn">
        <h3 id="popupTitle" class="text-2xl font-bold mb-4 text-center"></h3>
        <p id="popupMessage" class="text-gray-700 mb-6 text-center"></p>
        <button id="closePopupBtn" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-3 px-6 rounded-xl shadow-md w-full transition duration-200">
            Tutup
        </button>
    </div>
</div>

<?php include '../shared/footer.php';?>
<!-- Sekarang kita tambahkan path ke file JSON sebagai data attribute di body atau script tag -->
<script type="application/json" id="jsonDataPath">{"jsonPath": "../data/gamekedua_data.json"}</script>

<script src="../script/gamekedua.js"></script>
<script src="../script/tema.js"></script>
<script src="../script/header.js"></script>

</body>
</html>