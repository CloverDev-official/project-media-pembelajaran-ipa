<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Game Pencocokan Istilah & Definisi</title>
    <?php include("../shared/link.php"); ?>
</head>
<body class="bg-subtle min-h-screen">
<?php include("../sidebar/sidebarGim.php") ?>

<div class="admin-panel font-sans bg-gray-50 min-h-screen">
    <div class="container mx-auto max-w-6xl w-[95%] md:w-[90%] lg:w-[85%] my-5 p-5 bg-white rounded-lg shadow-md relative z-10 box-border">

        <h1 class="text-2xl font-bold text-gray-800 mb-2">Admin Panel - Game Pencocokan Istilah & Definisi</h1>
        <p class="text-gray-600 mb-6">Kelola pasangan istilah dan definisi yang digunakan dalam game.</p>

        <!-- Pesan Status -->
        <div id="status-message" class="hidden p-3 rounded mb-4"></div>

        <!-- Form Tambah/Edit -->
        <div class="form-section mb-8 p-4 border border-gray-300 rounded-md bg-gray-50">
            <h2 id="form-title" class="text-xl font-semibold text-gray-700 mb-4">Tambah Pasangan Baru</h2>
            <form id="item-form">
                <input type="hidden" id="item-id">
                <label for="istilah" class="block text-sm font-medium text-gray-700 mb-1">Istilah:</label><br>
                <input type="text" id="istilah" name="istilah" required class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 box-border mb-3"><br>

                <label for="definisi" class="block text-sm font-medium text-gray-700 mb-1">Definisi:</label><br>
                <textarea id="definisi" name="definisi" rows="3" required class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 box-border resize-vertical mb-4"></textarea><br>

                <button type="submit" id="save-btn" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md transition duration-200 mr-2 mb-2">Simpan</button>
                <button type="button" id="cancel-edit-btn" class="hidden bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md transition duration-200 mr-2 mb-2">Batal Edit</button>
                 <button type="button" id="refresh-btn" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md transition duration-200 mb-2">Refresh Data</button>
            </form>
        </div>

        <!-- Daftar Pasangan -->
        <div class="list-section">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Daftar Pasangan Istilah & Definisi</h2>
            <div id="loading" class="loading text-blue-500 text-center italic mb-4">Memuat data...</div>
            <!-- Bungkus tabel dalam div dengan scroll horizontal -->
            <div class="table-container overflow-x-auto mb-6 w-full">
                <table id="items-table" class="hidden w-full border-collapse mb-0 table-auto">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-3 py-2 text-left font-bold whitespace-nowrap">ID</th>
                            <th class="border border-gray-300 px-3 py-2 text-left font-bold whitespace-nowrap">Istilah</th>
                            <th class="border border-gray-300 px-3 py-2 text-left font-bold whitespace-nowrap">Definisi</th>
                            <th class="border border-gray-300 px-3 py-2 text-center font-bold whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="items-body">
                        <!-- Data akan dimasukkan oleh JavaScript -->
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