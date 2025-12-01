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
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full bg-white divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col"
                            class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Thumbnail</th>
                        <th scope="col"
                            class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Judul</th>
                        <th scope="col"
                            class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aktif</th>
                        <th scope="col"
                            class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($levels as $level)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="py-4 px-6 whitespace-nowrap">
                                @if ($level->thumbnail)
                                    <img src="{{ asset('storage/' . $level->thumbnail) }}"
                                        alt="Thumbnail - {{ $level->judul_level }}"
                                        class="h-16 w-16 object-cover rounded-lg shadow-sm">
                                @else
                                    <div
                                        class="h-16 w-16 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 shadow-sm">
                                        <span class="text-xs">No Image</span>
                                    </div>
                                @endif
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $level->judul_level }}</div>
                                <div class="text-sm text-gray-500">
                                    {{ Str::limit(strip_tags($level->deskripsi), 50) }}</div>
                                <!-- Contoh menampilkan deskripsi singkat -->
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $level->aktif ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $level->aktif ? 'Ya' : 'Tidak' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-sm">
                                <div class="flex space-x-2">
                                    <button wire:click="edit({{ $level->id }})"
                                        class="mt-0 mb-1 mr-2 flex items-center gap-1 px-4 py-2 bg-yellow-200 rounded-lg text-yellow-700 font-medium transition-all duration-100 shadow-sm hover:bg-yellow-300 capitalize hover:scale-105 active:scale-95">
                                        <iconify-icon icon="line-md:edit"class="text-sm"></iconify-icon>
                                        Edit
                                    </button>
                                    <button wire:click="hapus({{ $level->id }})"
                                        class="mt-0 mb-1 mr-2 flex items-center gap-1 px-4 py-2 bg-red-200 rounded-lg text-red-700 font-medium transition-all duration-100 shadow-sm hover:bg-red-300 capitalize hover:scale-105 active:scale-95">
                                        <iconify-icon icon="line-md:trash"class="text-sm"></iconify-icon>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 px-6 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-12 w-12 text-gray-400 mb-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-gray-500">Tidak ada level ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $levels->links() }}
    </div>
</div>
