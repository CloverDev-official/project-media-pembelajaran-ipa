<main class="min-h-screen px-5 md:px-10">
    <!-- materi mobile -->
    <div class="md:hidden mt-40 relative flex justify-center">
        <img src="../img/bg-materi-mobile.png" class="w-full h-[50rem]" alt="">
        <!-- gambar kucing -->
        <div class="absolute -top-14">
            <img src="../img/kucing-hero-section-bawah.png" class="w-24 h-20" alt="">
        </div>
        <!-- judul dan teks -->
        <div class="absolute top-20">
            <h1 class="font-bold text-xl text-center capitalize text-white">
                pilih materi belajar
            </h1>
            <p class="text-white text-xs text-center mt-5 w-60">
                Klik salah satu materi untuk mulai membaca materi dan mengerjakan latihan.
            </p>
        </div>
        <!-- container card -->
        <div class="absolute top-52">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-2">
                <!-- template bab -->
                @foreach ($daftarMateri as $materi)
                    <!-- card materi -->
                    <div class="flex justify-center items-center">
                        <div
                            class="bg-white  p-2 rounded-lg w-36 shadow">
                            <!-- container gambar materi -->
                            <div class="flex justify-center">
                                <!-- gambar materi -->
                                <img src="https://placehold.co/400x200?text=Gambar\nMateri" class="bg-gray-200 w-full h-32 rounded-lg border-0">
                            </div>
                            <!-- judul dan deskripsi materi -->
                            <div class="mb-3 py-2">
                                <h2 class="font-bold text-blue-500 text-sm capitalize">{{ $materi->judul_bab }}</h2>
                            </div>
                            <!-- btn baca -->
                            <a wire:navigate href="{{ route('isi.materi', $materi->id) }}">
                                <button
                                    class="mt-2 py-2 text-sm w-full rounded-lg transition-all duration-150 bg-yellow-300 hover:bg-yellow-500  active:scale-95  capitalize">
                                    mulai baca
                                </button>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- materi dekstop -->
    <div class="hidden md:block mt-40 relative">
        <div class="relative">
            <img src="../img/bg-materi.png" class="w-full" alt="">
        </div>
        <div class="absolute top-[1.8rem] right-24">
            <img src="../img/kucing-hero-section-bawah.png" alt="">
        </div>
        <div class="absolute top-20 left-28">
            <h1 class="font-bold text-5xl capitalize text-white">
                pilih materi belajar
            </h1>
            <p class="text-white text-lg mt-5">
                Klik salah satu materi untuk mulai membaca materi dan mengerjakan latihan.
            </p>
        </div>
        <div class="absolute top-60 left-28">
            <!-- Daftar Bab -->
            <div class="flex flex-col md:flex-row grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-5 w-full">
                <!-- Template bab -->
                @foreach ($daftarMateri as $materi)
                    <!-- card materi -->
                    <div class="flex justify-center items-center">
                        <div class="bg-white p-2 rounded-lg min-w-[15rem] shadow">
                            <!-- container gambar materi -->
                            <div class="flex justify-center">
                                <!-- gambar materi -->
                                <img src="https://placehold.co/700x600?text=Gambar\nMateri" class="bg-gray-200 w-full h-[12rem] rounded-lg border-0">
                            </div>
                            <!-- judul dan deskripsi materi -->
                            <div class="mb-3 py-2">
                                <h2 class="font-bold text-blue-500 text-lg capitalize">{{ $materi->judul_bab }}</h2>
                            </div>
                            <!-- btn baca -->
                            <a wire:navigate href="{{ route('isi.materi', $materi->id) }}">
                                <button
                                    class="mt-2 py-1 text-sm w-full rounded-lg transition-all duration-150 bg-yellow-300 hover:bg-yellow-500  active:scale-95  capitalize">
                                    mulai baca
                                </button>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
