<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPAVERSE |Data Siswa</title>
    <?php include("../shared/link.php"); ?>
    <link rel="stylesheet" href="../shared/sidebarGuru.css">
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
                    <div class="flex  gap-5">
                        <!-- btn notifikasi -->
                        <button class="text-xl flex mt-[2px]">
                            <i class="bi bi-bell"></i>
                        </button>
                        <!-- btn keluar akun -->
                        <img src="../img/beruang.jpg" class="w-8 h-8 rounded-full hover:brightness-75 transition-colors duration-150" alt="">
                    </div>
                </nav>
            </header>
            <!-- wrapper table siswa -->
            <div class="min-h-screen">
                <div class=" bg-white border border-gray-300 p-4 rounded-md shadow-lg mt-5">
                    <!-- header table siswa-->
                    <div class="flex justify-between items-center my-4 px-2">
                        <h1 class=" font-semibold text-lg">Kelas 9A</h1>
                        <!-- button CRUD -->
                        <div class="flex gap-2 md:gap-4">
                            <a href="">
                                <button class="p-[4px] px-[8px] md:px-2 md:p-2 rounded-lg border bg-green-500 font-semibold text-xs md:text-sm capitalize text-white transition-all duration-150 hover:scale-105 active:scale-95 hover:bg-green-600">
                                    <i class="bi bi-plus-circle-fill"></i>
                                    tambah
                                </button>
                            </a>
                            <a href="">
                                <button class="p-[4px] px-[8px] md:px-2 md:p-2 rounded-lg border bg-red-500 font-semibold text-xs md:text-sm capitalize text-white transition-all duration-150 hover:scale-105 active:scale-95 hover:bg-red-600">
                                    <i class="bi bi-trash-fill"></i>
                                    hapus
                                </button>
                            </a>
                            <a href="">
                                <button class="p-[4px] px-[8px] md:px-2 md:p-2 rounded-lg border bg-yellow-500 font-semibold text-xs md:text-sm capitalize text-white transition-all duration-150 hover:scale-105 active:scale-95 hover:bg-yellow-600">
                                    <i class="bi bi-pen-fill"></i> 
                                    edit
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="rounded-lg border overflow-hidden shadow-lg">
                        <table class="table-auto  w-full">
                            <thead>
                                <tr class="bg-green-300 text-center">
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
    <!-- sidebar JS -->
    <script src="../script/sidebarGuru.js"></script>

</body>
</html>