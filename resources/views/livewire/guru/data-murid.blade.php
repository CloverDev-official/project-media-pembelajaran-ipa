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
            class="border-l-4 border-b-4 border-green-500 hover:border-green-600 active:scale-95  px-4 py-2 bg-green-400 hover:bg-blue-500 rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md capitalize">
            tambah kelas
        </button>

        <button wire:click="$dispatch('openHapusKelas')" id="btn-hapus"
            class="border-l-4 border-b-4 border-red-500 hover:border-red-600 active:scale-95  px-4 py-2 bg-red-400 hover:bg-red-500 rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md capitalize">
            hapus kelas
        </button>
    </div>

    @foreach ($daftarKelas as $kelas)
        <div class=" bg-white border border-gray-300 p-4 rounded-md shadow-lg mt-5">
            <!-- header table siswa-->
            <div class="flex justify-between gap-1 items-center md:items-start my-4 px-2">
                <h1 class=" font-semibold text-lg md:text-xl">Kelas
                    {{ strtoupper($kelas->nama_kelas) }}</h1>
                <!-- button CRUD -->
                <div class="flex gap-2 md:gap-4 mb-4 mt-4 md:mt-0">
                    <!-- btn tambah -->
                    <button wire:click="$dispatch('openTambahMurid', { id: '{{ $kelas->id }}' })"
                        id="btn-tambah"
                        class="text-sm border-l-4 border-b-4 border-green-500  active:border-0  px-4 py-2 bg-green-400  rounded-lg text-white text-shadow-md font-semibold transition-all duration-150 shadow-md capitalize hover:scale-105 active:scale-95">
                        tambah
                    </button>

                </div>
            </div>
            <!-- tabel siswa -->
            <div class="rounded-lg border overflow-hidden overflow-x-scroll shadow-lg">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-blue-500 text-white text-center">
                            <th class="border-r border-black px-4 py-2  capitalize">no</th>
                            <th class="border-r border-black px-4 py-2  capitalize">nama siswa
                            </th>
                            <th class="border-r border-black px-4 py-2  capitalize">kelas</th>
                            <th class=" px-4 py-2  capitalize">opsi</th>
                        </tr>
                    </thead>

                    <tbody class="text-center">
                        @foreach ($kelas->murid as $murid)
                            <tr class="bg-white hover:bg-gray-200">
                                <td class="border-t border-r px-4 py-2">
                                    {{ $murid->absen }}</td>
                                <td class="border-t border-r px-4 py-2 capitalize">
                                    {{ $murid->nama }}
                                </td>
                                <td class="border-t border-r  px-4 py-2 uppercase">
                                    {{ $kelas->nama_kelas }}
                                </td>
                                <td class="border-t  px-4 flex justify-center gap-4 py-2 uppercase">
                                    <!-- btn edit -->
                                    <button
                                        wire:click="$dispatch('openEditMurid', { muridId: {{ $murid->id }} } )"
                                        class="btn-edit text-sm px-4 py-2 bg-yellow-400 rounded-lg text-white font-semibold transition-all duration-150 shadow capitalize hover:scale-105 active:scale-95">
                                        edit
                                    </button>

                                    <!-- hapus -->
                                    <button
                                        wire:click="$dispatch('openHapusMurid', { muridId: {{ $murid->id }}} )"
                                        class="btn-hapus text-sm px-4 py-2 bg-red-500  rounded-lg text-white  font-semibold transition-all duration-150 shadow capitalize hover:scale-105 active:scale-95">
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
