<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPAVERSE | Ulangan Edit </title>
    <?php include("../shared/link.php"); ?>
    <link rel="stylesheet" href="../shared/sidebarGuru.css">
    <link rel="stylesheet" href="../shared/tema.css">
</head>
<body>
    <!-- sidebar -->
    <?php include("../sidebar/sidebarUlangan.php") ?>
    <!-- container -->
    <div class="min-h-screen bg-subtle">
        <!-- wrapper -->
        <div id="content" class="flex-1 transition-all duration-300">
            <!-- wrapper konten-->
            <div class="p-5">
                <!-- header -->
                <header>
                    <nav class="flex justify-between gap-5">
                        <div class="flex flex-col text-start">
                            <h1 class="text-lg md:text-3xl font-bold  capitalize">ulangan</h1>
                            <h1 class="text-md md:text-lg font-normal text-gray-400">september 13, sabtu</h1>
                        </div>
                        <?php include("../shared/headerGuru.php") ?>
                    </nav>
                </header>
                <!-- konten -->
                <main class="mt-5 mb-20">
                    <div class="bg-white p-4 rounded-lg shadow">
                        <div id="formPengaturan">
                            <!-- waktu Pengerjaan -->
                            <div class="mb-4">
                                <label class="block font-semibold mb-1">Waktu Pengerjaan:</label>
                                <div class="flex gap-2">
                                    <input type="number" id="jam" min="0" placeholder="Jam" class="w-1/3 border p-2 rounded-lg">
                                    <input type="number" id="menit" min="0" max="59" placeholder="Menit" class="w-1/3 border p-2 rounded-lg">
                                    <input type="number" id="detik" min="0" max="59" placeholder="Detik" class="w-1/3 border p-2 rounded-lg">
                                </div>
                            </div>
                            <!-- jumlah soal -->
                            <div class="mb-4">
                                <label class="block font-semibold mb-1">Jumlah Soal (maks. 100):</label>
                                <input type="number" id="jumlahSoal" min="1" max="100" placeholder="contoh: 10" class="w-full border p-2 rounded-lg">
                            </div>
                            <!-- kelas -->
                            <div class="mb-4">
                                <label class="block font-semibold mb-1">Kelas</label>
                                <select name="" id="" class="w-full border p-2 rounded-lg" required>
                                    <option  class="capitalize">kelas</option>
                                    <option value="9a" class="capitalize">9a</option>
                                    <option value="9b" class="capitalize">9b</option>
                                </select>
                            </div>
                            <!-- waktu dibuka-->
                            <div class="mb-4">
                                <label class="block font-semibold mb-1">Waktu Dibuka:</label>
                                <input type="datetime-local" id="waktuDibuka" class="w-full border p-2 rounded-lg" required >
                            </div>
                            <!-- waktu ditutup -->
                            <div class="mb-4">
                                <label class="block font-semibold mb-1">Waktu Ditutup:</label>
                                <input type="datetime-local" id="waktuDitutup" class="w-full border p-2 rounded-lg" required >
                            </div>
                            <div>
                            
                            </div>
                            <!-- tombol selanjutnya -->
                            <button id="btnSelanjutnya" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                Selanjutnya
                            </button>
                        </div>
    
                        <!-- FORM SOAL ULANGAN (DINAMIS) -->
                        <form id="formSoal" class="hidden">
                            <div id="containerSoal"></div>
    
                            <div class="flex justify-between mt-5">
                                <button type="button" id="btnKembali" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                                    Kembali
                                </button>
                                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                                    Simpan Semua Soal
                                </button>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
            <?php include("../shared/footer.php") ?>
        </div>
    </div>
    <!-- js notif -->
    <script src="../script/notif.js"></script>
    <!-- js sidebar guru -->
    <script src="../script/sidebarGuru.js"></script>
    <!-- js tema -->
    <script src="../script/tema.js"></script>
    <!-- js form edit ulangan -->
    <script src="../script/editUlangan.js"></script>
</body>
</html>