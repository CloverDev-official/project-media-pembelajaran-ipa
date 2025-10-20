<!-- Modal Tambah -->
<div id="modalTambah" class="fixed inset-0  hidden items-center justify-center z-50">
    <!-- Overlay -->
    <div id="overlayTambah" class="absolute inset-0 bg-black/50"></div>
    <!-- Konten Modal -->
    <div class="relative bg-white rounded-lg shadow-md p-6 z-10 w-80 md:w-96">
        <!-- judul modal -->
        <div class="flex flex-col mb-4 text-center">
            <h2 class="text-xl font-semibold capitalize">tambah ulangan</h2>
            <p class="font-normal text-gray-400 text-sm capitalize">tambahkan ulangan baru disini</p>
        </div>
        
        <!-- form -->
        <form id="formTambah" class="flex flex-col gap-4">
            <div class="flex flex-col gap-4">
                <!-- judul -->
                <div>
                    <label for="judul" class="font-semibold text-lg capitalize">judul</label>
                    <input type="text" id="judul" name="judul" required 
                        placeholder="Judul ulangan"
                        class="w-full mt-2 py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <!-- deksripsi (opsional)  -->
                <div>
                    <label for="deskripsi" class="font-semibold text-lg capitalize">deskripsi</label>
                    <input type="text" id="deskripsi" name="deskripsi"  
                        placeholder="Deskripsi (opsional)"
                        class="w-full mt-2 py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>
            <div class="flex justify-between gap-2 mt-4">
                <button type="button" id="btnCloseTambah" 
                        class="px-4 py-2 bg-red-500 text-white rounded-lg transition-all duration-150 hover:bg-red-600 hover:scale-105 active:scale-95">Batal</button>
                <button type="submit" 
                        class="px-4 py-2 bg-green-500 text-white rounded-lg transition-all duration-150 hover:bg-green-600 hover:scale-105 active:scale-95">Simpan</button>
            </div>
        </form>
    </div>
</div>