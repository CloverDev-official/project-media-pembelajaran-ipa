<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPAVERSE | Data Siswa</title>
    <?php include("../shared/link.php"); ?>
    <link rel="stylesheet" href="../shared/sidebarGuru.css">
    <link rel="stylesheet" href="../shared/tema.css">
</head>
<body class="bg-gray-50">
    <main class="min-h-screen">
        <!-- sidebar -->
        <?php include("../sidebar/sidebarDataSiswa.php") ?>
        <!-- konten -->
        <div id="content" class="flex-1 transition-all duration-300 p-5">
            <!-- header -->
            <header class="">
                <nav class="flex justify-between gap-5">
                    <!-- teks selamat datang -->
                    <div class="flex flex-col text-start ">
                        <h1 class="text-lg md:text-3xl font-bold capitalize">data siswa</h1>
                        <h1 class="text-md md:text-lg font-normal text-gray-400">september 13, sabtu</h1>
                    </div>
                    <?php include("../shared/headerGuru.php") ?>
                </nav>
            </header>
            <!-- wrapper table siswa -->
            <div class="min-h-screen">
                <div class=" bg-white border border-gray-300 p-4 rounded-md shadow-lg mt-5">
                    <!-- header table siswa-->
                    <div class="flex justify-between gap-1 items-center md:items-start my-4 px-2">
                        <h1 class=" font-semibold text-lg md:text-xl">Kelas 9A</h1>
                        <!-- button CRUD -->
                        <div class="flex gap-2 md:gap-4 mb-4 mt-4 md:mt-0">
                            <!-- btn tambah -->
                            <button id="btn-tambah" class="text-sm border-l-4 border-b-4 border-green-500  active:border-0  px-4 py-2 bg-green-400  rounded-lg text-white text-shadow-md font-semibold transition-all duration-150 shadow-md capitalize hover:scale-105 active:scale-95">
                                tambah
                            </button>
                            <!-- btn hapus -->
                            <button id="btn-hapus" class="text-sm border-l-4 border-b-4 border-red-500  active:border-0  px-4 py-2 bg-red-400  rounded-lg text-white text-shadow-md font-semibold transition-all duration-150 shadow-md capitalize hover:scale-105 active:scale-95">
                                hapus
                            </button>
                            <!-- btn edit -->
                            <button id="btn-edit" class="text-sm border-l-4 border-b-4 border-yellow-500  active:border-0  px-4 py-2 bg-yellow-400  rounded-lg text-white text-shadow-md font-semibold transition-all duration-150 shadow-md capitalize hover:scale-105 active:scale-95">
                                edit 
                            </button>
                        </div>
                    </div>
                    <!-- Modal Tambah -->
                    <div id="modalTambah" class="fixed inset-0  hidden items-center justify-center z-50">
                        <!-- Overlay -->
                        <div id="overlayTambah" class="absolute inset-0 bg-black/50"></div>
                        <!-- Konten Modal -->
                        <div class="relative bg-white rounded-lg shadow-md p-6 z-10 w-80 md:w-96">
                            <div class="flex flex-col mb-4 text-center">
                                <h2 class="text-xl font-semibold capitalize">tambah siswa</h2>
                                <p class="font-normal text-gray-400 text-sm capitalize">tambahkan siswa baru disini</p>
                            </div>
                            
                            <form id="formTambah" class="flex flex-col gap-4">
                                <input type="text" id="nama" name="nama" required 
                                    placeholder="Nama siswa"
                                    class="w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                                <input type="text" id="absen" name="absen" required 
                                    placeholder="Nomor Absen Siswa"
                                    class="w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                                
                                <div class="flex justify-between gap-2 mt-4">
                                    <button type="button" id="btnCloseTambah" 
                                            class="px-4 py-2 bg-red-500 text-white rounded-lg transition-all duration-150 hover:bg-red-600 hover:scale-105 active:scale-95">Batal</button>
                                    <button type="submit" 
                                            class="px-4 py-2 bg-green-500 text-white rounded-lg transition-all duration-150 hover:bg-green-600 hover:scale-105 active:scale-95">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Modal hapus -->
                    <div id="modalHapus" class="fixed inset-0  hidden items-center justify-center z-50">
                        <!-- Overlay -->
                        <div id="overlayHapus" class="absolute inset-0 bg-black/50"></div>
                        <!-- Konten Modal -->
                        <div class="relative bg-white rounded-lg shadow-md p-6 z-10 w-80 md:w-96">
                            <div class="flex flex-col mb-4 text-center">
                                <h2 class="text-xl font-semibold capitalize">Hapus siswa</h2>
                                <p class="font-normal text-gray-400 text-sm capitalize">hapus data siswa disini</p>
                            </div>
                            
                            <form id="formHapus" class="flex flex-col gap-4">
                                <input type="text" id="nama" name="nama" required 
                                    placeholder="Nama siswa"
                                    class="w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                                <input type="text" id="absen" name="absen" required 
                                    placeholder="Nomor Absen Siswa"
                                    class="w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                                
                                <div class="flex justify-between gap-2 mt-4">
                                    <button type="button" id="btnCloseHapus" 
                                            class="px-4 py-2 bg-red-500 text-white rounded-lg transition-all duration-150 hover:bg-red-600 hover:scale-105 active:scale-95">Batal</button>
                                    <button type="submit" 
                                            class="px-4 py-2 bg-green-500 text-white rounded-lg transition-all duration-150 hover:bg-green-600 hover:scale-105 active:scale-95">hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Modal Edit -->
                    <div id="modalEdit" class="fixed inset-0  hidden items-center justify-center z-50">
                        <!-- Overlay -->
                        <div id="overlayEdit" class="absolute inset-0 bg-black/50"></div>
                        <!-- Konten Modal -->
                        <div class="relative bg-white rounded-lg shadow-md p-6 z-10 w-80 md:w-96">
                            <div class="flex flex-col mb-4 text-center">
                                <h2 class="text-xl font-semibold capitalize">Edit siswa</h2>
                                <p class="font-normal text-gray-400 text-sm capitalize">edit data siswa disini</p>
                            </div>
                            
                            <form id="formEdit" class="flex flex-col gap-4">
                                <input type="text" id="nama" name="nama" required 
                                    placeholder="Nama siswa"
                                    class="w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                                <input type="text" id="absen" name="absen" required 
                                    placeholder="Nomor Absen Siswa"
                                    class="w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                                
                                <div class="flex justify-between gap-2 mt-4">
                                    <button type="button" id="btnCloseEdit" 
                                            class="px-4 py-2 bg-red-500 text-white rounded-lg transition-all duration-150 hover:bg-red-600 hover:scale-105 active:scale-95">Batal</button>
                                    <button type="submit" 
                                            class="px-4 py-2 bg-green-500 text-white rounded-lg transition-all duration-150 hover:bg-green-600 hover:scale-105 active:scale-95">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    

                    <div class="rounded-lg border overflow-hidden shadow-lg">
                        <table class="table-auto  w-full">
                            <thead>
                                <tr class="bg-main-light text-center">
                                    <th class="border-r border-black px-4 py-2  capitalize">no</th>
                                    <th class="border-r border-black px-4 py-2  capitalize">nama siswa
                                    </th>
                                    <th class=" px-4 py-2  capitalize">kelas</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr class="bg-white hover:bg-gray-200">
                                    <td class="border-t border-r px-4 py-2">1</td>
                                    <td class="border-t border-r px-4 py-2 capitalize">ghaizan</td>
                                    <td class="border-t  px-4 py-2 uppercase">9a</td>
                                </tr>
                                <tr class="bg-white hover:bg-gray-200">
                                    <td class="border-t border-r px-4 py-2">2</td>
                                    <td class="border-t border-r px-4 py-2 capitalize">ghaizan</td>
                                    <td class="border-t  px-4 py-2 uppercase">9a</td>
                                </tr>
                                <tr class="bg-white hover:bg-gray-200">
                                    <td class="border-t border-r px-4 py-2">3</td>
                                    <td class="border-t border-r px-4 py-2 capitalize">ghaizan</td>
                                    <td class="border-t  px-4 py-2 uppercase">9a</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- footer -->
            <?php include("../shared/footer.php") ?>
         </div>
    </main>
    <!-- js header -->
    <script src="../script/headerGuru.js"></script>
    <!-- sidebar JS -->
    <script src="../script/sidebarGuru.js"></script>
    <!--  -->
    <script src="../script/modalCRUD.js"></script>

</body>
</html>