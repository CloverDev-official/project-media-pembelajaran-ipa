<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPAVERSE | BAB 1</title>
    <?php include("../shared/link.php"); ?>
</head>
<style>
    ::-webkit-scrollbar {
        display: none;
    }
</style>

<body class="relative">
    <?php include("../shared/header.php"); ?>
    <main class="min-h-screen">
        <!-- Hero Section -->
        <div class="bg-[url(../img/section.png)] bg-no-repeat bg-cover hero">
            <div class="flex justify-start items-center h-[90vh]">
                <div class="p-10 text-white">
                    <h1 class="font-bold text-5xl md:text-7xl">BAB 1</h1>
                    <p class="font-bold text-3xl md:text-4xl">Pertumbuhan dan perkembangan</p>
                </div>
            </div>
        </div>

        <!-- Content + Sidebar -->
        <div>
            <div class="flex flex-row justify-center m-3 md:m-10  gap-10">

                <!-- Content -->
                <div class="md:w-4/4 m-5 text-start">
                    <ul class="list-decimal font-bold text-2xl" id="pengertian">
                        <li>Pengertian Pertumbuhan dan Perkembangan </li>
                    </ul>
                    <div class="mx-4 mt-10 mb-5">
                        <ul class="list-disc">
                            <li>
                                <strong>Pertumbuhan</strong>
                                adalah proses perubahan tubuh yang ditandai dengan
                                bertambahnya ukuran fisik, seperti tinggi badan, berat badan, dan bentuk tubuh.
                                Misalnya, saat bayi tinggi badan belum sampai 1 meter, tetapi ketika remaja tubuh
                                menjadi lebih tinggi dan besar.
                            </li>
                        </ul>
                    </div>
                    <img src="../img/pesawat-terbang.png" alt="">
                    <div class="mx-4 mt-10 mb-5" id="">
                        <ul class="list-disc">
                            <li>
                                <strong>Perkembangan</strong>
                                adalah proses perubahan menuju kedewasaan, baik dalam hal
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
                            <h1 class="text-lg font-semibold"><i class="fa fa-key text-yellow-300"></i>
                                Kata Kunci Pertumbuhan:</h1>
                            <ul class="list-disc ml-5 mt-3">
                                <li>Bertambah tinggi</li>
                                <li>Bertambah besar</li>
                                <li>Ukuran tubuh</li>
                                <li>Dari bayi < 1 m → remaja lebih tinggi</li>
                            </ul>
                        </div>
                        <div class="bg-green-200 border-l-4 border-b-4 border-green-500 p-2 rounded-md w-full md:w-1/2">
                            <h1 class="text-lg font-semibold"><i class="fa fa-key text-yellow-300"></i>
                                Kata Kunci Perkembangan:</h1>
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
                            <div id="video-container" class="relative w-[640px] h-[360px]">
                            <!-- Player YouTube -->
                            <div id="player" class="w-[640px] h-[360px] bg-black"></div>

                            <!-- Overlay Soal -->
                            <div id="soal" class="hidden absolute inset-0 bg-black/80 flex flex-col items-center justify-center text-center p-6">
                                <p id="pertanyaan" class="text-xl font-semibold text-white mb-6"></p>
                                <div id="opsi" class="flex flex-col gap-3 w-full max-w-s    m"></div>
                            </div>
                            </div>
                        </div>
                    <!-- Sub Bab -->
                    <h1 class="text-xl font-semibold mt-10" id="subBabPertama">A. Pertumbuhan dan Perkembangan pada Manusia </h1>
                    <ul class="list-disc mt-5 ml-10 mb-5">
                        <li>
                            <strong>Pertumbuhan</strong>
                            adalah proses perubahan tubuh yang ditandai dengan bertambahnya
                            ukuran fisik, seperti tinggi badan, berat badan, dan bentuk tubuh. Misalnya, saat bayi
                            tinggi badan belum sampai 1 meter, tetapi ketika remaja tubuh menjadi lebih tinggi dan
                            besar.
                        </li>
                    </ul>
                    <img src="../img/pesawat-terbang.png" alt="">
                    <ul class="list-disc mt-5 ml-10 mb-5">
                        <li>
                            <strong>Perkembangan</strong>
                            adalah proses perubahan menuju kedewasaan, baik dalam hal
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
                    <?php include("../exercise/bab1_latihan.php"); ?>
                </div>
                
                <!-- Sidebar -->
                <?php include("../sidebar/sidebarBab1.php"); ?>

            </div>
        </div>
    </main>
    <?php include("../shared/footer.php"); ?>
    <?php include("../script/vidInteraktif.php"); ?>
    <?php include("../script/sidebar.php"); ?>
    <?php include("../script/latihan.php"); ?>
</body>

</html>