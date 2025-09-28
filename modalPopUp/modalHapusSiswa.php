<!-- Modal hapus -->
<div id="modalHapus" class="fixed inset-0  hidden items-center justify-center z-50">
    <!-- Overlay -->
    <div id="overlayHapus" class="absolute inset-0 bg-black/50"></div>
    <!-- Konten Modal -->
    <div class="relative bg-white rounded-lg shadow-md p-6 z-10 w-80 md:w-96">
        <div class="flex flex-col mb-4 text-center">
            <h2 class="text-xl font-semibold capitalize">Hapus siswa</h2>
            <p class="font-normal text-gray-400 text-sm capitalize">hapus data siswa disini</p>
        </div>
        
        <form id="formHapus" class="flex flex-col gap-4">
            <input type="text" id="nama" name="nama" required 
                placeholder="Nama siswa"
                class="w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
            <input type="text" id="absen" name="absen" required 
                placeholder="Nomor Absen Siswa"
                class="w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
            
            <div class="flex justify-between gap-2 mt-4">
                <button type="button" id="btnCloseHapus" 
                        class="px-4 py-2 bg-red-500 text-white rounded-lg transition-all duration-150 hover:bg-red-600 hover:scale-105 active:scale-95">Batal</button>
                <button type="submit" 
                        class="px-4 py-2 bg-green-500 text-white rounded-lg transition-all duration-150 hover:bg-green-600 hover:scale-105 active:scale-95">hapus</button>
            </div>
        </form>
    </div>
</div>