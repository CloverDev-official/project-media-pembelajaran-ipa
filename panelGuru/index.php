    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>IPAVERSE | Dasboard Guru</title>
        <?php include("../shared/link.php"); ?>
        <?php include("../shared/sidebarGuru_css.php"); ?>
    </head>
    

    <body class="relative bg-gray-50">
        <main class="min-h-screen ">
            <!-- Sidebar -->
            <?php include("../sidebar/sidebarGuru.php") ?>

            <!-- Konten -->
            <div id="content" class="flex-1 transition-all duration-300 p-5">            
                <!-- header -->
                <header class="">
                    <nav class="flex justify-between gap-5">
                        <!-- teks selamat datang -->
                        <div class="flex flex-col text-start ">
                            <h1 class="text-lg md:text-3xl font-bold capitalize">selamat datang, admin</h1>
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
                <!-- isi konten -->
                <section class="min-h-screen">
                    <!-- container profil guru -->
                    <div class="flex flex-col md:flex-row gap-5 mt-5">
                        <div class="w-12/12 lg:w-8/12">
                            <div class="bg-green-500 p-4 py-6 rounded-md">
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
                                    <div class="bg-green-500 text-md  rounded-lg capitalize font-semibold text-center">guru</div>
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
                                <!-- diagram batang untuk rata rata nilai siswa -->
                                <canvas id="nilaiChart" class="w-40 h-100"></canvas>
                            </div>
                        </div>
                        <!-- data siswa -->
                        <div class="grid lg:grid-rows-2 gap-4">
                            <!-- container data siswa -->
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <div class="flex justify-between mb-10 mt-2">
                                    <h1 class="font-bold text-3xl capitalize">
                                        <i class="bi bi-mortarboard-fill"></i>
                                        tabel siswa
                                    </h1>
                                    <a href="../panelAdmin/.php">
                                        <button class="p-2 rounded-lg border bg-green-300 font-normal capitalize text-green-900 transition-all duration-150 hover:scale-105 active:scale-95">
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
                                                <thead>
                                                    <tr class="bg-green-300 text-center">
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
                                    <!-- tabel siswa -->
                                    <div class="bg-gray-100 p-4 rounded-md">
                                        <h1 class="my-4 font-semibold text-lg">Kelas 9B</h1>
                                        <div class="rounded-lg border overflow-hidden shadow-lg">
                                            <table class="table-auto  w-full">
                                                <thead>
                                                    <tr class="bg-green-300 text-center">
                                                        <th class="border-r border-black px-4 py-2 capitalize">no</th>
                                                        <th class="border-r border-black px-4 py-2 capitalize">nama siswa
                                                        </th>
                                                        <th class=" px-4 py-2 capitalize">kelas</th>
                                                    </tr>
                                                </thead>
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
                            <!-- container rekap nilai -->
                            <div class="hidden lg:block  bg-white p-4 rounded-md shadow-md">
                                <div class="flex justify-between mb-10 mt-2">
                                    <h1 class="font-bold text-3xl capitalize">
                                        <i class="bi bi-file-earmark-richtext-fill"></i>
                                        rekap nilai
                                    </h1>
                                    <div class="flex justify-between gap-5">
                                        <a href="">
                                            <button class="p-2 rounded-lg border bg-green-800 font-normal capitalize text-white transition-all duration-150 hover:scale-105 active:scale-95">
                                                <i class="fa-solid fa-file-excel"></i> excel
                                            </button>
                                        </a>
                                        <a href="">
                                            <button class="p-2 rounded-lg border bg-green-300 font-normal capitalize text-green-900 transition-all duration-150 hover:scale-105 active:scale-95">lihat
                                                semua
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <h1 class="my-4 font-semibold text-lg">Kelas 9B</h1>
                                <div class=" rounded-lg border overflow-hidden shadow-lg">
                                    <table class="table-auto   lg:w-full">
                                        <thead>
                                            <tr class="bg-green-300 text-center">
                                                <th class="border-r border-black px-4 py-2 font-normal  capitalize">no.</th>
                                                <th class="border-r border-black px-4 py-2 font-normal  capitalize">nama siswa</th>
                                                <th class="border-r border-black px-4 py-2 font-normal  capitalize">bab 1</th>
                                                <th class="border-r border-black px-4 py-2 font-normal  capitalize">bab 2</th>
                                                <th class="border-r border-black px-4 py-2 font-normal  capitalize">bab 3</th>
                                                <th class="border-r border-black px-4 py-2 font-normal  capitalize">bab 4</th>
                                                <th class="border-r border-black px-4 py-2 font-normal  capitalize">bab 5</th>
                                                <th class="border-r border-black px-4 py-2 font-normal  capitalize">bab 6</th>
                                                <th class="border-r border-black px-4 py-2 font-normal  capitalize">bab 7</th>
                                                <th class="border-r border-black px-4 py-2 font-normal  capitalize">ulangan</th>
                                                <th class="px-4 py-2 font-normal  capitalize">rata - rata</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <tr class="bg-white hover:bg-gray-200">
                                                <td class="border-t border-r px-4 py-2">1</td>
                                                <td class="border-t border-r px-4 py-2 capitalize">ghaizan</td>
                                                <td class="border-t border-r  px-4 py-2">90</td>
                                                <td class="border-t border-r  px-4 py-2">90</td>
                                                <td class="border-t border-r  px-4 py-2">90</td>
                                                <td class="border-t border-r  px-4 py-2">90</td>
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
                </section>
                <?php include("../shared/footer.php"); ?>
            </div>
        </main>
    <!-- Navbar Bottom (Mobile Only) -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-green-500 shadow-md">
    <ul class="flex justify-around items-center p-2">
        <!-- Dashboard -->
        <li class="px-3 py-1 rounded-lg bg-green-600">
        <a href="#" class="flex flex-col items-center text-white">
            <i class="bi bi-speedometer2 text-xl"></i>
            <span class="text-xs capitalize">Dashboard</span>
        </a>
        </li>
        <!-- Menu 2 -->
        <li class="px-3 py-1 rounded-lg hover:bg-green-600">
        <a href="#" class="flex flex-col items-center text-white">
            <i class="bi bi-mortarboard"></i>
            <span class="text-xs capitalize">Siswa</span>
        </a>
        </li>
        <!-- Menu 3 -->
        <li class="px-3 py-1 rounded-lg hover:bg-green-600">
        <a href="#" class="flex flex-col items-center text-white">
            <i class="bi bi-folder"></i>
            <span class="text-xs capitalize">rekap nilai</span>
        </a>
        </li>
    </ul>
    </div>


        <?php include("../script/sidebarGuru.php"); ?>
        <script>
                const swiper = new Swiper(".swiper", {
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                spaceBetween: 20,   // 🔹 kasih jarak antar slide (px)
            });


            const ctx = document.getElementById('nilaiChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Kelas 9A', 'Kelas 9B'],
                    datasets: [{
                        label: 'Nilai',
                        data: [75, 80, 85, 90, 88, 90, 100],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',   // merah
                            'rgba(54, 162, 235, 0.6)',   // biru
                            'rgba(255, 206, 86, 0.6)',   // kuning
                            'rgba(75, 192, 192, 0.6)',   // hijau toska
                            'rgba(153, 102, 255, 0.6)',  // ungu
                            'rgba(255, 159, 64, 0.6)',   // oranye
                            'rgba(46, 204, 113, 0.6)',   // hijau
                            'rgba(255, 20, 147, 0.6)',   // pink
                            'rgba(128, 128, 128, 0.6)',  // abu-abu
                            'rgba(139, 69, 19, 0.6)'     // coklat
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',   // merah
                            'rgb(54, 162, 235)',   // biru
                            'rgb(255, 206, 86)',   // kuning
                            'rgb(75, 192, 192)',   // hijau toska
                            'rgb(153, 102, 255)',  // ungu
                            'rgb(255, 159, 64)',   // oranye
                            'rgb(46, 204, 113)',   // hijau
                            'rgb(255, 20, 147)',   // pink
                            'rgb(128, 128, 128)',  // abu-abu
                            'rgb(139, 69, 19)'     // coklat
                        ],
                        borderWidth: 1
                    }]
                },

                options: {
                    responsive: true,   // ❌ nonaktifkan resize otomatis
                    maintainAspectRatio: false, // biar height/width ikuti canvas
                    plugins: {
                        legend: { display: true }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100
                        }
                    }
                }
            });
        </script>

    </body>

    </html>