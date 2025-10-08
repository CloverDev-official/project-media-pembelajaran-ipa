 <!-- Modal hapus -->
<div id="modalHapus" class="fixed inset-0  hidden items-center justify-center z-50">
    <!-- Overlay -->
    <div id="overlayHapus" class="absolute inset-0 bg-black/50"></div>
    <!-- Konten Modal -->
    <div class="relative bg-white rounded-lg shadow-md p-6 z-10 w-80 md:w-96">
        <div class="flex flex-col mb-4 text-start">
            <h2 class="text-xl font-semibold capitalize">peringatan</h2>
            <p class="font-normal text-gray-400 text-sm capitalize">apakah anda yakin ingin menghapus data siswa ini?</p>
        </div>
        
        <form id="formHapus" class="flex flex-col gap-4">
            <div class="flex justify-between gap-2 mt-4">
                <button type="button" id="btnCloseHapus" 
                        class="px-4 py-2 bg-red-500 text-white rounded-lg transition-all duration-150 hover:bg-red-600 hover:scale-105 active:scale-95">Batal</button>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg transition-all duration-150 hover:bg-green-600 hover:scale-105 active:scale-95">hapus</button>
            </div>
        </form>
    </div>
</div>