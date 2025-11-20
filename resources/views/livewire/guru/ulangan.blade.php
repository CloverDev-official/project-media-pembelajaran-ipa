<section class="mt-10 flex flex-col justify-center md:justify-start min-h-screen">
    <livewire:components.guru.modal.modal-tambah-ulangan lazy />
    <livewire:components.guru.modal.modal-hapus-ulangan lazy />
    <livewire:components.guru.modal.modal-edit-ulangan lazy />

    <!-- wrapper btn tambah -->
    <div class="flex justify-start mb-5">
        <!-- btn tambah -->
        <button wire:click="$dispatch('openTambahUlangan')" id="btn-tambah"
            class="border-l-4 border-b-4 border-green-500 hover:border-green-600 active:scale-95  px-4 py-2 bg-green-400 hover:bg-green-500 rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md capitalize">
            tambah
        </button>
    </div>
    <div class="mt-4 flex justify-start">
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 justify-items-center mb-20">
            @foreach ($daftarUlangan as $ulangan)
                <div class="flex justify-center items-center">
                    <div
                        class="bg-white border border-l-4 border-b-4 border-gray-300 p-2 rounded-lg min-w-[15rem] shadow">
                        <!-- container gambar -->
                        <div class="flex justify-center">
                            <img src="{{ $ulangan->gambar ? asset('storage/' . $ulangan->gambar) : '' }}"
                                class="bg-gray-200 w-full h-[12rem] rounded-lg border-0">
                        </div>

                        <!-- judul dan deskripsi -->
                        <div class="mb-3 py-2">
                            <h2 class="font-bold text-main text-lg capitalize">{{ $ulangan->judul }}</h2>
                            <p class="font-normal text-xs capitalize">{{{ $ulangan->deskripsi }}}</p>
                        </div>

                        <!-- tombol -->

                        <button
                            wire:click="$dispatch('openEditUlangan', { id: {{ $ulangan->id }} })"
                            class="mt-2 py-1 font-semibold text-sm w-full rounded-lg transition-all duration-150 bg-yellow-400 hover:bg-yellow-500 active:scale-95 text-white capitalize">
                            edit
                        </button>

                        <button
                            wire:click="$dispatch('openHapusUlangan', { id: {{ $ulangan->id }} })"
                            class="btn-hapus mt-2 py-1 font-semibold text-sm w-full rounded-lg transition-all duration-150 bg-red-500 hover:bg-red-600 active:scale-95 text-white capitalize">
                            hapus
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
</section>
