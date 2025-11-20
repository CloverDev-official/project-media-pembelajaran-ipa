<!-- Modal Tambah -->
<div x-data="{ open: @entangle('showModal').live }" x-show="open" id="modalTambah"
    class="fixed inset-0 z-50 flex items-center justify-center">
    <!-- Overlay -->
    <div @click="open = false" id="overlayTambah" class="absolute inset-0 bg-black/50"></div>

    <!-- Konten Modal -->
    <div class="relative z-10 bg-white rounded-xl shadow-lg w-[90%] max-w-3xl flex flex-col">
        <!-- Header -->
        <div class="p-6 border-b text-center">
            <h2 class="text-2xl font-semibold capitalize">Latihan</h2>
            <p class="text-gray-500 text-sm capitalize">Latihan baru di sini</p>
        </div>

        <!-- FORM MULAI -->
        <form id="formTambah" wire:submit.prevent="save" class="flex flex-col flex-1">
            <!-- Bagian scrollable -->
            <div class="overflow-y-auto p-6 flex-1 max-h-[70vh]">
                <div class="grid grid-cols-1 gap-6">

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
