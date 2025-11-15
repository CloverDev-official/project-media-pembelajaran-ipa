<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Game Puzzle Urutan</title>
    <?php include '../shared/link.php'; ?>
</head>
<body class="bg-gray-50 min-h-screen">
    <?php include '../shared/header.php'; ?>
    <main class="container mx-auto px-4 py-8">
        <!-- Notifikasi -->
        <div id="notificationToast" class="hidden fixed top-4 right-4 z-50 p-4 rounded-md shadow-lg text-white font-medium bg-green-500"></div>

        <!-- Tombol Refresh Manual -->
        <div class="mb-4 flex justify-end">
            <button id="refreshDataBtn" type="button" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md transition duration-200">
                Refresh Data
            </button>
        </div>

        <!-- Form Tambah -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8" id="addSequenceFormContainer">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Tambah Urutan Baru</h2>
            <form id="addSequenceForm">
                <div class="mb-4">
                    <label for="newSequenceId" class="block text-sm font-medium text-gray-600 mb-1">ID Urutan (unik):</label>
                    <input type="text" id="newSequenceId" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="newSequenceTitle" class="block text-sm font-medium text-gray-600 mb-1">Judul:</label>
                    <input type="text" id="newSequenceTitle" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="newSequenceDescription" class="block text-sm font-medium text-gray-600 mb-1">Deskripsi:</label>
                    <textarea id="newSequenceDescription" rows="2" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                <h3 class="font-medium mt-4 mb-2 text-gray-700">Item dalam Urutan (isi secara berurutan):</h3>
                <div id="newItemsContainer" class="space-y-2 mb-4">
                    <!-- Form item akan ditambahkan di sini -->
                </div>
                <div class="flex space-x-2">
                    <button id="addNewItemBtn" type="button" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md transition duration-200">
                        + Tambah Item
                    </button>
                    <button id="saveNewSequenceBtn" type="button" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md transition duration-200">
                        Simpan Urutan Baru
                    </button>
                </div>
            </form>
        </div>

        <!-- Form Edit (Sembunyikan secara default) -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8 hidden" id="editSequenceFormContainer">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Edit Urutan</h2>
            <form id="editSequenceForm">
                <input type="hidden" id="editingSequenceId"> <!-- Untuk menyimpan ID asli sebelum diedit -->
                <div class="mb-4">
                    <label for="editSequenceId" class="block text-sm font-medium text-gray-600 mb-1">ID Urutan (unik):</label>
                    <input type="text" id="editSequenceId" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
                </div>
                <div class="mb-4">
                    <label for="editSequenceTitle" class="block text-sm font-medium text-gray-600 mb-1">Judul:</label>
                    <input type="text" id="editSequenceTitle" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
                </div>
                <div class="mb-4">
                    <label for="editSequenceDescription" class="block text-sm font-medium text-gray-600 mb-1">Deskripsi:</label>
                    <textarea id="editSequenceDescription" rows="2" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"></textarea>
                </div>
                <h3 class="font-medium mt-4 mb-2 text-gray-700">Item dalam Urutan (isi secara berurutan):</h3>
                <div id="editItemsContainer" class="space-y-2 mb-4">
                    <!-- Item akan dimuat di sini -->
                </div>
                <div class="flex space-x-2">
                    <button id="addEditItemBtn" type="button" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md transition duration-200">
                        + Tambah Item
                    </button>
                    <button id="saveEditSequenceBtn" type="button" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-md transition duration-200">
                        Simpan Perubahan
                    </button>
                    <button id="cancelEditBtn" type="button" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-md transition duration-200">
                        Batal
                    </button>
                </div>
            </form>
        </div>

        <!-- Daftar Urutan -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Daftar Urutan</h2>
            <div id="sequencesList" class="space-y-6">
                <!-- Daftar urutan akan dimuat di sini -->
            </div>
        </div>
    </main>
    <?php include '../shared/footer.php'; ?>
    <script src="../script/admin_gamekedua.js"></script>
    <script src="../script/tema.js"></script>
    <script src="../script/header.js"></script>
</body>
</html>