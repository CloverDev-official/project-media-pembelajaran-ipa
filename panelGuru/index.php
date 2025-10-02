<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPAVERSE | Dasboard Guru</title>
    <?php include("../shared/link.php"); ?>
    <link rel="stylesheet" href="../shared/sidebarGuru.css">
    <link rel="stylesheet" href="../shared/tema.css">
</head>

<body class="relative bg-subtle">
    <main class="min-h-screen ">
        <!-- Sidebar -->
        <?php include("../sidebar/sidebarGuru.php") ?>
        <!-- Konten -->
        <div id="content" class="flex-1 transition-all duration-300 p-5">            
            <!-- header -->
            <header>
                <nav class="flex justify-between gap-5">
                    <!-- teks selamat datang -->
                    <div class="flex flex-col text-start ">
                        <h1 class="text-lg md:text-3xl font-bold capitalize">selamat datang, admin</h1>
                        <h1 class="text-md md:text-lg font-normal text-gray-400">september 13, sabtu</h1>
                    </div>
                    <?php include("../shared/headerGuru.php") ?>
                </nav>
            </header>
            <!-- isi konten -->
            <section class="min-h-screen">
                <!-- container profil guru -->
                <div class="flex flex-col md:flex-row gap-5 mt-5">
                    <div class="w-12/12 lg:w-8/12">
                        <div class="bg-main p-4 py-6 rounded-md">
                            <h1 class="font-bold text-4xl text-center text-white capitalize">ini panel guru</h1>
                        </div>
                    </div>
                    <!-- profil guru -->
                    <div class="w-12/12 lg:w-3/12">
                        <div class="flex flex-row gap-5">
                            <!-- foto profil guru -->
                            <img src="../img/beruang.jpg" alt="profil admin" class=" border rounded-2xl w-[10rem] md:w-[6rem]">

                            <!-- data profil  guru -->
                            <div class=" flex flex-col gap-2">
                                <div>
                                    <h1 class="font-bold text-lg capitalize">admin</h1>
                                    <h1 class="font-normal text-sm text-gray-400 uppercase">nip : 12345678910</h1>
                                    <h1 class="font-normal text-sm text-gray-400 uppercase">smpn11 bjm</h1>
                                </div>
                                <div class="bg-main text-md text-white rounded-lg capitalize font-semibold text-center">guru</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- container isi konten -->
                <div class="flex flex-col lg:flex-row gap-4 mt-5">
                    <!-- grafik nilai rata rata kelas -->
                    <div class="bg-white p-4 rounded-lg shadow-md ">
                        <h1 class="font-bold capitalize text-lg"><i class="bi bi-bar-chart-fill"></i> ringkasan performa kelas</h1>
                        <p class="text-normal text-sm text-gray-400">Nilai rata-rata IPA per kelas</p>
                        <div class="bg-white p-4">
                            <!-- container diagran rata rata -->
                            <div class="mb-5">
                                <!-- diagram batang untuk rata rata nilai siswa -->
                                <canvas id="nilaiChart" class="w-50 h-100"></canvas>                                    
                            </div>
                            <!-- container detail performa -->
                            <div class="mt-5">
                                <h1 class="text-lg font-semibold capitalize mb-3">detail performa</h1>
                                <!-- container card rata-rata -->
                                <div class="grid grid-cols-1 gap-5">
                                    <!-- card -->
                                    <div class="border border-gray-400 bg-gray-50 p-2 px-4 rounded-lg">
                                        <div class="grid grid-cols-1 gap-4">
                                            <!-- header card -->
                                            <div class="flex justify-between">
                                                <div class="flex gap-3 items-center">
                                                    <div class="border border-[#4BC0C0] bg-[#4BC0C0] rounded lg p-2"></div>
                                                    <h1 class="font-nolmal text-sm uppercase">9a</h1>
                                                </div>
                                                <h1 class="font-bold text-sm">79.6</h1>
                                            </div>
                                            <!-- body card -->
                                            <div class="grid grid-cols-1 gap-1">
                                                <!-- container Progress bar -->
                                                <div class="w-full bg-gray-300 rounded-full h-2">
                                                    <!-- Progress Bar -->
                                                    <div class="bg-main h-2 rounded-full text-center text-xs font-bold text-white" style="width: 75%;"></div>
                                                </div>
                                                <p class="ml-1 text-xs text-gray-600 font-normal capitalize">persentase : 75%</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- card -->
                                    <div class="border border-gray-400 bg-gray-50 p-2 px-4 rounded-lg">
                                        <div class="grid grid-cols-1 gap-4">
                                            <!-- header card -->
                                            <div class="flex justify-between">
                                                <div class="flex gap-3 items-center">
                                                    <div class="border border-[#4BC0C0] bg-[#4BC0C0] rounded lg p-2"></div>
                                                    <h1 class="font-nolmal text-sm uppercase">9b</h1>
                                                </div>
                                                <h1 class="font-bold text-sm">88.8</h1>
                                            </div>
                                            <!-- body card -->
                                            <div class="grid grid-cols-1 gap-1">
                                                <!-- container Progress bar -->
                                                <div class="w-full bg-gray-300 rounded-full h-2">
                                                    <!-- Progress Bar -->
                                                    <div class="bg-main h-2 rounded-full text-center text-xs font-bold text-white" style="width: 88.8%;"></div>
                                                </div>
                                                <p class="ml-1 text-xs text-gray-600 font-normal capitalize">persentase : 88%</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- data siswa -->
                    <div class="grid lg:grid-rows-2 gap-4">
                        <!-- wrapper table siswa -->
                        <div class="bg-white p-4 rounded-lg shadow-md">
                            <!-- header tabel siswa -->
                            <div class="flex justify-between mb-10 mt-2">
                                <!-- judul -->
                                <h1 class="font-bold text-3xl capitalize">
                                    <i class="bi bi-mortarboard-fill"></i>
                                    tabel siswa
                                </h1>
                                <!-- button -->
                                <a href="../panelGuru/dataSiswa.php">
                                    <button class="border-l-4 border-b-4 border-main-dark  px-4 py-2 bg-main rounded-lg text-white text-shadow-md font-semibold text-sm transition-all duration-100 shadow-md capitalize hover:scale-105 active:scale-95">
                                        lihat semua
                                    </button>
                                </a>
                            </div>
                            <!-- container tabel siswa -->
                            <div class="grid  lg:grid-cols-2  gap-4">
                                <!-- tabel siswa -->
                                <div class=" bg-gray-100 p-4 rounded-md">
                                    <h1 class="my-4 font-semibold text-lg">Kelas 9A</h1>
                                    <div class="rounded-lg border overflow-hidden shadow-lg">
                                        <table class="table-auto  w-full">
                                            <!-- table head -->
                                            <thead>
                                                <tr class="bg-main-light text-center">
                                                    <th class="border-r border-black px-4 py-2  capitalize">no</th>
                                                    <th class="border-r border-black px-4 py-2  capitalize">nama siswa</th>
                                                    <th class=" px-4 py-2  capitalize">kelas</th>
                                                </tr>
                                            </thead>
                                            <!-- table body -->
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
                                <!-- tabel siswa -->
                                <div class="bg-gray-100 p-4 rounded-md">
                                    <h1 class="my-4 font-semibold text-lg">Kelas 9B</h1>
                                    <div class="rounded-lg border overflow-hidden shadow-lg">
                                        <table class="table-auto  w-full">
                                            <!-- table head -->
                                            <thead>
                                                <tr class="bg-main-light text-center">
                                                    <th class="border-r border-black px-4 py-2 capitalize">no</th>
                                                    <th class="border-r border-black px-4 py-2 capitalize">nama siswa</th>
                                                    <th class=" px-4 py-2 capitalize">kelas</th>
                                                </tr>
                                            </thead>
                                            <!-- table body -->
                                            <tbody class="text-center">
                                                <tr class="bg-white hover:bg-gray-200">
                                                    <td class="border-t border-r px-4 py-2">1</td>
                                                    <td class="border-t border-r px-4 py-2 capitalize">ghaizan</td>
                                                    <td class="border-t  px-4 py-2 uppercase">9B</td>
                                                </tr>
                                                <tr class="bg-white hover:bg-gray-200">
                                                    <td class="border-t border-r px-4 py-2">2</td>
                                                    <td class="border-t border-r px-4 py-2 capitalize">ghaizan</td>
                                                    <td class="border-t  px-4 py-2 uppercase">9B</td>
                                                </tr>
                                                <tr class="bg-white hover:bg-gray-200">
                                                    <td class="border-t border-r px-4 py-2">3</td>
                                                    <td class="border-t border-r px-4 py-2 capitalize">ghaizan</td>
                                                    <td class="border-t  px-4 py-2 uppercase">9B</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- wrapper rekap nilai -->
                        <div class="hidden lg:block  bg-white p-4 rounded-md shadow-md">
                            <div class="flex justify-between mb-10 mt-2">
                                <h1 class="font-bold text-3xl capitalize">
                                    <i class="bi bi-file-earmark-richtext-fill"></i>
                                    rekap nilai
                                </h1>
                                <div class="flex justify-between gap-5">
                                    <a href="">
                                        <button class="border-l-4 border-b-4 border-green-700 px-4 py-2 bg-green-600 hover:scale-105 rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md capitalize text-sm active:scale-95">
                                            <i class="fa-solid fa-file-excel"></i> excel
                                        </button>
                                    </a>
                                    <a href="../panelGuru/rekapNilai.php">
                                        <button class="border-l-4 border-b-4 border-main-dark  px-4 py-2 bg-main rounded-lg text-white text-shadow-md font-semibold text-sm transition-all duration-100 shadow-md capitalize hover:scale-105 active:scale-95">
                                            lihat semua
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <h1 class="my-4 font-semibold text-lg">Kelas 9B</h1>
                            <div class=" rounded-lg border overflow-hidden shadow-lg">
                                <!-- wrapper scroll horizontal -->
                                <div class="overflow-x-auto">
                                    <table class="table-fixed lg:w-full">
                                        <thead>
                                            <tr class="bg-main-light text-center">
                                                <th class="border-r border-black px-4 py-2 font-normal  capitalize">no.</th>
                                                <th class="border-r border-black px-4 py-2 font-normal  capitalize">nama siswa</th>
                                                <th class="border-r border-black px-4 py-2 font-normal  capitalize">bab 1</th>
                                                <th class="border-r border-black px-4 py-2 font-normal  capitalize">bab 2</th>
                                                <th class="border-r border-black px-4 py-2 font-normal  capitalize">bab 3</th>
                                                <th class="border-r border-black px-4 py-2 font-normal  capitalize">ulangan</th>
                                                <th class="px-4 py-2 font-normal  capitalize">rata - rata</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <tr class="bg-white hover:bg-gray-200">
                                                <td class="border-t border-r px-4 py-2">1</td>
                                                <td class="border-t border-r px-4 py-2 capitalize">muhammad ghaizan </td>
                                                <td class="border-t border-r  px-4 py-2">90</td>
                                                <td class="border-t border-r  px-4 py-2">90</td>
                                                <td class="border-t border-r  px-4 py-2">90</td>
                                                <td class="border-t border-r  px-4 py-2">90</td>
                                                <td class="border-t  px-4 py-2">90</td>
                                            </tr>
                                            <tr class="bg-white hover:bg-gray-200">
                                                <td class="border-t border-r px-4 py-2">2</td>
                                                <td class="border-t border-r px-4 py-2 capitalize">ghaizan</td>
                                                <td class="border-t border-r  px-4 py-2">90</td>
                                                <td class="border-t border-r  px-4 py-2">90</td>
                                                <td class="border-t border-r  px-4 py-2">90</td>
                                                <td class="border-t border-r  px-4 py-2">90</td>
                                                <td class="border-t  px-4 py-2">90</td>
                                            </tr>
                                            <tr class="bg-white hover:bg-gray-200">
                                                <td class="border-t border-r px-4 py-2">3</td>
                                                <td class="border-t border-r px-4 py-2 capitalize">ghaizan</td>
                                                <td class="border-t border-r  px-4 py-2">90</td>
                                                <td class="border-t border-r  px-4 py-2">90</td>
                                                <td class="border-t border-r  px-4 py-2">90</td>
                                                <td class="border-t border-r  px-4 py-2">90</td>
                                                <td class="border-t  px-4 py-2">90</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php include("../shared/footer.php"); ?>
        </div>
    </main>
    <!-- js header -->
    <script src="../script/headerGuru.js"></script>
    <!-- tema js -->
    <script src="../script/tema.js"></script>    
    <!-- js sidebar guru -->
    <script src="../script/sidebarGuru.js"></script>
    <!-- js chart dasboard guru  -->
    <script src="../script/dasboardGuru.js"></script>
</body>
</html>