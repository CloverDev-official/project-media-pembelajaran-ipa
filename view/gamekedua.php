<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Puzzle Urutan - Edukasi IPA</title>
    <?php include '../shared/link.php';?>
</head>
<body>
<?php include '../shared/header.php'; ?>
    <main class="container mx-auto px-4 py-6">
        <!-- Dropdown untuk memilih urutan -->
        <div class="w-full max-w-md mb-6 mx-auto">
            <label for="sequenceSelect" class="block text-lg font-medium mb-2">Pilih Urutan:</label>
            <select id="sequenceSelect" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                <option value="">-- Pilih Urutan --</option>
                <!-- Opsi akan diisi oleh JavaScript -->
            </select>
        </div>

        <!-- Area untuk menampilkan deskripsi dan puzzle -->
        <div id="gameArea" class="hidden w-full max-w-4xl mx-auto">
            <div id="sequenceInfo" class="bg-white p-4 rounded-lg shadow-md mb-4">
                <h2 id="sequenceTitle" class="text-2xl font-bold mb-2 text-blue-700"></h2>
                <p id="sequenceDescription" class="text-gray-700 mb-4"></p>
            </div>

            <div class="flex flex-col md:flex-row gap-4">
                <!-- Area Item yang Bisa Di-Drag -->
                <div id="itemContainer" class="bg-gray-100 p-4 rounded-lg flex-grow flex flex-wrap gap-2 justify-center">
                    <!-- Item-item akan diisi oleh JavaScript -->
                </div>

                <!-- Area Tujuan untuk Disusun -->
                <div id="dropContainer" class="bg-blue-50 p-4 rounded-lg min-h-[150px] w-full md:w-1/2 border-2 border-dashed border-blue-300 flex flex-col gap-2">
                    <!-- Slot-slot untuk menempatkan item akan diisi oleh JavaScript -->
                </div>
            </div>

            <div class="mt-4 flex justify-center gap-2">
                <button id="validateBtn" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md disabled:bg-gray-400 transition duration-200">
                    Cek Jawaban
                </button>
                <button id="resetBtn" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md transition duration-200">
                    Reset
                </button>
                <button id="nextLevelBtn" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md hidden transition duration-200">
                    Level Selanjutnya
                </button>
            </div>
        </div>
    </main>

    <!-- Popup untuk notifikasi -->
    <div id="notificationPopup" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-sm w-full">
            <h3 id="popupTitle" class="text-xl font-bold mb-2"></h3>
            <p id="popupMessage" class="mb-4"></p>
            <button id="closePopupBtn" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md w-full transition duration-200">
                Tutup
            </button>
        </div>
    </div>
<?php include '../shared/footer.php';?>
    <!-- Sekarang kita tambahkan path ke file JSON sebagai data attribute di body atau script tag -->
    <script type="application/json" id="jsonDataPath">{"jsonPath": "../data/gamekedua_data.json"}</script>

    <script src="../script/gamekedua.js"></script>
</body>
</html>