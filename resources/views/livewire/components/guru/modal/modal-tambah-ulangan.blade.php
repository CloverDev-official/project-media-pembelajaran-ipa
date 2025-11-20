<!-- Modal Tambah -->
<div x-data="{ open: @entangle('showModal').live }" x-show="open" id="modalTambah"
    class="fixed inset-0 z-50 flex items-center justify-center">
    <!-- Overlay -->
    <div @click="open = false" id="overlayTambah" class="absolute inset-0 bg-black/50"></div>

    <!-- Konten Modal -->
    <div class="relative z-10 bg-white rounded-xl shadow-lg w-[90%] max-w-3xl flex flex-col">
        <!-- Header -->
        <div class="p-6 border-b text-center">
            <h2 class="text-2xl font-semibold capitalize">Tambah Ulangan</h2>
            <p class="text-gray-500 text-sm capitalize">Tambahkan ulangan baru di sini</p>
        </div>

        <!-- FORM MULAI -->
        <form id="formTambah" wire:submit.prevent="save" class="flex flex-col flex-1">
            <!-- Bagian scrollable -->
            <div class="overflow-y-auto p-6 flex-1 max-h-[70vh]">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Judul -->
                    <div class="md:col-span-2">
                        <label for="judul" class="font-semibold text-lg capitalize">Judul</label>
                        <input type="text" id="judul" wire:model.defer="judul" required
                            placeholder="Judul ulangan"
                            class="w-full mt-2 py-3 px-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>

                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                        <label for="deskripsi"
                            class="font-semibold text-lg capitalize">Deskripsi</label>
                        <textarea id="deskripsi" wire:model.defer="deskripsi" rows="3"
                            placeholder="Deskripsi (opsional)"
                            class="w-full mt-2 py-3 px-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                    </div>

                    <!-- Gambar Soal -->
                    <div class="md:col-span-2">
                        <label for="gambar" class="font-semibold text-lg capitalize">Gambar Soal
                            (opsional)</label>
                        <input type="file" id="gambar" wire:model="gambar" accept="image/*"
                            class="w-full mt-2 py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">

                        <!-- Status Upload -->
                        <div wire:loading wire:target="gambar"
                            class="mt-2 text-blue-500 text-sm animate-pulse">
                            Mengunggah gambar...
                        </div>

                        <!-- Preview Gambar -->
                        {{-- @if ($gambar)
                            <div class="mt-3">
                                <p class="text-sm text-gray-500 mb-1">Pratinjau Gambar:</p>
                                <img src="{{ $gambar->temporaryUrl() }}"
                                    class="w-full max-h-60 object-contain rounded-lg border">
                            </div>
                        @endif --}}

                        <p class="text-sm text-gray-500 mt-2">Format: JPG, PNG, atau GIF (maks. 5MB)
                        </p>
                    </div>

                    <!-- Waktu Pengerjaan -->
                    <div>
                        <label for="waktu_pengerjaan" class="font-semibold text-lg capitalize">
                            Waktu Pengerjaan (menit)
                        </label>
                        <input type="number" id="waktu_pengerjaan"
                            wire:model.defer="waktuPengerjaan" placeholder="Masukkan durasi (menit)"
                            min="1"
                            class="w-full mt-2 py-3 px-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                            oninput="this.value = this.value < 1 ? 1 : this.value">
                    </div>

                    <!-- Jumlah Soal -->
                    <div>
                        <label for="jumlah_soal" class="font-semibold text-lg capitalize">Jumlah
                            Soal</label>
                        <input type="number" id="jumlah_soal" wire:model.defer="jumlahSoal"
                            placeholder="Jumlah soal" min="1"
                            class="w-full mt-2 py-3 px-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                            oninput="this.value = this.value < 1 ? 1 : this.value">
                    </div>

                    <!-- Kelas -->
                    <div class="md:col-span-2">
                        <label for="kelas" class="font-semibold text-lg capitalize">Kelas</label>
                        <select id="kelas" wire:model.defer="kelasId"
                            class="w-full mt-2 py-3 px-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @forelse ($daftarKelas as $kelas)
                                <option value="{{ $kelas->id }}">Kelas {{ $kelas->nama_kelas }}
                                </option>
                            @empty
                                <option value="" disabled>Tidak ada kelas tersedia</option>
                            @endforelse
                        </select>
                    </div>

                    <!-- Waktu Dibuka -->
                    <div>
                        <label for="waktu_dibuka" class="font-semibold text-lg capitalize">Waktu
                            Dibuka</label>
                        <input type="datetime-local" id="waktu_dibuka"
                            wire:model.defer="waktuDibuka"
                            class="w-full mt-2 py-3 px-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>

                    <!-- Waktu Ditutup -->
                    <div>
                        <label for="waktu_ditutup" class="font-semibold text-lg capitalize">Waktu
                            Ditutup</label>
                        <input type="datetime-local" id="waktu_ditutup"
                            wire:model.defer="waktuDitutup"
                            class="w-full mt-2 py-3 px-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="p-6 border-t flex justify-end gap-3">
                <button type="button" id="btnCloseTambah" @click="open = false"
                    class="px-5 py-2 bg-red-500 text-white rounded-lg transition-all duration-150 hover:bg-red-600 hover:scale-105 active:scale-95">
                    Batal
                </button>
                <button type="submit"
                    class="px-5 py-2 bg-green-500 text-white rounded-lg transition-all duration-150 hover:bg-green-600 hover:scale-105 active:scale-95">
                    Simpan
                </button>
            </div>
        </form>
        <!-- FORM SELESAI -->
    </div>
</div>
