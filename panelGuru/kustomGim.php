<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPAVERSE | Kustom Gim</title>
    <?php include("../shared/link.php") ?>
    <link rel="stylesheet" href="../shared/sidebarGuru.css">
    <link rel="stylesheet" href="../shared/tema.css">
</head>
<body class="relative">
    <div class="bg-subtle min-h-screen">
        <!-- sidebar -->
        <?php include("../sidebar/sidebarGim.php") ?>
        <!-- container -->
        <div id="content" class="flex-1 transition-all duration-300">
            <!-- wrapper  -->
            <div class="p-5">
                <!-- header -->
                <header>
                    <nav class="flex justify-between gap-5">
                        <div class="flex flex-col text-start">
                            <h1 class="text-lg md:text-3xl font-bold capitalize">Gim</h1>
                            <h1 class="text-md md:text-lg font-normal text-gray-400">september 13, sabtu</h1>                        
                        </div>
                        <?php include("../shared/headerGuru.php") ?>
                    </nav>
                </header>
                <!-- wrapper konten -->
                <div class="mt-10 flex flex-col justify-center md:justify-start">
                    <!-- wrapper btn tambah -->
                    <div class="flex justify-start mb-5">
                    </div>
                    <!-- grid -->
                    <div class="mt-10 flex justify-start">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 justify-items-center mb-20">
                                <!-- Game 1 (Pencocokan) -->
                                <div class="flex justify-center items-center">
                                    <div class="bg-white border border-l-4 border-b-4 border-gray-300 p-2 rounded-lg min-w-[15rem] shadow">
                                        <!-- container gambar -->
                                        <div class="flex justify-center">
                                            <img src="" class="bg-gray-200 w-full h-[12rem] rounded-lg border-0">
                                        </div>

                                        <!-- judul dan deskripsi -->
                                        <div class="mb-3 py-2">
                                            <h2 class="font-bold text-main text-lg capitalize">Gim Pencocokan</h2>
                                            <p class="font-normal text-xs capitalize">Edit Gim Pencocokan sesuka hati anda!</p>
                                        </div>

                                        <!-- tombol -->
                                        <a href="admin_gamepertama.php">
                                            <button class="mt-2 py-1 font-semibold text-sm w-full rounded-lg transition-all duration-150 bg-yellow-400 hover:bg-yellow-500 active:scale-95 text-white capitalize">
                                                edit
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- Game 2 (Puzzle) -->
                                <div class="flex justify-center items-center">
                                    <div class="bg-white border border-l-4 border-b-4 border-gray-300 p-2 rounded-lg min-w-[15rem] shadow">
                                        <!-- container gambar -->
                                        <div class="flex justify-center">
                                            <img src="" class="bg-gray-200 w-full h-[12rem] rounded-lg border-0">
                                        </div>

                                        <!-- judul dan deskripsi -->
                                        <div class="mb-3 py-2">
                                            <h2 class="font-bold text-main text-lg capitalize">Gim Puzzle</h2>
                                            <p class="font-normal text-xs capitalize">Edit Gim Puzzle sesuka hati anda!</p>
                                        </div>

                                        <!-- tombol -->
                                        <a href="admin_gamekedua.php">
                                            <button class="mt-2 py-1 font-semibold text-sm w-full rounded-lg transition-all duration-150 bg-yellow-400 hover:bg-yellow-500 active:scale-95 text-white capitalize">
                                                edit
                                            </button>
                                        </a>
                                    </div>
                                </div>

                                <!-- Game 3 (Studi Kasus) -->
                                <div class="flex justify-center items-center">
                                    <div class="bg-white border border-l-4 border-b-4 border-gray-300 p-2 rounded-lg min-w-[15rem] shadow">
                                        <!-- container gambar -->
                                        <div class="flex justify-center">
                                            <img src="" class="bg-gray-200 w-full h-[12rem] rounded-lg border-0">
                                        </div>

                                        <!-- judul dan deskripsi -->
                                        <div class="mb-3 py-2">
                                            <h2 class="font-bold text-main text-lg capitalize">Gim Studi Kasus</h2>
                                            <p class="font-normal text-xs capitalize">Edit Gim Studi Kasus sesuka hati anda!</p>
                                        </div>

                                        <!-- tombol -->
                                        <a href="admin_gameketiga.php">
                                            <button class="mt-2 py-1 font-semibold text-sm w-full rounded-lg transition-all duration-150 bg-yellow-400 hover:bg-yellow-500 active:scale-95 text-white capitalize">
                                                edit
                                            </button>
                                        </a>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer -->
            <?php
                include("../shared/footer.php") ;
                include("../modalPopUp/modalTambahGim.php");
                include("../modalPopUp/modalHapusGim.php");            
            ?>

        </div>
    </div>
    <!-- notif -->
    <script src="../script/notif.js"></script>
    <!-- js tema -->
    <script src="../script/tema.js"></script>
    <!-- js sidebar -->
    <script src="../script/sidebarGuru.js"></script>  
    <!-- CRUD JS -->
    <script src="../script/hapus.js"></script>
    <script src="../script/tambah.js"></script>
</body>
</html>