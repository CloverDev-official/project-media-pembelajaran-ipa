<div>
    <div class="md:hidden mt-40 relative flex justify-center">
        <img src="../img/bg-materi-mobile.png" alt="">
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
        <div class="absolute top-60">
            <!-- template bab -->
            @foreach ($daftarMateri as $materi)
                <!-- card materi -->
                <div class="flex justify-center items-center">
                    <div
                        class="bg-white border border-l-4 border-b-4 border-gray-300 p-2 rounded-lg min-w-[15rem] shadow">
                        <!-- container gambar materi -->
                        <div class="flex justify-center">
                            <!-- gambar materi -->
                            <img src="{{ $materi->gambar ? asset('storage/' . $materi->gambar) : 'https://placehold.co/700x600?text=Gambar\nMaterasdasdasi' }}"
                                class="bg-gray-200 w-full h-[12rem] rounded-lg border-0">
                        </div>
                        <!-- judul dan deskripsi materi -->
                        <div class="mb-3 py-2">
                            <h2 class="font-bold text-main text-lg capitalize">
                                {{ $materi->judul_bab }}</h2>
                            <h3 class="font-bold text-main text-lg capitalize">
                                {{ $materi->deskripsi }}</h3>

                        </div>
                        <!-- btn baca -->
                        <a wire:navigate href="{{ route('isi.materi', $materi->id) }}">
                            <button
                                class="mt-2 py-1 font-semibold text-sm w-full rounded-lg transition-all duration-150 bg-yellow-400 hover:bg-yellow-500  active:scale-95  capitalize">
                                mulai baca
                            </button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
