<section class="min-h-screen mt-10">
    <livewire:components.guru.modal.modal-tambah-murid lazy />
    <livewire:components.guru.modal.modal-edit-murid lazy />
    <livewire:components.guru.modal.modal-hapus-murid lazy />
    <livewire:components.guru.modal.modal-tambah-kelas lazy />
    <livewire:components.guru.modal.modal-hapus-kelas lazy />

    <!-- wrapper btn tambah -->
    <div class="flex justify-start mb-5 gap-3">
        <!-- btn tambah -->
        <button wire:click="$dispatch('openTambahKelas')" id="btn-tambah"
            class="flex items-center gap-1 px-3 py-3 bg-green-200 rounded-xl text-green-700 font-medium text-sm transition-all duration-100 shadow-sm hover:bg-green-300 capitalize hover:scale-105 active:scale-95">
            <iconify-icon icon="line-md:plus" class="text-sm"></iconify-icon>
            tambah kelas
        </button>

        <button wire:click="$dispatch('openHapusKelas')" id="btn-hapus"
            class="flex items-center gap-1 px-3 py-3 bg-red-200 rounded-xl text-red-700 font-medium text-sm transition-all duration-100 shadow-sm hover:bg-red-300 capitalize hover:scale-105 active:scale-95">
            <iconify-icon icon="line-md:trash" class="text-sm"></iconify-icon>
            hapus kelas
        </button>
    </div>

    @foreach ($daftarKelas as $kelas)
        <div class=" bg-white border p-4 rounded-md shadow-lg mt-5">
            <!-- header table siswa-->
            <div class="flex justify-between gap-1 items-center md:items-start my-4 px-2">
                <h1 class=" font-semibold text-lg md:text-xl">Kelas
                    {{ strtoupper($kelas->nama_kelas) }}</h1>
                <!-- button CRUD -->
                <div class="flex gap-2 md:gap-4 mb-4 mt-4 md:mt-0">
                    <!-- btn tambah -->
                    <button wire:click="$dispatch('openTambahMurid', { id: '{{ $kelas->id }}' })"
                        id="btn-tambah"
                        class="flex items-center gap-1 px-3 py-3 bg-green-200 rounded-xl text-green-700 font-medium text-sm transition-all duration-100 shadow-sm capitalize hover:bg-green-300 hover:scale-105 active:scale-95">
                        <iconify-icon icon="line-md:plus" class="text-sm"></iconify-icon>
                        tambah murid
                    </button>

                </div>
            </div>

            <!-- tabel siswa -->
            <div class="rounded-lg border border-black overflow-x-auto shadow-lg">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-yellow-300 text-center">
                            <th class="border-r border-black px-4 py-2 font-medium  capitalize">no
                            </th>
                            <th class="border-r border-black px-4 py-2 font-medium  capitalize">nama
                                siswa
                            </th>
                            <th class="border-r border-black px-4 py-2 font-medium  capitalize">
                                kelas</th>
                            <th class=" px-4 py-2 font-medium  capitalize">opsi</th>
                        </tr>
                    </thead>

                    <tbody class="text-center">
                        @foreach ($kelas->murid as $murid)
                            <tr class="bg-white">
                                <td class="border-t border-r border-black px-4 py-2">
                                    {{ $murid->absen }}</td>
                                <td class="border-t border-r border-black px-4 py-2 capitalize">
                                    {{ $murid->nama }}
                                </td>
                                <td class="border-t border-r border-black  px-4 py-2 uppercase">
                                    {{ $kelas->nama_kelas }}
                                </td>
                                <td
                                    class="border-t border-black  px-4 flex justify-center gap-4 py-2 uppercase">
                                    <!-- btn edit -->
                                    <button
                                        wire:click="$dispatch('openEditMurid', { muridId: {{ $murid->id }} } )"
                                        class="flex items-center gap-1 px-4 py-2 bg-yellow-200 rounded-lg text-yellow-700 font-medium text-sm transition-all duration-100 shadow-sm capitalize hover:bg-yellow-300 hover:scale-105 active:scale-95">
                                        <iconify-icon icon="line-md:edit"
                                            class="text-sm"></iconify-icon>
                                        edit
                                    </button>

                                    <!-- hapus -->
                                    <button
                                        wire:click="$dispatch('openHapusMurid', { muridId: {{ $murid->id }}} )"
                                        class="flex items-center gap-1 px-4 py-2 bg-red-200 rounded-lg text-red-700 font-medium text-sm transition-all duration-100 shadow-sm capitalize hover:bg-red-300 hover:scale-105 active:scale-95">
                                        <iconify-icon icon="line-md:trash"
                                            class="text-sm"></iconify-icon>
                                        hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</section>
