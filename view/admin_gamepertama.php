<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Game Pencocokan Istilah & Definisi</title>
    <!-- Tidak menyertakan link.php untuk mencegah konflik CSS -->
     <?php include("../shared/link.php"); ?>
    <!-- Link ke CSS lokal admin -->
    <link rel="stylesheet" href="../shared/admin_gamepertama.css">
</head>
<body>
<!-- Tidak menyertakan header.php untuk mencegah konflik CSS dan JS -->
<?php include("../shared/header.php"); ?>

<!-- Bungkus konten admin dalam div dengan class khusus -->
<div class="admin-panel">
    <div class="container">
        <h1>Admin Panel - Game Pencocokan Istilah & Definisi</h1>
        <p>Kelola pasangan istilah dan definisi yang digunakan dalam game.</p>

        <!-- Pesan Status -->
        <div id="status-message" class="message hidden"></div>

        <!-- Form Tambah/Edit -->
        <div class="form-section">
            <h2 id="form-title">Tambah Pasangan Baru</h2>
            <form id="item-form">
                <input type="hidden" id="item-id">
                <label for="istilah">Istilah:</label><br>
                <input type="text" id="istilah" name="istilah" required><br><br>

                <label for="definisi">Definisi:</label><br>
                <textarea id="definisi" name="definisi" rows="3" required></textarea><br><br>

                <button type="submit" id="save-btn">Simpan</button>
                <button type="button" id="cancel-edit-btn" class="hidden">Batal Edit</button>
                 <button type="button" id="refresh-btn">Refresh Data</button> <!-- Tombol Refresh -->
            </form>
        </div>

        <!-- Daftar Pasangan -->
        <div class="list-section">
            <h2>Daftar Pasangan Istilah & Definisi</h2>
            <div id="loading" class="loading">Memuat data...</div>
            <!-- Bungkus tabel dalam div dengan scroll horizontal -->
            <div class="table-container">
                <table id="items-table" class="hidden">
                    <thead>
                        <tr>
                            <!-- Tambahkan data-label untuk responsif mobile -->
                            <th data-label="ID">ID</th>
                            <th data-label="Istilah">Istilah</th>
                            <th data-label="Definisi">Definisi</th>
                            <th data-label="Aksi" style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="items-body">
                        <!-- Data akan dimasukkan oleh JavaScript -->
                        <!-- CONTOH BARIS YANG AKAN DIMASUKKAN OLEH JS (PERHATIKAN data-label) -->
                        <!--
                        <tr>
                            <td data-label="ID">item_abc123...</td>
                            <td data-label="Istilah">Contoh Istilah</td>
                            <td data-label="Definisi">Ini adalah contoh definisi yang panjang sekali untuk melihat bagaimana responsif bekerja.</td>
                            <td data-label="Aksi" style="text-align:center;">
                                <button>Edit</button>
                                <button>Hapus</button>
                            </td>
                        </tr>
                        -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Penutup .admin-panel -->
<?php include("../shared/footer.php"); ?>
<!-- Link ke JavaScript admin -->
<script src="../script/admin_gamepertama.js"></script>

</body>
</html>