<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <?php include("../shared/link.php"); ?>
</head>

<body>
    <?php include("../shared/header.php"); ?>
    <main class="min-hscreen bg-subtle">

        <div class="p-4 mx-0 md:mx-16">
            <!-- btn kembali
            <button onclick="window.history.back()"
                class="p-2 mb-10 mt-5 rounded-xl border bg-linear-to-t from-green-600 to-green-500 border-b-4 border-green-700 text-white font-semibold text-shadow-2xs shadow-sm transition-all duration-150 hover:scale-110 active:scale-95 active:shadow-inner"><i
                    class="bi bi-arrow-left"></i> Kembali</button> -->
            <!-- profil siswa -->
            <div class="bg-white min-h-[50vh]  rounded-xl shadow-md p-5 mb-10 mt-10">
                <div class="rounded-xl flex justify-start items-center gap-5 p-5">
                    <div class="bg-gray-200 flex justify-center p-1  rounded-xl">
                        <img src="../img/person-fill.svg" alt="" class="w-[2rem] h-[2rem] rounded-xl">
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-main capitalize">profil siswa</h1>
                        <p class="text-xs">Informasi lengkap profil siswa dan rekalert-primary nilai pelajaran ipa.</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 m-5">
                    <div class="bg-main p-3 px-5 md:p-5  rounded-xl">
                        <h1 class="text-sm font-bold capitalize"><i class="bi bi-person-fill"></i> nama siswa</h1>
                        <h1 class="text-xl md:text-3xl capitalize font-bold text-white mt-2 md:mt-5">admin123</h1>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 m-5 gap-5">
                    <div class="bg-main p-3 px-5 md:p-5 rounded-xl">
                        <h1 class="text-sm font-bold capitalize"><i class="bi bi-mortarboard-fill"></i> kelas</h1>
                        <h1 class="text-xl md:text-3xl text-white font-bold uppercase mt-2 md:mt-5"></i> xi pplg a</h1>
                    </div>
                    <div class="bg-main p-3 px-5 md:p-5 rounded-xl">
                        <h1 class="text-sm font-bold capitalize"><i class="bi bi-mortarboard-fill"></i> sekolah</h1>
                        <h1 class="text-xl md:text-3xl text-white font-bold uppercase mt-2 md:mt-5"> smkn 2 </h1>
                    </div>
                </div>
            </div>

            <!-- rekap nilai ipa -->
            <div class="bg-white min-h-[50vh]  rounded-xl shadow-md p-5 mb-10">
                <div class="flex justify-start items-center gap-5 p-5">
                    <div class="bg-gray-200 flex justify-center p-1  rounded-xl">
                        <img src="../img/bar-chart-line-fill.svg" alt="" class="w-[2rem] h-[2rem] rounded-xl">
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-main capitalize">rekap nilai IPA</h1>
                        <p class="text-xs">Pantau terus pencapaian nilai per bab dalam pelajaran IPA!</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 m-5">
                    <div class="bg-main p-3 px-5 md:p-5  rounded-xl">
                        <h1 class="text-sm font-bold capitalize"><i class="bi bi-caret-up-fill"></i> nilai tertinggi
                        </h1>
                        <h1 class="text-xl md:text-3xl capitalize font-bold text-white mt-2 md:mt-5">100</h1>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 m-5 gap-5">
                    <div class="bg-main p-3 px-5 md:p-5 rounded-xl">
                        <h1 class="text-sm font-bold capitalize"><i class="bi bi-caret-down-fill"></i> nilai terendah
                        </h1>
                        <h1 class="text-xl md:text-3xl text-white font-bold uppercase mt-2 md:mt-5"></i> 56</h1>
                    </div>
                    <div class="bg-main p-3 px-5 md:p-5 rounded-xl">
                        <h1 class="text-sm font-bold capitalize"><i class="bi bi-plus-lg"></i> nilai rata-rata</h1>
                        <h1 class="text-xl md:text-3xl text-white font-bold uppercase mt-2 md:mt-5"> 85 </h1>
                    </div>
                </div>
            </div>
            <!-- grafik nilai per bab -->
            <div class="bg-white min-h-[50vh]  rounded-xl shadow-md p-5">
                <div class="flex justify-start items-center gap-5 p-5">
                    <div class="bg-gray-200 flex justify-center p-1  rounded-xl">
                        <img src="../img/bar-chart-line-fill.svg" alt="" class="w-[2rem] h-[2rem] rounded-xl">
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-main capitalize">grafik nilai per-bab</h1>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class=" w-full max-w-screen">
                        <div class="bg-white mt-10 border  border-gray-300 rounded-md p-4">
                            <!-- atur ukuran manual -->
                            <canvas id="nilaiChart" width="100" height="350"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- footer -->
    <?php include("../shared/footer.php"); ?>
    <!-- header js -->
    <script src="../script/header.js"></script>
    <!-- tema js -->
    <script src="../script/tema.js"></script>    
    <!-- chart js -->
    <script src="../script/profilChart.js"></script>    

</body>

</html>