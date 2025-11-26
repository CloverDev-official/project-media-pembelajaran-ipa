<!-- Modal Edit -->
<div x-data="{ open: @entangle('showModal').live }" x-show="open"
    class="fixed inset-0 flex items-center justify-center z-50">
    <!-- Overlay -->
    <div @click="open = false" id="overlayEdit" class="absolute inset-0 bg-black/50"></div>
    <!-- Konten Modal -->
    <div class="relative bg-white rounded-lg shadow-md p-6 z-10 w-80 md:w-96">
        <div class="flex flex-col mb-4 text-center">
            <h2 class="text-xl font-semibold capitalize">Edit siswa</h2>
            <p class="font-normal text-gray-400 text-sm capitalize">edit data siswa disini</p>
        </div>

        <form id="formEdit" class="flex flex-col gap-4" wire:submit.prevent="update">
            <input type="text" id="nipd" wire:model.defer="nipd" required
                placeholder="NIPD siswa"
                class="w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
            <input type="text" id="nama" wire:model.defer="nama" required
                placeholder="Nama siswa"
                class="w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
            <input type="text" id="absen" wire:model.defer="absen" required
                placeholder="Nomor Absen Siswa"
                class="w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">

            <div class="flex justify-between gap-2 mt-4">
                <button type="button" id="btnCloseEdit" wire:click="close"
                    class="px-4 py-2 bg-red-500 text-white rounded-lg transition-all duration-150 hover:bg-red-600 hover:scale-105 active:scale-95">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-green-500 text-white rounded-lg transition-all duration-150 hover:bg-green-600 hover:scale-105 active:scale-95">Simpan</button>
            </div>
        </form>
    </div>
</div>
