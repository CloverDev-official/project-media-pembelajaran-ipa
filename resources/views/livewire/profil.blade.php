<main class="min-hscreen">
    <livewire:components.modal.modal-edit-profil lazy />
    <!-- mobile -->
    <div class="md:hidden mx-5 mt-40">
        <!-- biodata -->
        <div class="relative flex justify-center">
            <img src="../img/bg-profil-mobile.png" alt="">
            <div class="absolute -top-14">
                <div class="relative bg-gray-200 rounded-full w-20 h-20 shadow-md">
                    <img src="{{ $murid->gambar ? asset('storage/' . $murid->gambar) : 'https://placehold.co/300x200?text=foto+profil' }}"
                        alt="" class="bg-gray-200 rounded-full p-1 w-20 h-20 shadow-md">
                    <div class="absolute top-1 -left-2">
                        <button wire:click="$dispatch('toggleEditProfilPopup')">
                            <div
                                class="flex justify-center items-center rounded-full border-white w-5 h-5 transition-all duration-100 active:scale-95 bg-[#489BF9] hover:bg-[#1565C0]">
                                <div class="p-1">
                                    <iconify-icon icon="line-md:pencil-twotone"
                                        class="text-xs text-white"></iconify-icon>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
            <div class="absolute top-10 left-5">
                <div class="flex flex-col gap-2">
                    <!-- nama murid -->
                    <div class="flex flex-col gap-1">
                        <h1 class="font-bold text-sm text-yellow-400 capitalize">nama siswa</h1>
                        <p class="font-semibold text-xs text-white capitalize">
                            {{ $infoMurid->nama }}
                        </p>
                    </div>
                    <!-- kelas murid -->
                    <div class="flex flex-col gap-1">
                        <h1 class="font-bold text-sm text-yellow-400 capitalize">Kelas</h1>
                        <p class="font-semibold text-xs text-white capitalize">
                            {{ $infoMurid->kelas->nama_kelas }}
                        </p>
                    </div>
                    <!-- sekolah murid -->
                    <div class="flex flex-col gap-1">
                        <h1 class="font-bold text-sm text-yellow-400 capitalize">sekolah</h1>
                        <p class="font-semibold text-xs text-white capitalize">
                            {{ $infoMurid->sekolah }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="absolute -bottom-2 right-8">
                <img src="../img/kucing-hero-section-bawah.png" class="w-20 h-16" alt="">
            </div>
        </div>

        <!-- nilai murid -->
        <div class="flex flex-col gap-10 mt-10">
            <div class="relative flex justify-center">
                <img src="../img/bg-nilai-mobile.png" alt="">
                <div class="absolute top-1">
                    <div class="flex flex-col items-center gap-1">
                        <h1 class="font-bold text-center text-sm  text-white capitalize">nilai
                            tertinggi</h1>
                        <p class="font-semibold text-lg text-white capitalize">
                            {{ $nilaiTertinggi ? $nilaiTertinggi : '-' }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="relative flex justify-center">
                <img src="../img/bg-nilai-mobile.png" alt="">
                <div class="absolute top-1">
                    <div class="flex flex-col items-center gap-1">
                        <h1 class="font-bold text-center text-sm  text-white capitalize">nilai
                            terendah</h1>
                        <p class="font-semibold text-lg text-white capitalize">
                            {{ $nilaiTerendah ? $nilaiTerendah : '-' }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="relative flex justify-center">
                <img src="../img/bg-nilai-mobile.png" alt="">
                <div class="absolute top-1">
                    <div class="flex flex-col items-center gap-1">
                        <h1 class="font-bold text-center text-sm  text-white capitalize">nilai rata
                            - rata</h1>
                        <p class="font-semibold text-lg text-white capitalize">
                            {{ $nilaiRataRata ? $nilaiRataRata : '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- garfik nilai -->
        <div class="relative mt-20">
            <img src="../img/bg-profil-grafik-mobile.png" class="w-full" alt="">
            <div class="absolute top-2 left-5 w-7xl">
                <div class="flex flex-col gap-4">
                    <h1 class="font-bold text-sm  text-white capitalize">grafik nilai per bab</h1>
                    <p class="font-normal text-xs text-white capitalize">
                        nilai(0-100)
                    </p>
                </div>
            </div>
            <div class="flex justify-center items-center mt-5">
                <div class="absolute bottom-10">
                    <div class="w-72">
                        <div class="bg-white rounded-lg p-1">
                            <div class="mt-5  p-4">
                                {{-- <livewire:components.chart /> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- dekstop -->
    <div class="hidden md:block p-4 mx-16">
        <!-- biodata dan nilai murid -->
        <div class="flex flex-col md:flex-row  gap-10 mt-72">
            <!-- biodata murid -->
            <div class="relative">
                <img src="../img/bg-profil.png" alt="">
                <div class="absolute -top-36 left-24">
                    <div class="relative bg-gray-200 rounded-full w-48 h-48 shadow-md">
                        <img src="{{ $murid->gambar ? asset('storage/' . $murid->gambar) : 'https://placehold.co/300x200?text=foto+profil' }}"
                            alt="" class="bg-gray-200 rounded-full p-2 w-48 h-48 shadow-md">
                        <div class="absolute top-4 -left-2">
                            <button wire:click="$dispatch('toggleEditProfilPopup')">
                                <div
                                    class="flex justify-center items-center rounded-full border-white w-10 h-10 transition-all duration-100 active:scale-95 bg-[#489BF9] hover:bg-[#1565C0]">
                                    <div class="p-1">
                                        <iconify-icon icon="line-md:pencil-twotone"
                                            class="text-xl text-white"></iconify-icon>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="absolute top-28 left-20">
                    <div class="flex flex-col gap-8">
                        <!-- nama murid -->
                        <div class="flex flex-col gap-2">
                            <h1 class="font-bold text-5xl text-yellow-400 capitalize">nama siswa
                            </h1>
                            <p class="font-semibold text-3xl text-white capitalize">
                                {{ $infoMurid->nama }}
                            </p>
                        </div>
                        <!-- kelas murid -->
                        <div class="flex flex-col gap-2">
                            <h1 class="font-bold text-5xl text-yellow-400 capitalize">Kelas</h1>
                            <p class="font-semibold text-3xl text-white capitalize">
                                {{ $infoMurid->kelas->nama_kelas }}
                            </p>
                        </div>
                        <!-- sekolah murid -->
                        <div class="flex flex-col gap-2">
                            <h1 class="font-bold text-5xl text-yellow-400 capitalize">sekolah</h1>
                            <p class="font-semibold text-3xl text-white capitalize">
                                {{ $infoMurid->sekolah }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="absolute -bottom-3 right-10">
                    <img src="../img/kucing-hero-section-bawah.png" alt="">
                </div>
            </div>
            <!-- nilai murid -->
            <div class="flex flex-col gap-10">
                <div class="relative">
                    <img src="../img/bg-nilai.png" alt="">
                    <div class="absolute top-5 left-16">
                        <div class="flex flex-col items-center gap-4">
                            <h1 class="font-bold text-xl text-white capitalize">nilai tertinggi
                            </h1>
                            <p class="font-semibold text-5xl text-white capitalize">
                                {{ $nilaiTertinggi ? $nilaiTertinggi : '-' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <img src="../img/bg-nilai.png" alt="">
                    <div class="absolute top-5 left-16">
                        <div class="flex flex-col items-center gap-4">
                            <h1 class="font-bold text-xl text-white capitalize">nilai terendah</h1>
                            <p class="font-semibold text-5xl text-white capitalize">
                                {{ $nilaiTerendah ? $nilaiTerendah : '-' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <img src="../img/bg-nilai.png" alt="">
                    <div class="absolute top-5 left-16">
                        <div class="flex flex-col items-center gap-4">
                            <h1 class="font-bold text-xl text-white capitalize">nilai rata - rata
                            </h1>
                            <p class="font-semibold text-5xl text-white capitalize">
                                {{ $nilaiRataRata ? $nilaiRataRata : '-' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- garfik nilai -->
        <div class="relative mt-20">
            <img src="../img/bg-profil-grafik.png" class="w-full" alt="">
            <div class="absolute top-5 left-16 w-7xl">
                <div class="flex flex-col gap-4">
                    <h1 class="font-bold text-2xl text-white capitalize">grafik nilai per bab</h1>
                    <p class="font-normal text-xl text-white capitalize">
                        nilai(0-100)
                    </p>
                </div>
            </div>
            <div class="flex justify-center items-center mt-5">
                <div class="absolute bottom-16">
                    <div class="w-[83rem]">
                        <div class="bg-white rounded-lg p-5">
                            <h1 class="font-bold text-2xl lg:text-3xl text-black text-shadow-2xs">
                                Nilai Seiring Waktu
                                <i class="bi bi-bar-chart-fill"></i>
                            </h1>
                            <p class="mt-2">Pantau perkembangan nilai kamu setiap ujian!</p>
                            <div class="mt-5  p-4">
                                <livewire:components.chart />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
