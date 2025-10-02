<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPAVERSE | Data Siswa</title>
    <?php include("../shared/link.php"); ?>
    <link rel="stylesheet" href="../shared/sidebarGuru.css">
    
</head>
<body class="bg-subtle" >
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
                    <!-- modal tambah -->
                    <?php include("../modalPopUp/modalTambahSiswa.php") ?>
                    <!-- modal hapus -->
                    <?php include("../modalPopUp/modalHapusSiswa.php") ?>
                    <!-- modal edit -->
                    <?php include("../modalPopUp/modalEditSiswa.php") ?>
                    

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
    <!-- tema js -->
    <script src="../script/tema.js"></script>    
    <!-- sidebar JS -->
    <script src="../script/sidebarGuru.js"></script>
    <!--  -->
    <script src="../script/modalCRUD.js"></script>

</body>
</html>