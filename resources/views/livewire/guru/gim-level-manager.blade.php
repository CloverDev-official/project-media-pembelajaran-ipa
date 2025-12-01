<div class="container">
    @if(session()->has('message'))
        <div class="alert alert-success bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow-md mb-6 mt-10">
        <h3 class="text-3xl font-semibold">{{ $editId ? 'Edit Level' : 'Form Tambah Level' }}</h3>
        <p class="text-gray-600 mt-2">Kelola gim untuk hiburan dalam pembelajaran</p>
        <form wire:submit.prevent="simpan" enctype="multipart/form-data" class="mt-10" >
            <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="judul_level">Judul Level</label>
                <input type="text" id="judul_level" wire:model="judul_level" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                @error('judul_level') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="deskripsi">Deskripsi (Opsional)</label>
                <textarea id="deskripsi" wire:model="deskripsi" class="w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
            </div>

            <!-- Thumbnail Upload -->
            <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="thumbnail">Thumbnail (.jpeg, .jpg, .png)</label>
                @if($editId && $thumbnail)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $thumbnail) }}" alt="Thumbnail" class="h-32 w-auto rounded shadow">
                    </div>
                @endif
                <input type="file" id="thumbnail" wire:model="thumbnail" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                @error('thumbnail') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                @if($thumbnail && !$editId)
                    <div class="mt-3">
                        <p class="text-sm text-gray-600 mb-2">Preview:</p>
                        <img src="{{ $thumbnail->temporaryUrl() }}" alt="Thumbnail Preview" class="h-32 w-auto rounded shadow">
                    </div>
                @endif
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Pasangan Item</label>
                @foreach($pasangan as $index => $item)
                    <div class="flex items-end gap-2 mb-2" wire:key="pasangan-{{ $index }}">
                        <div class="flex-1">
                            <input type="text" placeholder="Item Kiri" wire:model="pasangan.{{ $index }}.kiri" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            @error('pasangan.' . $index . '.kiri') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex-1">
                            <input type="text" placeholder="Item Kanan" wire:model="pasangan.{{ $index }}.kanan" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            @error('pasangan.' . $index . '.kanan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        @if(count($pasangan) > 1)
                            <button type="button" wire:click="hapusPasangan({{ $index }})" class="flex items-center gap-1 px-4 py-2 bg-red-200 text-red-700 rounded-lg transition-all duration-150 hover:bg-red-300 hover:scale-105 active:scale-95">
                                <iconify-icon icon="line-md:trash" class="text-sm"></iconify-icon>
                                Hapus
                            </button>
                        @endif
                    </div>
                @endforeach
                <button type="button" wire:click="tambahPasangan" class="mt-4 flex items-center gap-1 px-4 py-2 bg-green-200 text-green-700 rounded-lg transition-all duration-150 hover:bg-green-300 hover:scale-105 active:scale-95">
                    <iconify-icon icon="line-md:plus" class="text-sm"></iconify-icon>
                    Tambah Pasangan
                </button>
                @error('pasangan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" wire:model="aktif" class="form-checkbox">
                    <span class="ml-2 text-gray-700">Aktif</span>
                </label>
            </div>

            <div class="flex justify-end gap-4">
                <button type="button" wire:click="batal" class="capitalize flex items-center gap-1 px-4 py-3 shadow-sm bg-red-200 text-red-700 rounded-xl transition-all duration-150 hover:bg-red-300 hover:scale-105 active:scale-95">
                    <iconify-icon icon="line-md:close-small"></iconify-icon>
                    batal
                </button>
                <button type="submit" class="capitalize flex items-center gap-1 px-4 py-3 shadow-sm bg-green-200 text-green-700 rounded-xl transition-all duration-150 hover:bg-green-300 hover:scale-105 active:scale-95">
                    <iconify-icon icon="mdi:content-save" class="text-lg"></iconify-icon>
                    simpan gim
                </button>

            </div>
        </form>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold mb-4">Daftar Level</h3>
        <div class="mb-4">
            <input type="text" wire:model.live="search" placeholder="Cari level..." class="w-full px-3 py-2 border border-gray-300 rounded-md">
        </div>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Thumbnail</th>
                    <th class="py-2 px-4 border-b">Judul</th>
                    <th class="py-2 px-4 border-b">Aktif</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($levels as $level)
                    <tr>
                        <td class="py-2 px-4 border-b">
                            @if($level->thumbnail)
                                <img src="{{ asset('storage/' . $level->thumbnail) }}" alt="Thumbnail" class="h-12 w-auto rounded">
                            @else
                                <div class="h-12 w-12 bg-gray-200 rounded flex items-center justify-center text-gray-500">No Image</div>
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b">{{ $level->judul_level }}</td>
                        <td class="py-2 px-4 border-b">{{ $level->aktif ? 'Ya' : 'Tidak' }}</td>
                        <td class="py-2 px-4 border-b">
                            <button wire:click="edit({{ $level->id }})" class="gap-1 items-center flex bg-yellow-500 text-white px-3 py-1 rounded mr-2">
                                <iconify-icon icon="line-md:edit" class="text-sm"></iconify-icon>
                                Edit
                            </button>
                            <button wire:click="hapus({{ $level->id }})" class="gap-1 items-center flex bg-red-500 text-white px-3 py-1 rounded">
                                <iconify-icon icon="line-md:trash" class="text-sm"></iconify-icon>
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-2 px-4 border-b text-center">Tidak ada level ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $levels->links() }}
    </div>
</div>
