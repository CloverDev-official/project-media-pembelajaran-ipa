<section class="flex flex-col gap-5 mt-4 min-h-screen">
    <livewire:components.guru.modal.modal-tambah-materi lazy />
    <livewire:components.guru.modal.modal-hapus-materi lazy />

    <div class="flex justify-end">
        <!-- btn tambah -->
        <button wire:click="$dispatch('openTambahMateri')" id="btn-tambah"
            class="border-l-4 border-b-4 border-green-500 hover:border-green-600 active:scale-95  px-4 py-2 bg-green-400 hover:bg-green-500 rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md capitalize">
            tambah
        </button>
    </div>
    @foreach ($daftarBab as $bab)
        <div
            class="bg-white border-1  border-main shadow-md p-4 rounded-xl flex flex-col md:flex-row justify-between items-center gap-5 transition-all duration-300 hover:shadow-lg hover:scale-[1.01] md:w-full">
            <!-- judul -->
            <div class="flex items-center gap-5 w-full md:w-auto">
                <div class="bg-main rounded-lg w-14 h-14 flex items-center justify-center">
                    <span class="text-white font-bold text-2xl text-shadow-lg"><i
                            class="fa fa-book"></i></span>
                </div>
                <h1 class="font-semibold text-lg">{{ $bab->judul_bab }}</h1>
            </div>

            <!-- btn edit & hapus -->
            <div class="flex items-center gap-5 mt-3 md:mt-0">
                <!-- edit -->
                <a href="form/bab/{{ $bab->id }}">
                    <button
                        class="border-l-4 border-b-4 border-yellow-500 hover:border-yellow-600 active:border-0  px-4 py-2 bg-yellow-400 hover:bg-yellow-500 rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md capitalize">
                        edit
                    </button>
                </a>
                <!-- hapus -->
                <button wire:click="$dispatch('openHapusMateri', { id: '{{ $bab->id }}' })"
                    class="btn-hapus border-l-4 border-b-4 border-red-500 hover:border-red-600 active:border-0  px-4 py-2 bg-red-400 hover:bg-red-500 rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md capitalize">
                    hapus
                </button>
            </div>
        </div>
    @endforeach

</section>
