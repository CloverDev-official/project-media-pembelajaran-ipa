<section class="flex flex-col gap-5 mt-10 min-h-screen">
    <livewire:components.guru.modal.modal-tambah-materi lazy />
    <livewire:components.guru.modal.modal-edit-materi lazy />
    <livewire:components.guru.modal.modal-hapus-materi lazy />

    <div class="bg-[radial-gradient(circle,#489BF9_0%,#1565C0_100%)] p-2 md:p-10 rounded-4xl min-h-screen">
        <!-- wrapper tambah -->
        <div class="flex justify-start mb-5">
            <!-- btn tambah -->
            <button wire:click="$dispatch('openTambahMateri')" id="btn-tambah"
                class="px-3 py-3 bg-yellow-300 justify-center flex items-center gap-1 rounded-xl text-black font-medium text-sm transition-all duration-100 shadow-sm capitalize hover:scale-105 active:scale-95">
                <iconify-icon icon="line-md:plus" class="text-sm"></iconify-icon>
                tambah materi
            </button>
        </div>
        <!-- mobile -->
        <div class="md:hidden grid grid-cols-2 lg:grid-cols-4 gap-2">
            <!-- template bab -->
            @foreach ($daftarBab as $bab)
                <!-- card materi -->
                <div class="flex justify-center items-center">
                    <div class="bg-white  p-2 rounded-lg w-36 shadow">
                        <!-- container gambar materi -->
                        <div class="flex justify-center">
                            <!-- gambar materi -->
                            <img src="{{ $bab->gambar ? asset('storage/' . $bab->gambar) : 'https://placehold.co/700x600?text=Gambar\nMateri' }}"
                                class="bg-gray-200 w-full h-32 rounded-lg border-0">
                        </div>
                        <!-- judul dan deskripsi materi -->
                        <div class="mb-3 py-2">
                            <h2 class="font-bold text-blue-500 text-sm capitalize">
                                {{ $bab->judul_bab }}
                            </h2>
                            <h3 class="font-bold text-blue-500 text-sm capitalize">
                                {{ $bab->deskripsi }}
                            </h3>
                        </div>
                        <!-- btn edit & hapus -->
                        <div class="flex flex-col items-center gap-2 mt-3 md:mt-0">
                            <!-- edit -->
                            <a>
                                <button
                                    wire:click="$dispatch('openEditMateri', { babId: '{{ $bab->id }}' })"
                                    class="w-full justify-center flex items-center gap-1 px-4 py-2 bg-yellow-300  rounded-lg text-black font-medium text-xs transition-all duration-100 shadow-sm capitalize hover:scale-105 active:scale-95">                                    
                                        edit Materi
                                </button>
                            </a>
                            <!-- hapus -->
                            <button
                                wire:click="$dispatch('openHapusMateri', { id: '{{ $bab->id }}' })"
                                class="w-full justify-center flex items-center gap-1 px-4 py-2 bg-red-400 rounded-lg text-black font-medium text-xs transition-all duration-100 shadow-sm capitalize hover:scale-105 active:scale-95">
                                <iconify-icon icon="line-md:trash" class="text-sm"></iconify-icon>
                                hapus materi
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- dekstop     -->
        <div class="hidden md:grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-5 w-full">
            @foreach ($daftarBab as $bab)
                <!-- card materi -->
                <div class="flex justify-start items-center">
                    <div class="bg-white p-2 rounded-lg min-w-[15rem] shadow">
                        <!-- container gambar materi -->
                        <div class="flex justify-center">
                            <!-- gambar materi -->
                            <img src="{{ $bab->gambar ? asset('storage/' . $bab->gambar) : 'https://placehold.co/700x600?text=Gambar\nMateri' }}"
                                class="bg-gray-200 w-full h-[12rem] rounded-lg border-0">
                        </div>
                        <!-- judul dan deskripsi materi -->
                        <div class="mb-3 py-2">
                            <h2 class="font-bold text-blue-500 capitalize">
                                {{ $bab->judul_bab }}
                            </h2>
                        </div>
                        <!-- btn edit & hapus -->
                        <div class="flex flex-col items-center gap-2 mt-3 md:mt-0">
                            <!-- edit -->
                            <a>
                                <button
                                    wire:click="$dispatch('openEditMateri', { babId: '{{ $bab->id }}' })"
                                    class="w-[14rem] justify-center flex items-center gap-1 px-4 py-2 bg-yellow-300  rounded-lg text-black font-medium text-sm transition-all duration-100 shadow-sm capitalize hover:scale-105 active:scale-95">
                                    <iconify-icon icon="line-md:edit"
                                        class="text-sm"></iconify-icon>
                                    edit Materi
                                </button>
                            </a>
                            <!-- hapus -->
                            <button
                                wire:click="$dispatch('openHapusMateri', { id: '{{ $bab->id }}' })"
                                class="w-[14rem] justify-center flex items-center gap-1 px-4 py-2 bg-red-400 rounded-lg text-black font-medium text-sm transition-all duration-100 shadow-sm capitalize hover:scale-105 active:scale-95">
                                <iconify-icon icon="line-md:trash" class="text-sm"></iconify-icon>
                                hapus materi
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
