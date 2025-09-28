<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPAVERSE | Ulangan</title>
    <?php include("../shared/link.php") ?>
    <link rel="stylesheet" href="../shared/sidebarGuru.css">
    <link rel="stylesheet" href="../shared/tema.css">
</head>
<body class="relative bg-gray-50">
    <main class="min-h-screen">
        <!-- sidebar -->
        <?php include("../sidebar/sidebarUlangan.php") ?>
        <!-- konten -->
        <div id="content" class="flex-1 transition-all duration-300 p-5">
            <!-- header -->
            <header>
                <nav class="flex justify-between gap-5">
                    <div class="flex flex-col text-start">
                        <h1 class="text-lg md:text-3xl font-bold capitalize">Ulangan</h1>
                        <h1 class="text-md md:text-lg font-normal text-gray-400">september 13, sabtu</h1>                        
                    </div>
                    <?php include("../shared/headerGuru.php") ?>
                </nav>
            </header>
            <!-- isi konten -->
            <div class="flex flex-col gap-5 mt-4">
                <div class="flex justify-end">
                    <!-- btn tambah -->
                    <button class="border-l-4 border-b-4 border-green-500 hover:border-green-600 active:border-0  px-4 py-2 bg-green-400 hover:bg-green-500 rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md capitalize">
                        tambah
                    </button>  
                </div>
                <?php for ($i = 1; $i <= 7; $i++): ?>                        
                    <div class="bg-subtle border-1  border-main shadow-md p-4 rounded-xl flex flex-col md:flex-row justify-between items-center gap-5 transition-all duration-300 hover:shadow-lg hover:scale-[1.01] md:w-full">
                        <!-- judul -->
                        <div class="flex items-center gap-5 w-full md:w-auto">
                            <div class="bg-main rounded-lg w-14 h-14 flex items-center justify-center">
                                <span class="text-white font-bold text-2xl text-shadow-lg"><i
                                        class="fa fa-book"></i></span>
                            </div>
                            <h1 class="font-semibold text-lg">Bab <?= $i ?>: Pertumbuhan dan Perkembangan</h1>
                        </div>
                        <!-- btn edit & hapus -->
                        <div class="flex items-center gap-5 mt-3 md:mt-0">
                            <!-- edit -->
                            <button class="border-l-4 border-b-4 border-yellow-500 hover:border-yellow-600 active:border-0  px-4 py-2 bg-yellow-400 hover:bg-yellow-500 rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md capitalize">
                                edit
                            </button>
                            <!-- hapus -->
                            <button class="border-l-4 border-b-4 border-red-500 hover:border-red-600 active:border-0  px-4 py-2 bg-red-400 hover:bg-red-500 rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md capitalize">
                                hapus
                            </button>  
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
            <?php include("../shared/footer.php") ?>
        </div>
    </main>
    <!-- js header guru -->
    <script src="../script/headerGuru.js"></script>
    <!-- tema js -->
    <script src="../script/tema.js"></script>
     <!-- js sidebar guru -->
    <script src="../script/sidebarGuru.js"></script>
</body>
</html>