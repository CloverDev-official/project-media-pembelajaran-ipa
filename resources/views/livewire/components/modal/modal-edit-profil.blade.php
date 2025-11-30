<!-- overlay -->
<div class="fixed inset-0 bg-black/50 flex justify-center items-center z-50 transition-opacity duration-300"
    x-data="{ open: @entangle('showModal').live }" x-show="open" @click.outside="open = false" @click.self="open = false"
    x-transition.opacity>
    <!-- container modal -->
    <div class="relative bg-white rounded-2xl shadow-2xl px-8 py-10 w-full md:max-w-lg text-center transform transition-all duration-300 scale-95"
        x-transition.scale>
        <!-- tombol close -->
        <button @click="open = false"
            class="absolute top-3 right-3 text-gray-400 hover:text-red-500 transition" type="button">
            <iconify-icon icon="ph:x-circle-fill" class="text-3xl"></iconify-icon>
        </button>

        <!-- judul -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Ganti Foto Profil</h2>

        <!-- preview -->
        <div class="flex justify-center mb-5">
            <div class="relative w-32 h-32">

                <div wire:loading wire:target="gambar"
                    class="absolute inset-0 flex items-center justify-center bg-gray-100/80 rounded-full z-20">
                    <svg class="animate-spin h-8 w-8 text-indigo-600"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10"
                            stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </div>

                @if ($gambar instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                    <img src="{{ $gambar->temporaryUrl() }}"
                        class="w-32 h-32 rounded-full object-cover border-4 border-indigo-200 shadow-md">
                @elseif ($gambar)
                    <img src="{{ asset('storage/' . $gambar) }}"
                        class="w-32 h-32 rounded-full object-cover border-4 border-indigo-200 shadow-md">
                @else
                    <img src="https://placehold.co/300x200?text=Gambar+Profil"
                        class="w-32 h-32 rounded-full object-cover border-4 border-indigo-200 shadow-md">
                @endif
            </div>
        </div>

        <!-- input file -->
        <label for="imageInput" class="block mb-4 cursor-pointer">
            <input type="file" id="imageInput" accept="image/*" class="hidden"
                wire:model="gambar">
            <div
                class="border-2 border-dashed border-gray-300 rounded-lg p-4 bg-gray-50 hover:bg-gray-100 transition">
                <p class="text-sm text-gray-600">Klik untuk memilih foto dari galeri</p>
            </div>
        </label>

        <!-- tombol hapus -->
        <button wire:click="hapusGambar" type="button"
            class="w-full bg-red-600 hover:bg-red-700 text-white text-lg py-3 rounded-lg shadow-md flex justify-center items-center gap-2 mt-3 transition">
            <iconify-icon icon="mdi:trash-can-outline"></iconify-icon>
            <span>Hapus Foto</span>
        </button>

        <!-- tombol simpan -->
        <button wire:click="uploadGambar" type="button"
            class="w-full bg-green-600 hover:bg-green-700 text-white text-lg py-3 rounded-lg shadow-md flex justify-center items-center gap-2 mt-3 transition">
            <iconify-icon icon="mdi:content-save-outline"></iconify-icon>
            <span>Simpan Foto</span>
        </button>
    </div>
</div>
