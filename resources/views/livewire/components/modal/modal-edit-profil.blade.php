<!-- overlay -->
<div 
    class="fixed inset-0 bg-black/50 flex justify-center items-center z-50 transition-opacity duration-300" 
    x-data="{ open: @entangle('showModalEditProfil').live }"
    x-show="open" 
    @click.outside="open = false"
    @click.self="open = false"
    x-transition.opacity
>
    <!-- container modal -->
    <div 
        class="relative bg-white rounded-2xl shadow-2xl px-8 py-10 w-full md:max-w-lg text-center transform transition-all duration-300 scale-95"
        x-transition.scale
    >
        <!-- tombol close -->
        <button 
            @click="open = false"
            class="absolute top-3 right-3 text-gray-400 hover:text-red-500 transition"
            type="button"
        >
            <iconify-icon icon="ph:x-circle-fill" class="text-3xl"></iconify-icon>
        </button>

        <!-- judul -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Ganti Foto Profil</h2>

        <!-- preview -->
        <div class="flex justify-center mb-5">
            <div class="relative">
                <img 
                    id="previewImage" 
                    src="../assets/img/logo.png" 
                    alt="Preview" 
                    class="w-32 h-32 rounded-full object-cover border-4 border-indigo-200 shadow-md"
                >
            </div>
        </div>

        <!-- input file -->
        <label for="imageInput" class="block mb-4 cursor-pointer">
            <input 
                type="file" 
                id="imageInput" 
                accept="image/*" 
                class="hidden"
            >
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 bg-gray-50 hover:bg-gray-100 transition">
                <p class="text-sm text-gray-600">Klik untuk memilih foto dari galeri</p>
            </div>
        </label>

        <!-- tombol hapus -->
        <button 
            type="button"
            class="w-full bg-red-600 hover:bg-red-700 text-white text-lg py-3 rounded-lg shadow-md flex justify-center items-center gap-2 mt-3 transition"
        >
            <iconify-icon icon="mdi:trash-can-outline"></iconify-icon>
            <span>Hapus Foto</span>
        </button>
    </div>
</div>