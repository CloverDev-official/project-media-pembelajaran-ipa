<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPAVERSE | Ulangan Bab 1</title>
    <?php include("../shared/link.php"); ?>
</head>
<body>
    <div class="bg-subtle min-h-screen">
        <!-- navbar -->
        <?php include("../shared/header.php"); ?>
        <!-- container -->
        <div class=" mt-10 pb-40">
            <!-- judul -->
            <h1 class="text-center text-4xl text-main text-shadow-sm font-bold capitalize">ulangan BAB 1</h1>
            
             <!-- Timer dan Progress -->
            <div class="max-w-3xl mx-auto mt-5 p-4">
                <div class="flex justify-between mb-3">
                <p id="timer" class="text-lg font-semibold text-main">Waktu: <span id="time">02:00</span></p>
                <p id="progressText" class="text-lg font-semibold text-gray-600">0/3 Soal Terjawab</p>
                </div>
                <div class="w-full bg-gray-300 h-3 rounded-lg overflow-hidden">
                <div id="progressBar" class="h-3 bg-green-500 w-0 transition-all duration-300"></div>
                </div>
            </div>

            <!-- Container Soal -->
            <div class="max-w-6xl mx-5 md:mx-auto mt-5 bg-white rounded-lg shadow-lg p-6">
                <div id="soalContainer"></div>

                <!-- Pagination -->
                <div id="pagination" class="flex justify-center mt-6 gap-3"></div>

                <!-- Tombol Navigasi -->
                <div class="flex justify-end mt-6">
                <button id="nextBtn" class="bg-main text-white px-6 py-2 rounded-lg bg-hover-dark transition">Selanjutnya</button>
                </div>
            </div>

            <!-- Modal Peringatan -->
            <div id="modalPeringatan" class="fixed inset-0 bg-black/40 bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80 text-center">
                <h2 class="text-xl font-bold mb-3">⚠️ Peringatan</h2>
                <p class="mb-4">Masih ada soal yang belum kamu jawab!</p>
                <button id="closeModal" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Tutup</button>
                </div>
            </div>

            <!-- Hasil Ulangan -->
            <div id="hasilContainer" class="hidden max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4 text-main">Hasil Ulangan</h2>
                <div id="hasilList" class="space-y-3"></div>
            </div>
        </div>
    </div>
    <?php
        // footer
        include("../shared/footer.php");
    ?>
    <!-- == javascript == -->
    
    <!-- header -->
    <script src="../script/header.js"></script>

    <!-- tema -->
    <script src="../script/tema.js"></script>

    <!-- ulangan  -->
    <script src="../script/ulangan.js"></script>



</body>
</html>