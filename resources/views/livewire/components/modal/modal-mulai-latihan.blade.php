<div x-data="{ open: @entangle('showModal').live }" x-show="open" id="startModal"
    class="fixed inset-0 flex items-center justify-center z-50">

    <div @click="open = false" id="overlayHapus" class="absolute inset-0 bg-black/50"></div>

    <div class="bg-white w-full max-w-sm rounded-lg shadow-lg p-6 text-center relative">
        <h2 class="text-lg sm:text-xl font-bold mb-3 text-green-600">
            <i class="bi bi-play-circle-fill"></i> Siap Memulai?
        </h2>
        <p class="text-gray-700 mb-4 text-sm sm:text-base">
            Latihan ini terdiri dari beberapa soal pilihan ganda. Waktu pengerjaan
            10 menit.
        </p>
        <div class="flex justify-center gap-3">
            <button id="cancelStartBtn"
                class="px-6 py-2 border-l-[4px] border-b-[4px] bg-linear-to-t from-red-600 to-red-500 border-red-700 text-white rounded-lg transition-all active:border-0 hover:scale-105">
                Batal
            </button>
            <button id="confirmStartBtn"
                class="px-6 py-2 border-l-[4px] border-b-[4px] bg-linear-to-t from-green-600 to-green-500 border-green-700 text-white rounded-lg transition-all active:border-0 hover:scale-105">
                Mulai
            </button>
        </div>
    </div>
</div>
