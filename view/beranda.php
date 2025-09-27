<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPAVERSE | Beranda</title>
    <?php include("../shared/link.php"); ?>
</head>

<style>
    @layer utilities {
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
    }

    ::-webkit-scrollbar {
        display: none;
    }
</style>

<body>
    <?php include("../shared/header.php"); ?>
    <main class="min-h-screen">
        <!-- hero section -->
        <div
            class="bg-[url(../img/section-mobile.png)] lg:bg-[url(../img/section.png)]  bg-cover bg-center bg-no-repeat ">
            <div class="flex justify-center items-center h-[89vh] ">
                <div class="text-center m-5">
                    <a href="materi.php" class="flex justify-center items-center p-5 mt-60">
                        <button
                            class="border bg-linear-to-t from-green-600 to-green-500 border-b-8 border-green-700 p-3 rounded-3xl shadow-lg text-2xl md:text-3xl text-white px-16  font-bold text-shadow-md transition-all duration-150 hover:scale-110 active:  active:border-b-0 active:shadow-inner">
                            Mulai Belajar
                        </button>
                    </a>

                </div>
            </div>
        </div>

        <!-- content -->
        <div class="p-4 mb-20 ">
            <!-- wrapper preview card materi  -->
            <div class="flex flex-col items-center mt-32 px-4">
                <!-- judul section -->
                <div class="text-center mb-10 ">
                    <div class="text-5xl animate-float"><i class="fa fa-book text-green-600 "></i></div>
                    <h1 class="font-bold text-3xl sm:text-4xl mt-2 animate-float  text-shadow-2xs text-shadow-green-900  text-green-600">Materi Pembelajaran</h1>
                    <p class="text-md text-gray-700 mt-5">Pilih dari topik dibawah:</p>
                </div>
                <!-- Container preview materi -->
                <div class="container mx-auto px-4">
                    <!-- Desktop mode (flex) -->
                    <div class="hidden md:flex flex-wrap justify-center gap-6 mb-5">
                        <!-- bab 1 -->
                        <div class="bg-green-500 border-t border-r border-green-600 hover:translate-x-[-13.5px] hover:bg-green-600 text-white hover:text-gray-200 transition-all border-l-[6px] border-b-[6px] hover:border-l hover:border-b hover:scale-95 rounded-tl-xl rounded-tr-3xl rounded-bl-xl rounded-b-lg w-72 relative">
                            <!-- nomer bab -->
                            <div class="absolute  bg-green-500 p-1 rounded-tl-md rounded-br-md text-shadow-2xs ">
                                <p class="text-sm">Bab 1</p>
                            </div>
                            <!-- img card materi -->
                            <div class="bg-gray-200 h-64 rounded-tl-md rounded-tr-3xl rounded-bl-3xl"></div>
                            <!-- judul card materi -->
                            <div class="p-3  text-shadow-2xs">
                                <h1 class="font-bold text-xl">Fisika Dasar</h1>
                                <p class="text-sm">Jelajahi Konsep dasar dalam ilmu Fisika.</p>
                            </div>
                        </div>
                        <!-- bab 2 -->
                        <div class="border-t border-r hover:border-l hover:border-b hover:scale-95 border-green-600 text-white hover:text-gray-200 hover:translate-x-[-13.5px] bg-green-500 hover:bg-green-600 transition-all border-l-[6px] border-b-[6px] rounded-tl-xl rounded-tr-3xl rounded-bl-xl rounded-b-lg w-72 relative">
                            <!-- nomer bab -->
                            <div class="absolute  bg-green-500 p-1 rounded-tl-md rounded-br-md">
                                <p class="text-sm">Bab 2</p>
                            </div>
                            <!-- img card materi -->
                            <div class="bg-gray-200 h-64 rounded-tl-xl rounded-tr-3xl rounded-bl-3xl"></div>
                            <!-- judul card materi -->
                            <div class="p-3">
                                <h1 class="font-semibold text-xl">Fisika Lanjutan</h1>
                                <p class="text-sm">Pelajari hukum-hukum lanjutan dalam Fisika.</p>
                            </div>
                        </div>
                        <!-- bab 3 -->
                        <div class="border-t border-r border-green-600 hover:border-l hover:border-b hover:scale-95 hover:translate-x-[-13.5px] hover:bg-green-600 bg-green-500 text-white hover:text-gray-200 shadow-2xs transition-all border-l-[6px] border-b-[6px] rounded-tl-xl rounded-bl-xl  rounded-tr-3xl rounded-b-lg w-72 relative">
                            <!-- nomer bab -->
                            <div class="absolute bg-green-500 p-1 rounded-tl-md rounded-br-md">
                                <p class="text-sm">Bab 3</p>
                            </div>
                            <!-- img card materi -->
                            <div class="bg-gray-200 h-64 rounded-tl-md rounded-tr-3xl rounded-bl-3xl"></div>
                            <!-- judul card materi -->
                            <div class="p-3">
                                <h1 class="font-semibold text-xl">Eksperimen</h1>
                                <p class="text-sm">Lakukan eksperimen dasar untuk memahami Fisika.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile mode (swiper) -->
                    <div class="block md:hidden">
                        <div class="swiper w-full h-40rem] ">
                            <div class="swiper-wrapper mb-10 flex ">
                                <!-- Slide 1 -->
                                <div class="swiper-slide">
                                    <div class="flex justify-center">
                                        <div class="bg-green-500 border-t border-r border-green-600 border-l-[6px] border-b-[6px] rounded-tl-xl rounded-tr-3xl rounded-b-lg w-64 mx-auto relative text-white text-shadow-sm">
                                            <div class="absolute bg-green-500 p-1 rounded-tl-sm rounded-br-md ">
                                                <p class="text-sm">Bab 1</p>
                                            </div>
                                            <div class="bg-gray-200 h-64 rounded-tl-md rounded-tr-3xl rounded-bl-3xl">
                                            </div>
                                            <div class="p-3 ">
                                                <h1 class="font-semibold text-xl ">Fisika Dasar</h1>
                                                <p class="text-sm">Jelajahi Konsep dasar dalam ilmu Fisika.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Slide 2 -->
                                <div class="swiper-slide ">
                                    <div class="flex justify-center">
                                        <div
                                            class="bg-green-500 border-t border-r border-green-600 border-l-[6px] border-b-[6px] rounded-tl-xl rounded-tr-3xl rounded-b-lg w-64 mx-auto relative text-white text-shadow-sm">
                                            <div class="absolute bg-green-500 p-1 rounded-tl-sm rounded-br-md">
                                                <p class="text-sm">Bab 2</p>
                                            </div>
                                            <div class="bg-gray-200 h-64 rounded-tl-md rounded-tr-3xl rounded-bl-3xl">
                                            </div>
                                            <div class="p-3 ">
                                                <h1 class="font-semibold text-xl">Fisika Lanjutan</h1>
                                                <p class="text-sm">Pelajari hukum-hukum lanjutan dalam Fisika.</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- Slide 3 -->
                                <div class="swiper-slide ">
                                    <div class="flex justify-center">

                                        <div
                                            class="bg-green-500 border-t border-r border-green-600 border-l-8 border-b-8 rounded-tl-xl rounded-tr-3xl rounded-b-lg w-64 mx-auto relative text-white text-shadow-sm">
                                            <div class="absolute bg-green-500 p-1 rounded-tl-sm rounded-br-md">
                                                <p class="text-sm">Bab 3</p>
                                            </div>
                                            <div class="bg-gray-200 h-64 rounded-tl-md rounded-tr-3xl rounded-bl-3xl">
                                            </div>
                                            <div class="p-3 ">
                                                <h1 class="font-semibold text-xl">Eksperimen</h1>
                                                <p class="text-sm">Lakukan eksperimen dasar untuk memahami Fisika.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Pagination -->
                            <div class="swiper-pagination "></div>
                        </div>
                    </div>
                </div>

                <a href="materi.php" class="flex justify-center items-center p-5 mt-5">
                    <button
                        class="border bg-linear-to-t from-green-600 to-green-500 border-b-8 border-green-700 p-2 rounded-3xl shadow-lg text-2xl text-white px-6 md:px-10 font-bold text-shadow-md transition-all duration-150 hover:scale-110 active:scale-95 active:shadow-inner">
                        Selengkapnya
                    </button>
                </a>

            </div>
        </div>
        <!-- chart -->
        <div class="flex flex-col lg:flex-row justify-center  gap-10 lg:gap-52 mt-20 p-4">
            <!-- Progres Pembelajaran -->
            <div class="flex justify-center ">
                <div class="w-full max-w-md ">
                    <h1 class="font-bold text-2xl lg:text-3xl">Progres Pembelajaran </h1>
                    <p class="mt-4">Pantau Terus Pencapaian Kamu!</p>
                    <div class="flex flex-col sm:flex-row gap-5 mt-10">
                        <div class="bg-white border border-l-4 border-b-4  rounded-md p-4 border-gray-300 flex-1">
                            <p class="text-gray-700">Pembelajaran yang selesai</p>
                            <p class="font-semibold text-2xl">12</p>
                        </div>
                        <div class="bg-white border border-l-4 border-b-4  border-gray-300 rounded-md p-4 flex-1">
                            <p class="text-gray-700">Nilai Rata-Rata</p>
                            <p class="font-semibold text-2xl">85%</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Nilai seiring waktu -->
            <div class="flex justify-center">
                <div class=" w-full max-w-md">
                    <h1 class="font-bold text-2xl lg:text-3xl">Nilai Seiring Waktu <i class="bi bi-bar-chart-fill"></i>
                    </h1>
                    <p class="mt-4">Pantau perkembangan nilai kamu setiap ujian!</p>
                    <div class="bg-white mt-10 border border-l-4 border-b-4 border-gray-300 rounded-md p-4">
                        <!-- atur ukuran manual -->
                        <canvas id="nilaiChart" width="100" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- container jelajahi topik -->
        <div class="p-4">
            <!-- Jelajahi Topik -->
            <div class="flex flex-col items-center mt-32 mb-10 px-4" id="jelajahi">
                <div class="text-center mb-10">
                    <div class="text-5xl"><i class="bi bi-search text-shadow-2xs text-shadow-gray-500"></i></div>
                    <h1 class="font-bold text-3xl sm:text-4xl mt-2 text-shadow-2xs text-green-600 text-shadow-green-900">Jelajahi Topik</h1>
                    <p class="text-sm text-gray-700 mt-5">Pilih subjek untuk dipelajari lebih dalam.</p>
                </div>
                <div class="flex flex-wrap justify-center gap-6">
                    <!-- topik 1 -->
                    <div
                        class="border-b-4 border-l-4 transition-all hover:scale-95 hover:border-[1px] hover:translate-x-[-13.5px] hover:bg-gray-100 flex flex-col sm:flex-row gap-5 border border-green-600 p-5 md:w-[25rem] w-[18rem]  rounded-md ">
                        <div class="w-20 h-20 bg-gray-500"></div>
                        <div>
                            <h1 class="font-bold text-xl text-green-600 text-shadow-2xs text-shadow-green-700">Physics Basics</h1>
                            <p class="text-sm text-gray-700">Understanding the world around us</p>
                            <div class="wrap-anywhere">
                                <p class="text-md font-semibold text-green-600">From motion to energy transformations...</p>
                            </div>

                        </div>
                    </div>
                    <!-- topik 2 -->
                    <div
                        class="border-b-4 hover:border-[1px] border-l-4 transition-all hover:scale-95 hover:translate-x-[-13.5px] hover:bg-gray-100 flex flex-col sm:flex-row gap-5 border border-green-600 p-5 md:w-[25rem] w-[18rem]  rounded-md ">
                        <div class="w-20 h-20 bg-gray-500"></div>
                        <div>
                            <h1 class="font-bold text-xl text-green-600 text-shadow-2xs text-shadow-green-700">Physics Basics</h1>
                            <p class="text-sm text-gray-700">Understanding the world around us</p>
                            <div class="wrap-anywhere">
                                <p class="text-md font-semibold text-green-600">From motion to energy transformations...</p>
                            </div>

                        </div>
                    </div>
                    <!-- topik 3 -->
                    <div
                        class="border-b-4 border-l-4 transition-all hover:border-[1px] hover:scale-95 hover:translate-x-[-13.5px]  flex flex-col sm:flex-row gap-5 border border-green-600 p-5 md:w-[25rem] w-[18rem]  rounded-md ">
                        <div class="w-20 h-20 bg-gray-500"></div>
                        <div>
                            <h1 class="font-bold text-xl text-green-600 text-shadow-2xs text-shadow-green-700">Physics Basics</h1>
                            <p class="text-sm text-gray-700">Understanding the world around us</p>
                            <div class="wrap-anywhere">
                                <p class="text-md font-semibold text-green-600">From motion to energy transformations...</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include("../shared/footer.php"); ?>
    <script src="../script/berandaChart.js"></script>
    <script src="../script/berandaSlideShow.js"></script>
</body>

</html>