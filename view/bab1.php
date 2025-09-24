<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPAVERSE | BAB 1</title>
    <?php include("../shared/link.php"); ?>
    <script src="../script/sidebar.js"></script>
    <script src="https://www.youtube.com/iframe_api"></script>
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
            <div class="flex flex-row justify-center m-3 ml-8 md:m-10  gap-10">
                <!-- Content -->
                <div class="md:w-4/4 ml-7 mt-5 mb-5 text-start">
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
                    <div class="latihan"></div>
                    <?php include("../exercise/bab1_latihan.php"); ?>
                </div>
                
                <!-- Sidebar -->
                <?php include("../sidebar/sidebarBab1.php"); ?>

            </div>
        </div>
    </main>
    <?php include("../shared/footer.php"); ?>
    <script src="../script/latihan.js"></script>
</body>

</html>