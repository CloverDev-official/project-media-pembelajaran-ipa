<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Studi Kasus</title>
    <?php include '../shared/link.php'; ?>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.5s ease-out forwards;
        }
    </style>
</head>
<body> <!-- Latar belakang gradasi -->

    <?php include '../shared/header.php'; // Contoh include header ?>
<div class="bg-subtle min-h-screen">
    <div class="min-h-screen flex flex-col items-center p-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-8 text-center text-main "> <!-- Judul dengan warna gradasi -->
            Game Studi Kasus IPA
        </h1>

        <script id="jsonDataPath" type="application/json">
            {"jsonPath": "../data/gameketiga_data.json"}
        </script>

        <!-- Card untuk dropdown pemilihan studi kasus -->
        <div class="w-full max-w-2xl mb-8 animate-fadeInUp">
            <div class="bg-white bg-opacity-80 backdrop-blur-sm rounded-xl shadow-lg p-6 border-2 border-dashed border-blue-300">
                <label for="sequenceSelect" class="block text-lg md:text-xl font-bold mb-4 text-gray-800">🔍 Pilih Studi Kasus IPA:</label>
                <select id="sequenceSelect" class="w-full p-3 text-base border-2 border-green-400 rounded-lg focus:outline-none focus:ring-4 focus:ring-green-200 bg-white">
                    <option value="">-- Ayo Pilih Studi Kasusmu! --</option>
                    <!-- Opsi akan diisi oleh JavaScript -->
                </select>
            </div>
        </div>

        <!-- Area untuk menampilkan deskripsi, studi kasus, dan pertanyaan -->
        <div id="gameArea" class="hidden w-full max-w-4xl mx-auto animate-fadeInUp">
            <!-- Card Informasi Studi Kasus -->
            <div class="bg-gradient-to-r from-yellow-100 to-orange-100 p-6 rounded-xl shadow-lg mb-6 border-2 border-yellow-300">
                <h2 id="sequenceTitle" class="text-2xl md:text-3xl font-extrabold mb-2 text-gray-800"></h2>
                <p id="sequenceDescription" class="text-gray-700 text-lg italic"></p>
            </div>

            <!-- Card Isi Studi Kasus -->
            <div class="bg-subtle p-6 rounded-xl shadow-lg mb-6 border-2 border-main">
                <h3 class="text-xl md:text-2xl font-semibold mb-3 text-gray-800 flex items-center">
                    <span class="mr-2">📚</span> Cerita Studi Kasus:
                </h3>
                <div id="caseStudyContent" class="whitespace-pre-line text-gray-800 text-lg bg-white bg-opacity-50 p-4 rounded-lg"></div>
            </div>

            <!-- Card Pertanyaan -->
            <div class="bg-gradient-to-r from-green-100 to-emerald-100 p-6 rounded-xl shadow-lg mb-6 border-2 border-green-300">
                <h3 class="text-xl md:text-2xl font-semibold mb-3 text-gray-800 flex items-center">
                    <span class="mr-2">❓</span> Ayo Uji Pemahamanmu!
                </h3>
                <div id="questionsContainer" class="space-y-4">
                    <!-- Pertanyaan akan diisi oleh JavaScript -->
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-6 flex flex-col sm:flex-row justify-center gap-4">
                <button id="validateBtn" class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-green-300">
                    ✅ Cek Jawaban
                </button>
                <button id="resetBtn" class="bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-gray-300">
                    🔄 Reset
                </button>
            </div>
        </div>

        <!-- Popup untuk notifikasi (jika diperlukan, bisa juga diganti dengan toast notification yang lebih modern) -->
        <div id="notificationPopup" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div class="bg-white p-6 rounded-xl shadow-2xl max-w-sm w-full animate-fadeInUp">
                <h3 id="popupTitle" class="text-xl font-bold mb-2 text-green-600"></h3>
                <p id="popupMessage" class="mb-4 text-gray-700"></p>
                <button id="closePopupBtn" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md w-full transition duration-200">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
    <?php include '../shared/footer.php'; // Contoh include footer ?>
    <script src="../script/gameketiga.js"></script>
    <script src="../script/tema.js"></script>
    <script src="../script/header.js"></script>
</body>
</html>