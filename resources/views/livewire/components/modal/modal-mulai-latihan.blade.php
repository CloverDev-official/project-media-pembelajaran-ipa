<div x-data="{ open: @entangle('showModal').live }" x-show="open" id="startModal"
    class="fixed inset-0 flex items-center justify-center z-50">

    <div @click="open = false" id="overlayHapus" class="absolute inset-0 bg-black/50"></div>

    <div class="bg-white w-full max-w-sm rounded-lg shadow-lg p-6 text-center relative">
        <h2 class="text-lg sm:text-xl font-bold mb-3 text-blue-600">
            <i class="bi bi-play-circle-fill"></i> Siap Memulai?
        </h2>
        <p class="text-gray-700 mb-4 text-sm sm:text-base">
            Latihan ini terdiri dari beberapa soal pilihan ganda. Waktu pengerjaan
            10 menit.
        </p>
        <div class="flex justify-center gap-3">
            <button id="cancelStartBtn"
                class="flex items-center gap-1 px-6 py-2 bg-red-200 text-red-700 rounded-lg transition-all duration-150 hover:bg-red-300 hover:scale-105 active:scale-95">
                    <iconify-icon icon="line-md:close-small"></iconify-icon>
                    Batal
            </button>
            <button wire:click="$dispatch('mulaiLatihan')" id="confirmStartBtn"
                class="flex items-center gap-1 px-4 py-2 bg-green-200 text-green-700 rounded-lg transition-all duration-150 hover:bg-green-300 hover:scale-105 active:scale-95">
                    <iconify-icon icon="line-md:confirm" class="text-sm"></iconify-icon>
                    Mulai
            </button>
        </div>
    </div>
</div>
