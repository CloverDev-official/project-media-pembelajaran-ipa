<div>
    <!-- hero section -->
    <div class="md:hidden relative flex justify-center flex-col items-center m-5">
        <img src="../img/bg-hero-section-mobile.png" class="h-[55rem]" alt="">
        <div class="absolute left-10">
            <div>
                <h1 class="w-[15rem] leading-10 capitalize text-4xl font-bold text-white">
                    belajar lebih
                    <span class="relative text-yellow-300">
                        cerdas
                        <div class="">
                            <img src="../img/garis.png" class="w-32" alt="">
                        </div>
                    </span>
                    memahami dunia lebih dalam
                </h1>
                <h1 class="mt-14 w-[13rem] text-xl text-white">
                    Pelajari ilmu pengetahuan alam dengan cara mudah dan menyenangkan bersama
                </h1>
                <a href="materi" class="flex justify-start items-center mt-14">
                    <button
                        class="w-[10rem] px-2 py-1 rounded-full text-black text-lg bg-yellow-300 transition-all duration-150 hover:scale-105 active:scale-95">
                        Mulai Belajar
                    </button>
                </a>
            </div>
        </div>
        <!-- gambar kucing -->
        <div class="absolute left-2 -bottom-3">
            <img src="../img/kucing-hero-section-bawah.png" class="w-28 h-20" alt="">
        </div>
    </div>
        <!-- content -->
    <div class="md:hidden p-4">
        <!-- wrapper preview card materi  -->
        <div class="flex flex-col items-center mt-10 px-4">
            <!-- judul section -->
            <div class="text-center mb-10 ">
                <h1
                    class="font-bold text-4xl mt-2 animate-float  text-shadow-2xs text-shadow-green-900  text-main">
                        Materi
                        <span class="text-blue-500">
                            belajar
                        </span>
                </h1>
                <p class="text-gray-700 mt-5">
                    Belajar menjadi lebih mudah dan menyenangkan dengan penjelasan lengkap dan mudah dipahami.
                </p>
            </div>
            <!-- Container preview materi -->
            <div class="container mx-auto px-4">
                <!-- Mobile mode (swiper) -->
                <div class="block md:hidden">
                    <div class="swiper w-full h-40rem] ">
                        <div class="swiper-wrapper flex ">
                            <!-- Slide card -->
                            @for($i = 1; $i <= 3; $i++)
                                <div class="swiper-slide">
                                    <div class="flex justify-center">
                                        <div
                                            class="bg-white rounded-tl-xl rounded-tr-3xl rounded-b-lg w-64 mx-auto relative text-black text-shadow-sm transition-all duration-150 active:border-[1px] active:scale-95 active:translate-x-[-13.5px] active:translate shadow-md">

                                            <div
                                                class="bg-blue-500 h-56 rounded-tl-md rounded-tr-3xl rounded-bl-3xl">
                                            </div>
                                            <div class="p-3 ">
                                                <h1 class="font-semibold text-xl ">Fisika Dasar</h1>
                                                <p class="text-sm">
                                                    Jelajahi Konsep dasar dalam ilmu Fisika.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <!-- Pagination -->
                        <div class="swiper-pagination "></div>
                    </div>
                </div>
            </div>

            <a href="materi" class="flex justify-center items-center p-5 mt-5">
                <button
                    class="bg-yellow-300  p-2 py-3 md:py-4 rounded-full shadow-lg text-xl md:text-2xl text-black px-6 transition-all duration-150 hover:scale-[1.05] active:scale-95 active:shadow-inner">
                    Selengkapnya
                </button>
            </a>

        </div>
    </div>
    <!-- grafik  -->
     <div class="md:hidden relative flex justify-center flex-col items-center m-5">
        <img src="../img/bg-grafik-mobile.png" class="h-[40rem]" alt="">
        <div class=" flex justify-center items-center">
            <div class="absolute top-16 rounded-4xl flex flex-col justify-center items-center gap-10 p-4">            
                <!-- Progres Pembelajaran -->
                 <div class="w-full">                                        
                    <div class="bg-white rounded-lg p-5 h-52">
                        <h1 class="font-bold text-lg text-black text-center">
                            Progres Pembelajaran
                        </h1>
                        <p class="mt-2 text-sm">Pantau Terus Pencapaian Kamu!</p>
                        <div class="flex gap-5 mt-5">
                            <div
                                class="p-4 bg-white border border-l-4 border-b-4  rounded-md border-gray-300 flex-1">
                                <p class="text-gray-700 text-xs">selesai</p>
                                <p class="font-semibold text-lg">12</p>
                            </div>
                            <div
                                class="bg-white border border-l-4 border-b-4  border-gray-300 rounded-md p-4 flex-3">
                                <p class="text-gray-700 text-xs">nilai Rata-Rata</p>
                                <p class="font-semibold text-lg">85%</p>
                            </div>
                        </div>
                    </div>                    
                 </div>

                <!-- Nilai seiring waktu -->
                <div class="flex justify-center">                    
                    <div class="bg-white rounded-lg p-5 text-center">
                        <h1 class="font-bold text-lg text-black">
                            Nilai Seiring Waktu     
                            <i class="bi bi-bar-chart-fill"></i>
                        </h1>
                        <p class="mt-2 text-sm">Pantau perkembangan nilai kamu setiap ujian!</p>
                        <div class="mt-5  p-4">
                            <!-- atur ukuran manual -->
                            <canvas id="nilaiChart" width="200" height="50"></canvas>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
     </div>
</div>