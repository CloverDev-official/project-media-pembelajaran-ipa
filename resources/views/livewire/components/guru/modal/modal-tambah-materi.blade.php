<!-- Modal Tambah -->
<div x-data="{ open: @entangle('showModal').live }" x-show="open"
    class="fixed flex inset-0 items-center justify-center z-50">
    <!-- Overlay -->
    <div @click="open = false" id="overlayTambah" class="absolute inset-0 bg-black/50"></div>
    <!-- Konten Modal -->
    <div class="relative bg-white rounded-lg shadow-md p-6 z-10 w-[90%] max-w-3xl">
        <div class="flex flex-col mb-4 text-center">
            <h2 class="text-xl font-semibold capitalize">tambah materi</h2>
            <p class="font-normal text-gray-400 text-sm capitalize">tambahkan materi baru disini</p>
        </div>

        <form id="formTambah" class="flex flex-col gap-4" wire:submit.prevent="save">
            <div>
                <label for="gambar" class="font-semibold text-lg capitalize">Gambar Soal
                    (opsional)</label>
                <input type="file" id="gambar" wire:model="gambar" accept="image/*"
                    class="w-full mt-2 py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-700">

                <!-- Status Upload -->
                <div wire:loading wire:target="gambar"
                    class="mt-2 text-blue-500 text-sm animate-pulse">
                    Mengunggah gambar...
                </div>

                <!-- Preview Gambar -->
                @if ($gambar)
                    <div class="mt-3">
                        <p class="text-sm text-gray-500 mb-1">Pratinjau Gambar:</p>
                        <img src="{{ $gambar->temporaryUrl() }}"
                            class="w-full max-h-60 object-contain rounded-lg border">
                    </div>
                @endif

                <p class="text-sm text-gray-500 mt-2">Format: JPG, PNG, atau GIF (maks. 5MB)
                </p>
            </div>
            <div>
                <label for="judul" class="font-semibold text-lg capitalize">judul</label>
                <input type="text" id="judul" wire:model.defer="judul" required
                    placeholder="Judul Materi"
                    class="w-full mt-2 py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-700">
            </div>
            <div>
                <label for="deskripsi" class="font-semibold text-lg capitalize">Deskripsi</label>
                <textarea id="deskripsi" wire:model.defer="deskripsi" rows="3"
                    placeholder="Deskripsi (opsional)"
                    class="w-full mt-2 py-3 px-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-700"></textarea>
            </div>
            <select id="kelas" name="kelas" wire:model="kelasId"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:border-blue-700">
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
