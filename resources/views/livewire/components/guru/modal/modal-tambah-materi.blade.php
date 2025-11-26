<!-- Modal Tambah -->
<div x-data="{ open: @entangle('showModal').live }" x-show="open"
    class="fixed flex inset-0 items-center justify-center z-50">
    <!-- Overlay -->
    <div @click="open = false" id="overlayTambah" class="absolute inset-0 bg-black/50"></div>
    <!-- Konten Modal -->
    <div class="relative bg-white rounded-lg shadow-md p-6 z-10 w-80 md:w-96">
        <div class="flex flex-col mb-4 text-center">
            <h2 class="text-xl font-semibold capitalize">tambah materi</h2>
            <p class="font-normal text-gray-400 text-sm capitalize">tambahkan materi baru disini</p>
        </div>

        <form id="formTambah" class="flex flex-col gap-4" wire:submit.prevent="save">
            <div>
                <label for="judul" class="font-semibold text-lg capitalize">judul</label>
                <input type="text" id="judul" wire:model.defer="judul" required
                    placeholder="Judul Materi"
                    class="w-full mt-2 py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>
            <select id="kelas" name="kelas" wire:model="kelasId"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                @forelse ($daftarKelas as $kelas)
                    <option value="{{ $kelas->id }}">Kelas {{ $kelas->nama_kelas }}</option>
                @empty
                    <option value="" disabled>Tidak ada kelas tersedia</option>
                @endforelse
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
