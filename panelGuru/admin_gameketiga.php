<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Game Studi Kasus</title>
    <?php include '../shared/link.php'; ?>
    <!-- CSS Inline untuk ukuran font konsisten jika perlu -->
    <style>
        input, textarea, select {
            font-size: 1rem; /* text-base */
        }
        @media (min-width: 640px) {
            input, textarea, select {
                font-size: 1.125rem; /* text-lg */
            }
        }
    </style>
</head>
<body class="bg-subtle min-h-screen flex flex-col">
    <?php include '../shared/header.php'; ?>

    <main class="flex-grow container mx-auto px-4 py-8 max-w-6xl">
        <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Admin Game Studi Kasus IPA</h1>

        <!-- Notifikasi Toast -->
        <div id="notificationToast" class="fixed top-4 right-4 z-50 p-4 rounded-md shadow-lg text-white font-medium hidden"></div>

        <!-- Form Tambah Studi Kasus -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-gray-200">
            <h2 class="text-2xl font-semibold mb-6 text-gray-700 border-b pb-2">Tambah Studi Kasus Baru</h2>
            <form id="addSequenceForm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="newSequenceId" class="block text-sm font-medium text-gray-600 mb-2">ID Studi Kasus (unik):</label>
                        <input type="text" id="newSequenceId" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-base sm:text-lg" required>
                    </div>
                    <div>
                        <label for="newSequenceTitle" class="block text-sm font-medium text-gray-600 mb-2">Judul:</label>
                        <input type="text" id="newSequenceTitle" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-base sm:text-lg" required>
                    </div>
                </div>
                <div class="mb-6">
                    <label for="newSequenceDescription" class="block text-sm font-medium text-gray-600 mb-2">Deskripsi Singkat:</label>
                    <textarea id="newSequenceDescription" rows="2" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-base sm:text-lg" ></textarea>
                </div>
                <div class="mb-6">
                    <label for="newCaseStudyContent" class="block text-sm font-medium text-gray-600 mb-2">Isi Studi Kasus:</label>
                    <textarea id="newCaseStudyContent" rows="5" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-base sm:text-lg" placeholder="Masukkan narasi studi kasus di sini..."></textarea>
                </div>

                <h3 class="text-lg font-semibold mt-6 mb-4 text-gray-700 border-l-4 border-blue-500 pl-2">Pertanyaan:</h3>
                <div id="newQuestionsContainer" class="space-y-6 mb-6">
                    <!-- Form pertanyaan akan ditambahkan di sini -->
                </div>
                <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-2 sm:space-y-0">
                    <button type="button" id="addNewQuestionBtn" class="bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg transition duration-200 text-base sm:text-lg">
                        + Tambah Pertanyaan
                    </button>
                    <button type="button" id="saveNewSequenceBtn" class="bg-green-600 hover:bg-green-700 text-white py-3 px-6 rounded-lg transition duration-200 text-base sm:text-lg">
                        Simpan Studi Kasus Baru
                    </button>
                </div>
            </form>
        </div>

        <!-- Form Edit Studi Kasus (Sembunyikan secara default) -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-gray-200 hidden" id="editSequenceFormContainer">
            <h2 class="text-2xl font-semibold mb-6 text-gray-700 border-b pb-2">Edit Studi Kasus</h2>
            <form id="editSequenceForm">
                <input type="hidden" id="editingSequenceId">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="editSequenceId" class="block text-sm font-medium text-gray-600 mb-2">ID Studi Kasus (unik):</label>
                        <input type="text" id="editSequenceId" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 text-base sm:text-lg" required>
                    </div>
                    <div>
                        <label for="editSequenceTitle" class="block text-sm font-medium text-gray-600 mb-2">Judul:</label>
                        <input type="text" id="editSequenceTitle" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 text-base sm:text-lg" required>
                    </div>
                </div>
                <div class="mb-6">
                    <label for="editSequenceDescription" class="block text-sm font-medium text-gray-600 mb-2">Deskripsi Singkat:</label>
                    <textarea id="editSequenceDescription" rows="2" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 text-base sm:text-lg"></textarea>
                </div>
                <div class="mb-6">
                    <label for="editCaseStudyContent" class="block text-sm font-medium text-gray-600 mb-2">Isi Studi Kasus:</label>
                    <textarea id="editCaseStudyContent" rows="5" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 text-base sm:text-lg"></textarea>
                </div>

                <h3 class="text-lg font-semibold mt-6 mb-4 text-gray-700 border-l-4 border-blue-500 pl-2">Pertanyaan:</h3>
                <div id="editQuestionsContainer" class="space-y-6 mb-6">
                    <!-- Form pertanyaan akan ditambahkan di sini -->
                </div>
                <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-2 sm:space-y-0">
                    <button type="button" id="addEditQuestionBtn" class="bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg transition duration-200 text-base sm:text-lg">
                        + Tambah Pertanyaan
                    </button>
                    <button type="button" id="saveEditSequenceBtn" class="bg-yellow-600 hover:bg-yellow-700 text-white py-3 px-6 rounded-lg transition duration-200 text-base sm:text-lg">
                        Simpan Perubahan
                    </button>
                    <button type="button" id="cancelEditBtn" class="bg-gray-600 hover:bg-gray-700 text-white py-3 px-6 rounded-lg transition duration-200 text-base sm:text-lg">
                        Batal
                    </button>
                </div>
            </form>
        </div>

        <!-- Daftar Studi Kasus -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
            <h2 class="text-2xl font-semibold mb-6 text-gray-700 border-b pb-2">Daftar Studi Kasus</h2>
            <div id="sequencesList" class="space-y-6">
                <!-- Daftar studi kasus akan dimuat di sini -->
            </div>
        </div>
    </main>

    <?php include '../shared/footer.php'; ?>
    <script src="../script/admin_gameketiga.js"></script>
</body>
</html>