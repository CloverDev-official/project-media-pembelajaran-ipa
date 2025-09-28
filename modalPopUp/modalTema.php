<!-- Modal Tema -->
        <div id="modalTema" class="hidden fixed inset-0 bg-black/50  bg-opacity-40 flex items-center justify-center transition-opacity duration-300 z-50">
            <div class="bg-white rounded-xl shadow-lg w-80 p-6">
                <h2 class="text-lg font-bold mb-4">Pilih Tema</h2>
                <div class="flex flex-col gap-3">
                    <!-- HIJAU (DEFAULT) -->
                    <button id="btnTemaDefault" class="px-4 py-2 rounded-lg border flex items-center gap-2 hover:bg-green-100 text-green-600">
                        <span class="w-4 h-4 rounded-full bg-green-500"></span> Hijau
                    </button>
                    <!-- PINK -->
                    <button id="btnTemaPink" class="px-4 py-2 rounded-lg border flex items-center gap-2 hover:bg-pink-100 text-pink-600">
                        <span class="w-4 h-4 rounded-full bg-pink-500"></span> Pink
                    </button>
                    <!-- BLUE -->
                    <button id="btnTemaBlue" class="px-4 py-2 rounded-lg border flex items-center gap-2 hover:bg-blue-100 text-blue-600">
                        <span class="w-4 h-4 rounded-full bg-blue-500"></span> Biru
                    </button>
                </div>
                <div class="mt-5 flex justify-end">
                    <button id="closeTema" class="px-4 py-2 text-gray-600 hover:text-black transition-all duration-150 hover:scale-105 active:scale-95">Tutup</button>
                </div>
            </div>
        </div>