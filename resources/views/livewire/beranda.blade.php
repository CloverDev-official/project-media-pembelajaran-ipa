<main class="min-h-screen bg-blue-50">
    <!-- beranda mobile -->
    <livewire:mobile.beranda-mobile />

    <!-- hero section dekstop -->
    <div class="hidden relative md:flex items-center justify-center m-10">
        <img src="../img/background-hero-section.png" class="w-full h-[60rem]" alt="">
        <div class="absolute left-24">
            <div class="relative flex items-center gap-20">
                <div>
                    <h1 class="w-[45rem] leading-20 capitalize text-7xl font-bold text-white">
                        belajar lebih
                        <span class="relative text-yellow-300">
                            cerdas
                            <div class="absolute bottom-[-12px] right-2">
                                <img src="../img/garis.png" alt="">
                            </div>
                        </span>
                        memahami dunia lebih dalam
                    </h1>
                    <h1 class="mt-16 w-[40rem] text-3xl text-white">Pelajari ilmu pengetahuan alam
                        dengan cara mudah dan menyenangkan bersama</h1>
                    <a href="materi" class="flex justify-start items-center mt-16">
                        <button
                            class="w-[25rem] px-3 py-5 rounded-full text-black text-3xl bg-yellow-300 transition-all duration-150 hover:scale-105 active:scale-95">
                            Mulai Belajar
                        </button>
                    </a>
                </div>

            </div>
        </div>
        <!-- gambar kucing -->
        <div class="absolute right-28 top-20">
            <img src="../img/ucing-ucu.png" alt="">
        </div>

        <div class="absolute left-32 bottom-[-1rem]">
            <img src="../img/kucing-hero-section-bawah.png" alt="">
        </div>
    </div>

    <!-- content -->
    <div class="hidden md:block p-4">
        <!-- wrapper preview card materi  -->
        <div class="flex flex-col items-center mt-10 px-4">
            <!-- judul section -->
            <div class="text-center mb-10 ">
                <h1
                    class="font-bold text-3xl sm:text-4xl mt-2 animate-float  text-shadow-2xs text-shadow-green-900  text-main">
                    Materi
                    <span class="text-blue-500">
                        belajar
                    </span>
                </h1>
                <p class="text-gray-700 mt-5">
                    Belajar menjadi lebih mudah dan menyenangkan dengan penjelasan lengkap dan mudah
                    dipahami.
                </p>
            </div>
            <!-- Container preview materi -->
            <div class="container mx-auto px-4">
                <!-- Desktop mode (flex) -->
                <div class="hidden md:flex flex-wrap justify-center gap-6 mb-5">
                    <!-- card -->
                    @for ($i = 1; $i <= 3; $i++)
                        <div
                            class="bg-white  active:translate-x-[-13.5px] active:bg-gray-50 text-black active:text-gray-500 hover:scale-[1.02] transition-all  active:border-l active:border-b active:scale-95 rounded-tl-xl rounded-tr-3xl rounded-bl-xl shadow-md rounded-b-lg min-w-[20rem] h-[25rem] relative">
                            <!-- img card materi -->
                            <div
                                class="bg-blue-500 h-72 rounded-tl-md rounded-tr-3xl rounded-bl-3xl">
                            </div>
                            <!-- judul card materi -->
                            <div class="p-3  text-shadow-2xs">
                                <h1 class="font-bold text-xl">Fisika Dasar</h1>
                                <p class="text-sm font-normal">Jelajahi Konsep dasar dalam ilmu
                                    Fisika.</p>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <a href="materi" class="flex justify-center items-center p-5 mt-5">
                <button
                    class="bg-yellow-300  p-2 py-3 md:py-4 rounded-full shadow-lg text-xl md:text-2xl text-black px-6 md:px-10  transition-all duration-150 hover:scale-[1.05] active:scale-95 active:shadow-inner">
                    Selengkapnya
                </button>
            </a>

        </div>
    </div>
    <!-- chart -->
    <div class="hidden md:flex mx-10 relative justify-center items-center">
        <img src="../img/bg-grafik.png" class="w-full" alt="">
        <div class="absolute rounded-4xl flex flex-col lg:flex-row gap-10 lg:gap-32  p-4 lg:py-40">
            <!-- Progres Pembelajaran -->
            <div class="flex justify-center">
                <div class="w-[30rem]">
                    <div class="bg-white rounded-lg p-5">
                        <h1 class="font-bold text-2xl lg:text-3xl text-black text-shadow-2xsl">
                            Progres Pembelajaran
                        </h1>
                        <p class="mt-2">Pantau Terus Pencapaian Kamu!</p>
                        <div class="flex flex-col sm:flex-row gap-5 mt-5">
                            <div
                                class="p-4 bg-white border border-l-4 border-b-4  rounded-md p  -4 border-gray-300 flex-3">
                                <p class="text-gray-700">Pembelajaran yang selesai</p>
                                <p class="font-semibold text-2xl">
                                    {{ $jumlahNilai ? $jumlahNilai : '-' }}</p>
                            </div>
                            <div
                                class="bg-white border border-l-4 border-b-4  border-gray-300 rounded-md p-4 flex-2">
                                <p class="text-gray-700">Nilai Rata-Rata</p>
                                <p class="font-semibold text-2xl">
                                    {{ $nilaiRataRata ? $nilaiRataRata : '-' }}%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Nilai seiring waktu -->
            <div class="flex justify-center">
                <div class=" w-[30rem]">
                    <div class="bg-white rounded-lg p-5">
                        <h1 class="font-bold text-2xl lg:text-3xl text-black text-shadow-2xs">
                            Nilai Seiring Waktu
                            <i class="bi bi-bar-chart-fill"></i>
                        </h1>
                        <p class="mt-2">Pantau perkembangan nilai kamu setiap ujian!</p>
                        <div class="mt-5  p-2">
                            <!-- atur ukuran manual -->
                            <livewire:components.chart />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
