<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPAVERSE | Materi Edit</title>
    <?php include("../shared/link.php"); ?>
    <link rel="stylesheet" href="../shared/sidebarGuru.css">
    <link rel="stylesheet" href="../shared/tema.css">
</head>

<body class="bg-subtle">
    <!-- sidebar -->
    <?php include("../sidebar/sidebarEditMateri.php") ?>
    <main class="min-h-screen">
        <!-- konten -->
        <div id="content" class="flex-1 transition-all duration-300 p-5">
            <!-- header -->
            <header>
                <nav class="flex justify-between gap-5">
                    <div class="flex flex-col text-start">
                        <h1 class="text-lg md:text-3xl font-bold capitalize">Materi</h1>
                        <h1 class="text-md md:text-lg font-normal text-gray-400">september 13, sabtu</h1>
                    </div>
                    <?php include("../shared/headerGuru.php") ?>
                </nav>
            </header>
            <!-- isi konten -->
            <div class="mt-5">
                <!-- hero section -->
                <div class="h-[50vh] bg-main flex justify-between items-center">
                    <div class="flex flex-col capitalize text-white m-5">
                        <h1 class="text-5xl font-bold text-shadow-2xs">bab1</h1>
                        <p class="font-normal text-shadow-2xs">Pertumbuhan dan Perkembangan</p>
                    </div>
                </div>
                <form action="#" method="post" class="mt-5">
                    <!-- Sub Bab -->
                    <h1 class="font-bold capitalize">sub bab :</h1>
                    <input type="text" name="subBab" id="subBab" class="bg-white shadow w-full border border-main rounded-md p-2 mt-2 mb-5 focus:outline-none focus:ring-1 ring-main" placeholder="contoh : 1.Pengertian Pertumbuhan dan Perkembangan">
                    <h1 class="font-bold capitalize mb-2">teks :</h1>
                    <!-- Tombol Import Word -->
                    <button type="button" id="importWord" 
                        class="mt-5 mb-2 border-l-4 border-b-4 border-blue-600 px-4 py-2 bg-blue-500 hover:scale-[01.1] active:scale-95 rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md capitalize">  
                        <i class="bi bi-file-earmark-word-fill"></i>
                        Word
                    </button>
                    <input type="file" id="uploadWord" accept=".docx" style="display:none">
                    <!-- teks -->
                    <textarea name="teks" id="teks" cols="30" rows="10" class="bg-white shadow w-full border border-main rounded-md p-2 mt-2 mb-5 focus:outline-none focus:ring-1 ring-main" placeholder="Masukkan teks materi disini..."></textarea>
                    <!-- vid interakitf -->
                    <button type="button" id="importVid"  class="mt-5 mb-2 mr-4 border-l-4 border-b-4 border-red-600 px-4 py-2 bg-red-500 hover:scale-[01.1] active:scale-95 rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md capitalize">  
                        <i class="bi bi-file-earmark-play-fill"></i>
                        vid interaktif
                    </button>
                    <?php include("../modalPopUp/modalImportVid.php") ?>
                    <!-- Preview Video -->
                    <div id="preview" class="mt-4 hidden relative w-full">
                        <!-- Tombol Hapus -->
                        <button type="button" id="removeVideo" 
                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center shadow hover:bg-red-600 z-10">
                            &times;
                        </button>
                        <video controls class="w-full rounded-lg shadow z-0"></video>
                    </div>
                    
                    <!-- btn simpan -->
                    <button type="submit"
                        class="mt-5 border-l-4 border-b-4 border-main-dark px-4 py-2 bg-main hover:scale-[01.1] active:scale-95  rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md capitalize">
                        simpan
                    </button>

                </form>
            </div>
            <!-- footer -->
            <?php include("../shared/footer.php") ?>
        </div>
    </main>
    <!-- tinyMCE -->
    <script src="../script/tinyMCE.js"></script>
    <!-- mammoth js -->
    <script src="../script/mammoth.js"></script>
    <!-- import vid interakitf -->
    <script src="../script/importVid.js"></script>
    <!-- header -->
    <script src="../script/headerGuru.js"></script>
    <!-- js sidebar -->
    <script src="../script/sidebarGuru.js"></script>
    <!-- js tema -->
    <script src="../script/tema.js"></script>
</body>

</html>