<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPAVERSE |Rekap Nilai</title>
    <?php include("../shared/link.php"); ?>
    <link rel="stylesheet" href="../shared/sidebarGuru.css">
</head>
<body class="bg-gray-50">
    <main class="min-h-screen">
        <!-- sidebar -->
        <?php include("../sidebar/sidebarRekapNilai.php") ?>

        <!-- konten -->
         <div id="content" class="flex-1 transition-all duration-300 p-5">
            <!-- header -->
            <header class="">
                <nav class="flex justify-between gap-5">
                    <!-- teks selamat datang -->
                    <div class="flex flex-col text-start ">
                        <h1 class="text-lg md:text-3xl font-bold capitalize">rekap nilai</h1>
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
            <!-- wrapper tabel rekap nilai siswa -->
            <div class="min-h-screen">

                <div class="bg-white p-4 mt-5 rounded-md shadow-md">
                    <div class="flex justify-between px-2 my-4">
                        <h1 class=" font-semibold text-lg uppercase">Kelas 9a</h1>
                        <a href="">
                            <button class="p-2 rounded-lg border text-sm bg-green-800 font-normal capitalize text-white transition-all duration-150 hover:scale-105 active:scale-95">
                                <i class="fa-solid fa-file-excel"></i> excel
                            </button>
                        </a>
                    </div>
                    <!-- container tabel rekap nilai siswa  -->
                    <div class="rounded-lg border overflow-hidden shadow-lg">
                        <!-- wrapper scroll horizontal -->
                        <div class="overflow-x-auto">
                            <!-- tabel rekap nilai -->
                            <table class="table-auto lg:w-full min-w-max">
                                <thead>
                                    <tr class="bg-green-300 text-center">
                                    <th class="border-r border-black px-4 py-2 font-normal capitalize">no.</th>
                                    <th class="border-r border-black px-4 py-2 font-normal capitalize">nama siswa</th>
                                    <th class="border-r border-black px-4 py-2 font-normal capitalize">bab 1</th>
                                    <th class="border-r border-black px-4 py-2 font-normal capitalize">bab 2</th>
                                    <th class="border-r border-black px-4 py-2 font-normal capitalize">bab 3</th>
                                    <th class="border-r border-black px-4 py-2 font-normal capitalize">bab 4</th>
                                    <th class="border-r border-black px-4 py-2 font-normal capitalize">bab 5</th>
                                    <th class="border-r border-black px-4 py-2 font-normal capitalize">bab 6</th>
                                    <th class="border-r border-black px-4 py-2 font-normal capitalize">bab 7</th>
                                    <th class="border-r border-black px-4 py-2 font-normal capitalize">ulangan</th>
                                    <th class="px-4 py-2 font-normal capitalize">rata - rata</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <!-- data -->
                                    <tr class="bg-white hover:bg-gray-200">
                                        <td class="border-t border-r px-4 py-2">1</td>
                                        <td class="border-t border-r px-4 py-2 capitalize">ghaizan</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t px-4 py-2">90</td>
                                    </tr>
                                    <!-- data -->
                                    <tr class="bg-white hover:bg-gray-200">
                                        <td class="border-t border-r px-4 py-2">1</td>
                                        <td class="border-t border-r px-4 py-2 capitalize">ghaizan</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t px-4 py-2">90</td>
                                    </tr>
                                    <!-- data -->
                                    <tr class="bg-white hover:bg-gray-200">
                                        <td class="border-t border-r px-4 py-2">1</td>
                                        <td class="border-t border-r px-4 py-2 capitalize">ghaizan</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t px-4 py-2">90</td>
                                    </tr>                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- wrapper tabel rekap nilai siswa -->
                <div class="bg-white p-4 mt-5 rounded-md shadow-md">
                    <div class="flex justify-between px-2 my-4  ">
                        <h1 class="font-semibold text-lg uppercase">Kelas 9b</h1>
                        <a href="">
                            <button class="p-2 rounded-lg text-sm border bg-green-800 font-normal capitalize text-white transition-all duration-150 hover:scale-105 active:scale-95">
                                <i class="fa-solid fa-file-excel"></i> excel
                            </button>
                        </a>
                    </div>
                    <!-- container tabel rekap nilai siswa  -->
                    <div class="rounded-lg border overflow-hidden shadow-lg">
                        <!-- wrapper scroll horizontal -->
                        <div class="overflow-x-auto">
                            <!-- tabel rekap nilai -->
                            <table class="table-auto lg:w-full min-w-max">
                                <!-- table head -->
                                <thead>
                                    <tr class="bg-green-300 text-center">
                                    <th class="border-r border-black px-4 py-2 font-normal capitalize">no.</th>
                                    <th class="border-r border-black px-4 py-2 font-normal capitalize">nama siswa</th>
                                    <th class="border-r border-black px-4 py-2 font-normal capitalize">bab 1</th>
                                    <th class="border-r border-black px-4 py-2 font-normal capitalize">bab 2</th>
                                    <th class="border-r border-black px-4 py-2 font-normal capitalize">bab 3</th>
                                    <th class="border-r border-black px-4 py-2 font-normal capitalize">bab 4</th>
                                    <th class="border-r border-black px-4 py-2 font-normal capitalize">bab 5</th>
                                    <th class="border-r border-black px-4 py-2 font-normal capitalize">bab 6</th>
                                    <th class="border-r border-black px-4 py-2 font-normal capitalize">bab 7</th>
                                    <th class="border-r border-black px-4 py-2 font-normal capitalize">ulangan</th>
                                    <th class="px-4 py-2 font-normal capitalize">rata - rata</th>
                                    </tr>
                                </thead>
                                <!-- table body -->
                                <tbody class="text-center">
                                    <!-- data -->
                                    <tr class="bg-white hover:bg-gray-200">
                                        <td class="border-t border-r px-4 py-2">1</td>
                                        <td class="border-t border-r px-4 py-2 capitalize">muhammad ghaizan pratama maulana</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t px-4 py-2">90</td>
                                    </tr>
                                    <!-- data -->
                                    <tr class="bg-white hover:bg-gray-200">
                                        <td class="border-t border-r px-4 py-2">1</td>
                                        <td class="border-t border-r px-4 py-2 capitalize">ghaizan</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t px-4 py-2">90</td>
                                    </tr>
                                    <!-- data -->
                                    <tr class="bg-white hover:bg-gray-200">
                                        <td class="border-t border-r px-4 py-2">1</td>
                                        <td class="border-t border-r px-4 py-2 capitalize">ghaizan</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t border-r px-4 py-2">90</td>
                                        <td class="border-t px-4 py-2">90</td>
                                    </tr>                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer -->
            <?php include("../shared/footer.php")  ?>
         </div>
    </main>
    <!-- javascript -->
    <script src="../script/sidebarGuru.js"></script>

</body>
</html>