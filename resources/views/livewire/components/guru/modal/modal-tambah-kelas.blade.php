<!-- Modal Tambah -->
<div x-data="{ open: @entangle('showModal').live }" x-show="open"
    class="fixed flex inset-0 items-center justify-center z-50">
    <!-- Overlay -->
    <div @click="open = false" id="overlayTambah" class="absolute inset-0 bg-black/50"></div>
    <!-- Konten Modal -->
    <div class="relative bg-white rounded-lg shadow-md p-6 z-10 w-80 md:w-96">
        <div class="flex flex-col mb-4 text-center">
            <h2 class="text-xl font-semibold capitalize">tambah kelas</h2>
            <p class="font-normal text-gray-400 text-sm capitalize">tambahkan kelas baru disini</p>
        </div>

        <form id="formTambah" class="flex flex-col gap-4" wire:submit.prevent="save">
            <select id="namaKelas" wire:model.defer="namaKelas" required
                class="w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                <option value="">Pilih Kelas</option>

                <!-- Kelas 7 -->
                <optgroup label="Kelas 7">
                    <option value="7A">7A</option>
                    <option value="7B">7B</option>
                    <option value="7C">7C</option>
                    <option value="7D">7D</option>
                    <option value="7E">7E</option>
                    <option value="7F">7F</option>
                    <option value="7G">7G</option>
                </optgroup>

                <!-- Kelas 8 -->
                <optgroup label="Kelas 8">
                    <option value="8A">8A</option>
                    <option value="8B">8B</option>
                    <option value="8C">8C</option>
                    <option value="8D">8D</option>
                    <option value="8E">8E</option>
                    <option value="8F">8F</option>
                    <option value="8G">8G</option>
                </optgroup>

                <!-- Kelas 9 -->
                <optgroup label="Kelas 9">
                    <option value="9A">9A</option>
                    <option value="9B">9B</option>
                    <option value="9C">9C</option>
                    <option value="9D">9D</option>
                    <option value="9E">9E</option>
                    <option value="9F">9F</option>
                    <option value="9G">9G</option>
                </optgroup>
            </select>
            <div class="flex justify-between gap-2 mt-4">
                <button wire:click="close" type="button" id="btnCloseTambah"
                    class="px-4 py-2 bg-red-500 text-white rounded-lg transition-all duration-150 hover:bg-red-600 hover:scale-105 active:scale-95">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-green-500 text-white rounded-lg transition-all duration-150 hover:bg-green-600 hover:scale-105 active:scale-95">Simpan</button>
            </div>
        </form>
    </div>
</div>
