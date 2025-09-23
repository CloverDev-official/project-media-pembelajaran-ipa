<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IPAVERSE | BAB 1</title>
    <?php include("../shared/link.php"); ?>
    <link rel="stylesheet" href="../shared/vidInteraktif.css">
    <script src="../script/sidebar.js"></script>
    <script src="https://www.youtube.com/iframe_api"></script>
</head>

<body class="relative">
    <?php include("../shared/header.php"); ?>

    <main class="min-h-screen">
        <!-- Hero Section -->
        <section class="bg-[url(../img/section.png)] bg-no-repeat bg-cover hero">
            <div class="flex items-center h-[90vh]">
                <div class="p-10 text-white">
                    <h1 class="font-bold text-5xl md:text-7xl">BAB 1</h1>
                    <p class="font-bold text-3xl md:text-4xl">Pertumbuhan dan perkembangan</p>
                </div>
            </div>
        </section>

        <!-- Content + Sidebar -->
        <div>
            <div class="flex flex-row justify-center m-3 ml-8 md:m-10 gap-10">

                <!-- Content -->
                <div class="md:w-4/4 m-5 text-start">
                    <ul class="list-decimal font-bold text-2xl" id="pengertian">
                        <li>Pengertian Pertumbuhan dan Perkembangan</li>
                    </ul>

                    <div class="mx-4 mt-10 mb-5">
                        <ul class="list-disc">
                            <li>
                                <strong>Pertumbuhan</strong> adalah proses perubahan tubuh yang ditandai dengan
                                bertambahnya ukuran fisik, seperti tinggi badan, berat badan, dan bentuk tubuh.
                                Misalnya, saat bayi tinggi badan belum sampai 1 meter, tetapi ketika remaja tubuh
                                menjadi lebih tinggi dan besar.
                            </li>
                        </ul>
                    </div>

                    <img src="../img/pesawat-terbang.png" alt="" />

                    <div class="mx-4 mt-10 mb-5">
                        <ul class="list-disc">
                            <li>
                                <strong>Perkembangan</strong> adalah proses perubahan menuju kedewasaan, baik dalam hal
                                fisik maupun perilaku. Contohnya, suara mulai berubah, muncul jerawat, serta sikap dan
                                perilaku yang ikut berubah.
                            </li>
                        </ul>
                    </div>

                    <p>
                        Jadi, pertumbuhan lebih menekankan pada perubahan kuantitatif (ukuran, jumlah, tinggi, berat),
                        sedangkan perkembangan lebih pada perubahan kualitatif (fungsi, kemampuan, kedewasaan fisik dan
                        mental).
                    </p>

                    <!-- Card Kata Kunci -->
                    <div class="flex flex-col md:flex-row justify-start gap-10 mt-7">
                        <div class="bg-green-200 border-l-4 border-b-4 border-green-500 p-2 rounded-md w-full md:w-1/2">
                            <h2 class="text-lg font-semibold"><i class="fa fa-key text-yellow-300"></i> Kata Kunci Pertumbuhan:</h2>
                            <ul class="list-disc ml-5 mt-3">
                                <li>Bertambah tinggi</li>
                                <li>Bertambah besar</li>
                                <li>Ukuran tubuh</li>
                                <li>Dari bayi &lt; 1 m → remaja lebih tinggi</li>
                            </ul>
                        </div>

                        <div class="bg-green-200 border-l-4 border-b-4 border-green-500 p-2 rounded-md w-full md:w-1/2">
                            <h2 class="text-lg font-semibold"><i class="fa fa-key text-yellow-300"></i> Kata Kunci Perkembangan:</h2>
                            <ul class="list-disc ml-5 mt-3">
                                <li>Suara berubah</li>
                                <li>Muncul jerawat</li>
                                <li>Perilaku berubah</li>
                                <li>Menuju kedewasaan</li>
                            </ul>
                        </div>
                    </div>

                                        <!-- Container Video -->
                    <div class="flex justify-center items-center my-10">
                    <div id="video-container" class="relative w-full max-w-[640px]">
                        
                        <!-- Responsive wrapper untuk player -->
                        <div class="relative pb-[56.25%] h-0"> <!-- 16:9 ratio -->
                        <!-- Player -->
                        <div id="player" class="w-full max-w-2xl aspect-video bg-black"></div>
                        </div>

                        <!-- Overlay Soal -->
                        <div id="soal"
                        class="hidden absolute inset-0 bg-[rgba(0,0,0,0.8)] z-10 flex flex-col items-center justify-center text-center p-6">
                        <p id="pertanyaan" class="text-xl font-semibold text-white mb-6"></p>
                        <div id="opsi" class="flex flex-col gap-3 w-full max-w-sm"></div>
                        </div>
                    </div>
                    </div>

                    <!-- Progress bar preview -->
                    <div class="w-full max-w-[640px] mx-auto mt-3 relative">
                    <div id="progress-container" class="w-full bg-gray-700 h-3 rounded-lg cursor-pointer relative">
                        <div id="watched-bar" class="absolute top-0 left-0 h-3 rounded-lg"
                        style="background:rgba(59,130,246,0.45); width:0%"></div>
                        <div id="progress-bar" class="absolute top-0 left-0 h-3 rounded-lg"
                        style="background:rgb(59,130,246); width:0%"></div>
                        <div id="progress-tooltip"
                        class="absolute -top-8 text-sm bg-black text-white px-2 py-1 rounded opacity-0 pointer-events-none transition-opacity duration-150">0:00</div>
                    </div>
                    </div>

                    <!-- Custom controls -->
                    <div class="flex justify-center gap-4 mt-4">
                    <!-- btnPlay -->
                    <button id="btnPlay"
                        class="border bg-gradient-to-t from-green-600 to-green-500 border-b-4 border-green-700 py-1 px-3 rounded-xl shadow text-lg text-white font-bold transition-transform duration-150 hover:scale-105 active:border-b-0">
                        ▶ Play
                    </button>

                    <!-- btnPause -->
                    <button id="btnPause"
                        class="border bg-gradient-to-t from-red-600 to-red-500 border-b-4 border-red-700 py-1 px-3 rounded-xl shadow text-lg text-white font-bold transition-transform duration-150 hover:scale-105 active:border-b-0">
                        ⏸ Pause
                    </button>

                    <!-- btnRestart -->
                    <button id="btnRestart"
                        class="border bg-gradient-to-t from-yellow-600 to-yellow-500 border-b-4 border-yellow-700 py-1 px-3 rounded-xl shadow text-lg text-white font-bold transition-transform duration-150 hover:scale-105 active:border-b-0">
                        🔄 Ulang
                    </button>
                    </div>



                    <!-- Sub Bab -->
                    <h2 class="text-xl font-semibold mt-10" id="subBabPertama">A. Pertumbuhan dan Perkembangan pada Manusia</h2>
                    <ul class="list-disc mt-5 ml-10 mb-5">
                        <li>
                            <strong>Pertumbuhan</strong> adalah proses perubahan tubuh yang ditandai dengan bertambahnya
                            ukuran fisik, seperti tinggi badan, berat badan, dan bentuk tubuh. Misalnya, saat bayi
                            tinggi badan belum sampai 1 meter, tetapi ketika remaja tubuh menjadi lebih tinggi dan
                            besar.
                        </li>
                    </ul>

                    <img src="../img/pesawat-terbang.png" alt="" />

                    <ul class="list-disc mt-5 ml-10 mb-5">
                        <li>
                            <strong>Perkembangan</strong> adalah proses perubahan menuju kedewasaan, baik dalam hal
                            fisik maupun perilaku. Contohnya, suara mulai berubah, muncul jerawat, serta sikap dan
                            perilaku yang ikut berubah.
                        </li>
                    </ul>

                    <p>
                        Jadi, pertumbuhan lebih menekankan pada perubahan kuantitatif (ukuran, jumlah, tinggi, berat),
                        sedangkan perkembangan lebih pada perubahan kualitatif (fungsi, kemampuan, kedewasaan fisik dan
                        mental).
                    </p>

                    <!-- latihan -->
                    <div class="latihan"></div>
                    <?php include("../exercise/bab1_latihan.php"); ?>
                </div>

                <!-- Sidebar -->
                <?php include("../sidebar/sidebarBab1.php"); ?>
            </div>
        </div>
    </main>

    <?php include("../shared/footer.php"); ?>
    <script src="../script/latihan.js" defer></script>
    <script src="https://www.youtube.com/iframe_api"></script>
    <script src="../script/vidInteraktif.js" defer></script>
</body>

</html>
