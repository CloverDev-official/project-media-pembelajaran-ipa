<main class="min-h-screen px-5 md:px-10">
    <!-- gim mobile -->
    <div class="md:hidden mt-40 relative flex justify-center">
        <img src="../img/bg-materi-mobile.png" class="w-full h-[50rem]" alt="">
        <!-- gambar kucing -->
        <div class="absolute -top-14">
            <img src="../img/kucing-hero-section-bawah.png" class="w-24 h-20" alt="">
        </div>
        <!-- judul dan teks -->
        <div class="absolute top-20">
            <h1 class="font-bold text-xl text-center capitalize text-white">
                pilih gim untuk dimainkan
            </h1>
            <p class="text-white text-xs text-center mt-5 w-60">
                Klik salah satu gim untuk mulai bermain dan belajar sambil bersenang-senang.
            </p>
        </div>
        <!-- container card -->
        <div class="absolute top-52">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-2">
                @if($levels->count() > 0)
                    @foreach ($levels as $level)
                        <!-- card gim -->
                        <div class="flex justify-center items-center">
                            <div class="bg-white p-2 rounded-lg w-36 shadow">
                                <!-- container gambar gim -->
                                <div class="flex justify-center">
                                    <!-- gambar gim -->
                                    @if($level->thumbnail)
                                        <img src="{{ asset('storage/' . $level->thumbnail) }}" 
                                             alt="{{ $level->judul_level }}"
                                             class="w-full h-32 rounded-lg object-cover">
                                    @else
                                        <div class="bg-gray-200 w-full h-32 rounded-lg flex items-center justify-center">
                                            <span class="text-gray-500 text-xs text-center">Tidak Ada<br>Gambar</span>
                                        </div>
                                    @endif
                                </div>
                                <!-- judul dan deskripsi gim -->
                                <div class="mb-3 py-2">
                                    <h2 class="font-bold text-blue-500 text-sm capitalize">
                                        {{ $level->judul_level }}</h2>
                                    <h3 class="font-normal text-xs capitalize">
                                        {{ Str::limit($level->deskripsi, 50) }}</h3>
                                </div>
                                <!-- btn mainkan -->
                                <a wire:navigate href="{{ route('gim.main', $level->id) }}">
                                    <button
                                        class="mt-2 py-2 text-sm w-full rounded-lg transition-all duration-150 bg-yellow-300 hover:bg-yellow-500 active:scale-95 capitalize">
                                        mainkan
                                    </button>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-2 text-center text-white py-12">
                        <p>Belum ada gim yang tersedia.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- gim desktop -->
    <div class="hidden md:block mt-40 relative">
        <div class="relative">
            <img src="../img/bg-materi.png" class="w-full" alt="">
        </div>
        <div class="absolute top-[1.8rem] right-24">
            <img src="../img/kucing-hero-section-bawah.png" alt="">
        </div>
        <div class="absolute top-20 left-28">
            <h1 class="font-bold text-5xl capitalize text-white">
                pilih gim untuk dimainkan
            </h1>
            <p class="text-white text-lg mt-5">
                Klik salah satu gim untuk mulai bermain dan belajar sambil bersenang-senang.
            </p>
        </div>
        <div class="flex justify-start mx-20">
            <div class="absolute top-60">
                <!-- Daftar Gim -->
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-5 w-full">
                    @if($levels->count() > 0)
                        @foreach ($levels as $level)
                            <!-- card gim -->
                            <div class="w-[15rem] flex justify-center items-center">
                                <div class="bg-white p-2 rounded-lg min-w-[15rem] shadow">
                                    <!-- container gambar gim -->
                                    <div class="flex justify-center">
                                        <!-- gambar gim -->
                                        @if($level->thumbnail)
                                            <img src="{{ asset('storage/' . $level->thumbnail) }}" 
                                                 alt="{{ $level->judul_level }}"
                                                 class="w-full h-[12rem] rounded-lg object-cover">
                                        @else
                                            <div class="bg-gray-200 w-full h-[12rem] rounded-lg flex items-center justify-center">
                                                <span class="text-gray-500 text-center">Tidak Ada Gambar</span>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- judul dan deskripsi gim -->
                                    <div class="mb-3 py-2">
                                        <h2 class="font-bold text-blue-500 capitalize">
                                            {{ $level->judul_level }}</h2>
                                        <h3 class="font-normal text-xs capitalize">
                                            {{ Str::limit($level->deskripsi, 80) }}</h3>
                                    </div>
                                    <!-- btn mainkan -->
                                    <a wire:navigate href="{{ route('gim.main', $level->id) }}">
                                        <button
                                            class="mt-2 py-1 text-sm w-full rounded-lg transition-all duration-150 bg-yellow-300 hover:bg-yellow-500 active:scale-95 capitalize">
                                            mainkan
                                        </button>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-span-4 text-center text-gray-500 py-12">
                            <p class="text-lg">Belum ada gim yang tersedia.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>