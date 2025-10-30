<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Pencocokan Istilah & Definisi - Versi 10.6</title>
    <!-- Include link CSS eksternal (misalnya Tailwind) -->
    <?php include("../shared/link.php"); ?>
    <!-- Link ke CSS lokal -->
    <link rel="stylesheet" href="../shared/gamepertama.css">
</head>
<body>
<?php include("../shared/header.php"); ?>
<!-- Bungkus konten game dalam div dengan class khusus -->
<div class="game-pertama-container">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-2 text-center">Game Pencocokan: Istilah & Definisi</h1>
        <div class="instruction">
            <p>Drag & drop istilah ke kotak definisi yang sesuai. Tukar atau kembalikan dengan drag ulang. Cek jawaban untuk melihat hasilnya!</p>
        </div>

        <!-- Pesan Error -->
        <div id="error-message" class="text-red-500 text-center mb-4"></div>

        <!-- Area Pencocokan -->
        <div class="matching-area">
            <div class="terms-container" id="terms-container">
                <!-- Isi akan dimasukkan oleh JavaScript -->
            </div>

            <div class="definitions-container" id="definitions-container">
                <!-- Isi akan dimasukkan oleh JavaScript -->
            </div>
        </div>

        <!-- Tampilan Pasangan yang Dicocokkan (akan diisi saat cek jawaban) -->
        <div id="matched-display">
            <div id="matched-list">
                <!-- Pasangan akan dimasukkan oleh JavaScript saat cek jawaban -->
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="text-center mt-4">
            <button id="check-btn">Cek Jawaban</button>
            <button id="reset-btn">Reset Game</button>
        </div>

        <!-- Pesan Status -->
        <div id="status-message" class="status-message">
            <!-- Pesan akan diisi oleh JavaScript -->
        </div>

    </div>

    <!-- Popup Konfirmasi Versi 10.6 -->
    <div id="popup-overlay" class="popup-overlay">
        <div class="popup-content">
            <h3 id="popup-title">Peringatan</h3> <!-- Judul popup -->
            <p id="popup-message">Harap masukkan istilah ke semua kotak definisi.</p>
            <button id="popup-close-btn" class="">Tutup</button>
        </div>
    </div>
</div> <!-- Penutup .game-pertama-container -->

<?php include("../shared/footer.php"); ?>

<!-- Link ke JavaScript -->
<script src="../script/gamepertama.js"></script>
<script src="../script/tema.js"></script>
<script src="../script/header.js"></script>

</body>
</html>