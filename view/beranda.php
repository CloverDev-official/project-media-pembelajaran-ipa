<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPAVERSE | Beranda</title>
    <?php include("../shared/link.php"); ?>
</head>

<body class="bg-subtle">
    <?php include("../shared/header.php"); ?>
    <main class="min-h-screen">
        <!-- hero section -->
        <div class="bg-main-dark">
            <div class="flex justify-between items-center h-[89vh] ">
                <div class="mx-10 ">
                    <h1 class="capitalize text-white font-bold text-shadow-sm text-5xl">selamat datang di</h1>
                    <h1 class="uppercase text-white font-bold text-shadow-sm text-6xl">ipaverse</h1>
                    <a href="materi.php" class="flex justify-start items-center mt-8">
                        <button class="px-5 py-3 rounded-3xl font-semibold text-main text-xl bg-subtle transition-all duration-150 hover:scale-105 active:scale-95">
                            Mulai Belajar
                        </button>
                    </a>
                </div>
                <div class="hidden md:flex justify-center w-md">
                    <img src="../img/beruang.jpg" alt="foto" class="p-10 rounded-full  m-10">
                </div>
            </div>
        </div>

        <!-- content -->
        <div class="p-4 mb-20 ">
            <!-- wrapper preview card materi  -->
            <div class="flex flex-col items-center mt-32 px-4">
                <!-- judul section -->
                <div class="text-center mb-10 ">
                    <div class="text-5xl animate-float"><i class="fa fa-book text-main-medium "></i></div>
                    <h1 class="font-bold text-3xl sm:text-4xl mt-2 animate-float  text-shadow-2xs text-shadow-green-900  text-main-medium">Materi Pembelajaran</h1>
                    <p class="text-md text-gray-700 mt-5">Pilih dari topik dibawah:</p>
                </div>
                <!-- Container preview materi -->
                <div class="container mx-auto px-4">
                    <!-- Desktop mode (flex) -->
                    <div class="hidden md:flex flex-wrap justify-center gap-6 mb-5">
                        <!-- bab 1 -->
                        <div class="bg-main border-t border-r border-main-dark active:translate-x-[-13.5px] active:bg-green-600 text-white active:text-gray-200 hover:translate-y-[-1rem] transition-all border-l-[6px] border-b-[6px] active:border-l active:border-b active:scale-95 rounded-tl-xl rounded-tr-3xl rounded-bl-xl rounded-b-lg w-72 relative">
                            <!-- nomer bab -->
                            <div class="absolute  bg-main p-1 rounded-tl-md rounded-br-md text-shadow-2xs ">
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
                        <div class="border-t border-r active:border-l active:border-b active:scale-95 border-main-dark text-white active:text-gray-200 active:translate-x-[-13.5px] hover:translate-y-[-1rem] bg-main active:bg-green-600 transition-all border-l-[6px] border-b-[6px] rounded-tl-xl rounded-tr-3xl rounded-bl-xl rounded-b-lg w-72 relative">
                            <!-- nomer bab -->
                            <div class="absolute  bg-main p-1 rounded-tl-md rounded-br-md">
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
                        <div class="border-t border-r border-main-dark active:border-l active:border-b active:scale-95 active:translate-x-[-13.5px] hover:translate-y-[-1rem] active:bg-green-600 bg-main text-white active:text-gray-200 shadow-2xs transition-all border-l-[6px] border-b-[6px] rounded-tl-xl rounded-bl-xl  rounded-tr-3xl rounded-b-lg w-72 relative">
                            <!-- nomer bab -->
                            <div class="absolute bg-main p-1 rounded-tl-md rounded-br-md">
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
                                        <div class="bg-main border-t border-r border-main-dark border-l-[6px] border-b-[6px] rounded-tl-xl rounded-tr-3xl rounded-b-lg w-64 mx-auto relative text-white text-shadow-sm transition-all duration-150 active:border-[1px] active:scale-95 active:translate-x-[-13.5px]">
                                            <div class="absolute bg-main p-1 rounded-tl-sm rounded-br-md ">
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
                                            class="bg-main border-t border-r border-main-dark border-l-[6px] border-b-[6px] rounded-tl-xl rounded-tr-3xl rounded-b-lg w-64 mx-auto relative text-white text-shadow-sm transition-all duration-150 active:border-[1px] active:scale-95 active:translate-x-[-13.5px]">
                                            <div class="absolute bg-main p-1 rounded-tl-sm rounded-br-md">
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
                                            class="bg-main border-t border-r border-main-dark border-l-8 border-b-8 rounded-tl-xl rounded-tr-3xl rounded-b-lg w-64 mx-auto relative text-white text-shadow-sm transition-all duration-150 active:border-[1px] active:scale-95 active:translate-x-[-13.5px]">
                                            <div class="absolute bg-main p-1 rounded-tl-sm rounded-br-md">
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
                        class="border bg-main border-b-4 border-l-4 border-main-dark p-2 rounded-2xl shadow-lg text-2xl text-white px-6 md:px-10 font-bold text-shadow-sm transition-all duration-150 hover:scale-[1.05] active:scale-95 active:shadow-inner">
                        Selengkapnya
                    </button>
                </a>

            </div>
        </div>
        <!-- chart -->
        <div class="bg-main flex flex-col lg:flex-row justify-center  gap-10 lg:gap-52 mt-20 p-4 lg:py-8">
            <!-- Progres Pembelajaran -->
            <div class="flex justify-center ">
                <div class="w-full max-w-md ">
                    <h1 class="font-bold text-2xl lg:text-3xl text-white text-shadow-2xsl">Progres Pembelajaran </h1>
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
                    <h1 class="font-bold text-2xl lg:text-3xl text-white text-shadow-2xs">Nilai Seiring Waktu <i class="bi bi-bar-chart-fill"></i></h1>
                    <p class="mt-2">Pantau perkembangan nilai kamu setiap ujian!</p>
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
                    <h1 class="font-bold text-3xl sm:text-4xl mt-2 text-shadow-2xs text-main-medium text-shadow-green-900">Jelajahi Topik</h1>
                    <p class="text-sm text-gray-700 mt-5">Pilih subjek untuk dipelajari lebih dalam.</p>
                </div>
                <div class="flex flex-wrap justify-center gap-6">
                    <!-- topik 1 -->
                    <div class="bg-white border-b-4 border-l-4 transition-all hover:bg-gray-100 active:bg-gray-100 active:scale-95 active:translate-x-[-13.5px] active:border-[1px]  flex flex-col sm:flex-row gap-5 border border-main-dark p-5 md:w-[25rem] w-[18rem]  rounded-md ">
                        <div class="w-20 h-20 bg-gray-500"></div>
                        <div>
                            <h1 class="font-bold text-xl text-main-medium text-shadow-2xs text-shadow-green-700">Physics Basics</h1>
                            <p class="text-sm text-gray-700">Understanding the world around us</p>
                            <div class="wrap-anywhere">
                                <p class="text-md font-semibold text-main-medium">From motion to energy transformations...</p>
                            </div>

                        </div>
                    </div>
                    <!-- topik 2 -->
                    <div class="bg-white border-b-4  border-l-4 transition-all  hover:bg-gray-100 active:bg-gray-100 active:scale-95 active:translate-x-[-13.5px] active:border-[1px]  flex flex-col sm:flex-row gap-5 border border-main-dark p-5 md:w-[25rem] w-[18rem]  rounded-md ">
                        <div class="w-20 h-20 bg-gray-500"></div>
                        <div>
                            <h1 class="font-bold text-xl text-main-medium text-shadow-2xs text-shadow-green-700">Physics Basics</h1>
                            <p class="text-sm text-gray-700">Understanding the world around us</p>
                            <div class="wrap-anywhere">
                                <p class="text-md font-semibold text-main-medium">From motion to energy transformations...</p>
                            </div>

                        </div>
                    </div>
                    <!-- topik 3 -->
                    <div class="bg-white border-b-4 border-l-4 transition-all   hover:bg-gray-100 active:bg-gray-100 active:scale-95 active:translate-x-[-13.5px] active:border-[1px] flex flex-col sm:flex-row gap-5 border border-main-dark p-5 md:w-[25rem] w-[18rem]  rounded-md ">
                        <div class="w-20 h-20 bg-gray-500"></div>
                        <div>
                            <h1 class="font-bold text-xl text-main-medium text-shadow-2xs text-shadow-green-700">Physics Basics</h1>
                            <p class="text-sm text-gray-700">Understanding the world around us</p>
                            <div class="wrap-anywhere">
                                <p class="text-md font-semibold text-main-medium">From motion to energy transformations...</p>
                            </div>

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
    <script src="../script/berandaChart.js"></script>
    <!-- slideshow js -->
    <script src="../script/berandaSlideShow.js"></script>
</body>

</html>