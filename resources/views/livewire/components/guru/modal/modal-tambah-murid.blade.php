<!-- Modal Tambah -->
<div x-data="{ open: @entangle('showModal').live }" x-show="open"
    class="fixed flex inset-0 items-center justify-center z-50">
    <!-- Overlay -->
    <div @click="open = false" id="overlayTambah" class="absolute inset-0 bg-black/50"></div>
    <!-- Konten Modal -->
    <div class="relative bg-white rounded-lg shadow-md p-6 z-10 w-80 md:w-96">
        <div class="flex flex-col mb-4 text-center">
            <h2 class="text-xl font-semibold capitalize">tambah siswa</h2>
            <p class="font-normal text-gray-400 text-sm capitalize">tambahkan siswa baru disini</p>
        </div>
        <div class ></div>
        <form id="formTambah" class="flex flex-col gap-4" wire:submit.prevent="save">
            <input type="text" id="NIPD" wire:model.defer="nipd" required
                placeholder="NIPD siswa"
                class="w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-700">
            <input type="text" id="nama" wire:model.defer="nama" required
                placeholder="Nama siswa"
                class="w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-700">
            <input type="number" min="1" id="absen" wire:model.defer="absen" required
                placeholder="Nomor Absen Siswa" 
                class="w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-700">

            <div class="flex justify-between gap-2 mt-4">
                <button wire:click="close" type="button" id="btnCloseTambah"
                    class="flex items-center gap-1 px-4 py-2 bg-red-200 text-red-700 rounded-lg transition-all duration-150 hover:bg-red-300 hover:scale-105 active:scale-95">
                        <iconify-icon icon="line-md:close-small"></iconify-icon>
                        Batal
                </button>
                <button type="submit"
                    class="flex items-center gap-1 px-4 py-2 bg-green-200 text-green-700 rounded-lg transition-all duration-150 hover:bg-green-300 hover:scale-105 active:scale-95">
                        <iconify-icon icon="line-md:confirm" class="text-sm"></iconify-icon>
                        Simpan
                </button>
            </div>
        </form>
    </div> 
</div>
