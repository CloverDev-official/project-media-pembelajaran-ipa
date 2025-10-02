<!-- Popup Tema -->
<div id="popupTema" class="fixed inset-0 bg-black/40 flex items-center justify-center opacity-0 scale-95 pointer-events-none transition-all duration-200 z-50">
    <div id="modalTema" class="bg-white shadow-lg rounded-xl w-80 md:w-96 pb-10">
        <!-- Header -->
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-400">
            <h2 class="text-lg font-semibold capitalize">Menu Tema</h2>
            <button id="closeTema" class="text-gray-500 hover:text-black hover:scale-105 active:scale-95">✕</button>
        </div>

        <!-- Tabs Filter -->
        <div class="flex gap-2 px-4 py-2 border-b border-gray-400 text-sm">
            <button data-filter="tema" class="tabTema px-3 py-1 rounded-full bg-gray-200 font-medium capitalize">Tema</button>
        </div>

        <!-- List Tema -->
        <div class="tema-item cursor-pointer" data-group="tema">
            <div class="flex flex-col">
                <!-- Hijau -->
                <button id="btnTemaDefault" class="px-4 py-3 flex items-center gap-3 hover:bg-green-50 border-b border-gray-100 text-green-600">
                    <div class="w-6 h-6 rounded-full bg-green-500"></div>
                    <span class="font-medium">Hijau</span>
                </button>
                <!-- Pink -->
                <button id="btnTemaPink" class="px-4 py-3 flex items-center gap-3 hover:bg-pink-50 border-b border-gray-100 text-pink-600">
                    <div class="w-6 h-6 rounded-full bg-pink-500"></div>
                    <span class="font-medium">Pink</span>
                </button>
                <!-- Biru -->
                <button id="btnTemaBlue" class="px-4 py-3 flex items-center gap-3 hover:bg-blue-50 border-b border-gray-100 text-blue-600">
                    <div class="w-6 h-6 rounded-full bg-blue-500"></div>
                    <span class="font-medium">Biru</span>
                </button>
            </div>
        </div>
    </div>
</div>
