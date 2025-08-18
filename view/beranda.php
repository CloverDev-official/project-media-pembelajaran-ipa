<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <?php include("../shared/link.php"); ?>
</head>

<body>
    <?php include("../shared/header.php"); ?>
    <main>
        <!-- hero section -->
        <div class="bg-img-hero-section-beranda">
            <div class="flex justify-center items-center h-[89vh] ">
                <div class="text-center m-5">
                    <h1 class="md:text-5xl text-4xl font-bold mb-4 text-white text-shadow-md">Selamat Datang Science Explorer</h1>
                    <p class="text-md text-white font-semibold text-shadow-md">
                        Selami dunia sains dengan pelajaran
                        interaktif yang membuat pembelajaran menjadi menyenangkan!
                    </p>
                    <a href="materi.php" class="flex justify-center items-center mt-7">
                        <button
                            class="p-2 rounded-xl bg-green-600 shadow-lg text-md text-white px-20 font-bold text-shadow-sm">
                            Mulai <i class="fa fa-rocket"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <!-- content -->
        <div class="p-4">
            <!-- dashboard -->
            <div class="flex flex-col lg:flex-row justify-center  gap-10 lg:gap-52 mt-10 p-4">
                <!-- Progres Pembelajaran -->
                <div class="flex justify-center ">
                    <div class="w-full max-w-md ">
                        <h1 class="font-bold text-2xl lg:text-3xl">Progres Pembelajaran </h1>
                        <p class="mt-4">Pantau Terus Pencapaian Kamu!</p>
                        <div class="flex flex-col sm:flex-row gap-5 mt-10">
                            <div class="border rounded-md p-4 border-gray-400 flex-1">
                                <p class="text-gray-700">Pembelajaran yang selesai</p>
                                <p class="font-semibold text-2xl">12</p>
                            </div>
                            <div class="border border-gray-400 rounded-md p-4 flex-1">
                                <p class="text-gray-700">Nilai Rata-Rata</p>
                                <p class="font-semibold text-2xl">85%</p>
                            </div>
                        </div>
                    </div>
                </div>
               <!-- Nilai seiring waktu -->
                <div class="flex justify-center">
                    <div class=" w-full max-w-md">
                        <h1 class="font-bold text-2xl lg:text-3xl">Nilai Seiring Waktu <i
                                class="bi bi-bar-chart-fill"></i>
                        </h1>
                        <p class="mt-4">Pantau perkembangan nilai kamu setiap ujian!</p>
                        <div class="mt-10 border border-gray-400 rounded-md p-4">
                            <!-- atur ukuran manual -->
                            <canvas id="nilaiChart" width="100" height="150"></canvas>
                        </div>
                    </div>
                </div>


            </div>

            <!-- Preview Materi Pembelajaran -->
            <div class="flex flex-col items-center mt-32 px-4">
                <div class="text-center mb-10">
                    <div class="text-5xl"><i class="fa fa-book"></i></div>
                    <h1 class="font-bold text-3xl sm:text-4xl mt-2">Materi Pembelajaran</h1>
                    <p class="text-md text-gray-700 mt-5">Pilih dari topik dibawah:</p>
                </div>
                <!-- Materi -->
                <div class="flex flex-wrap justify-center gap-6 mb-5">
                    <!-- bab 1 -->
                    <div class="border border-gray-400 rounded-tl-md rounded-tr-3xl rounded-b-lg w-72">
                        <div class="absolute bg-gray-300 p-1 rounded-tl-md rounded-br-md">
                            <p class="text-sm">Bab 1</p>
                        </div>
                        <div class="bg-gray-200 h-64 rounded-tl-md rounded-tr-3xl rounded-bl-3xl"></div>
                        <div class="p-3">
                            <h1 class="font-semibold text-xl">Fisika Dasar</h1>
                            <p class="text-sm">Jelajahi Konsep dasar dalam ilmu Fisika.</p>
                        </div>
                    </div>
                    <!-- bab 2 -->
                    <div class="border border-gray-400 rounded-tl-md rounded-tr-3xl rounded-b-lg w-72">
                        <div class="absolute bg-gray-300 p-1 rounded-tl-md rounded-br-md">
                            <p class="text-sm">Bab 2</p>
                        </div>
                        <div class="bg-gray-200 h-64 rounded-tl-md rounded-tr-3xl rounded-bl-3xl"></div>
                        <div class="p-3">
                            <h1 class="font-semibold text-xl">Fisika Dasar</h1>
                            <p class="text-sm">Jelajahi Konsep dasar dalam ilmu Fisika.</p>
                        </div>
                    </div>
                    <!-- bab 3 -->
                    <div class="border border-gray-400 rounded-tl-md rounded-tr-3xl rounded-b-lg w-72">
                        <div class="absolute bg-gray-300 p-1 rounded-tl-md rounded-br-md">
                            <p class="text-sm">Bab 3</p>
                        </div>
                        <div class="bg-gray-200 h-64 rounded-tl-md rounded-tr-3xl rounded-bl-3xl"></div>
                        <div class="p-3">
                            <h1 class="font-semibold text-xl">Fisika Dasar</h1>
                            <p class="text-sm">Jelajahi Konsep dasar dalam ilmu Fisika.</p>
                        </div>
                    </div>
                </div>
                <a href="" class="mt-5">
                    <button class="border rounded-md p-2 text-lg">Selengkapnya</button>
                </a>
            </div>

            <!-- Jelajahi Topik -->
            <div class="flex flex-col items-center mt-32 mb-10 px-4">
                <div class="text-center mb-10">
                    <div class="text-5xl"><i class="bi bi-search"></i></div>
                    <h1 class="font-bold text-3xl sm:text-4xl mt-2">Jelajahi Topik</h1>
                    <p class="text-sm text-gray-700 mt-5">Pilih subjek untuk dipelajari lebih dalam.</p>
                </div>
                <div class="flex flex-wrap justify-center gap-6">
                    <!-- topik 1 -->
                    <div
                        class="flex flex-col sm:flex-row gap-5 border border-gray-700 p-5 md:w-[25rem] w-[18rem]  rounded-md ">
                        <div class="w-20 h-20 bg-gray-500"></div>
                        <div>
                            <h1 class="font-bold text-xl">Physics Basics</h1>
                            <p class="text-sm text-gray-700">Understanding the world around us</p>
                            <div class="wrap-anywhere">
                                <p class="text-md font-semibold">From motion to energy transformations...</p>
                            </div>
                            <div class="flex gap-3 mt-2">
                                <div class="p-1 bg-gray-200 rounded-sm text-xs">Beginner</div>
                                <div class="p-1 bg-gray-200 rounded-sm text-xs">Intermediate</div>
                            </div>
                        </div>
                    </div>
                    <!-- topik 2 -->
                    <div
                        class="flex flex-col sm:flex-row gap-5 border border-gray-700 p-5 md:w-[25rem] w-[18rem]  rounded-md ">
                        <div class="w-20 h-20 bg-gray-500"></div>
                        <div>
                            <h1 class="font-bold text-xl">Physics Basics</h1>
                            <p class="text-sm text-gray-700">Understanding the world around us</p>
                            <div class="wrap-anywhere">
                                <p class="text-md font-semibold">From motion to energy transformations...</p>
                            </div>
                            <div class="flex gap-3 mt-2">
                                <div class="p-1 bg-gray-200 rounded-sm text-xs">Beginner</div>
                                <div class="p-1 bg-gray-200 rounded-sm text-xs">Intermediate</div>
                            </div>
                        </div>
                    </div>
                    <!-- topik 3 -->
                    <div
                        class="flex flex-col sm:flex-row gap-5 border border-gray-700 p-5 md:w-[25rem] w-[18rem]  rounded-md ">
                        <div class="w-20 h-20 bg-gray-500"></div>
                        <div>
                            <h1 class="font-bold text-xl">Physics Basics</h1>
                            <p class="text-sm text-gray-700">Understanding the world around us</p>
                            <div class="wrap-anywhere">
                                <p class="text-md font-semibold">From motion to energy transformations...</p>
                            </div>
                            <div class="flex gap-3 mt-2">
                                <div class="p-1 bg-gray-200 rounded-sm text-xs">Beginner</div>
                                <div class="p-1 bg-gray-200 rounded-sm text-xs">Intermediate</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include("../shared/footer.php"); ?>
    <script>
        const ctx = document.getElementById('nilaiChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Ujian 1', 'Ujian 2', 'Ujian 3', 'Ujian 4', 'Ujian 5'],
                datasets: [{
                    label: 'Nilai',
                    data: [70, 80, 85, 90, 88],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',   // merah
                        'rgba(54, 162, 235, 0.6)',   // biru
                        'rgba(255, 206, 86, 0.6)',   // kuning
                        'rgba(75, 192, 192, 0.6)',   // hijau toska
                        'rgba(153, 102, 255, 0.6)'   // ungu
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 206, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)'
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
