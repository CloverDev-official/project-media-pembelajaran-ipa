<div>
    <div class="mt-10">
        <div class="p-6 bg-white rounded-xl shadow-lg">
            <div class="mb-6">
                <h2 class="text-3xl font-bold text-gray-800 capitalize">form video interaktif</h2>
                <p class="text-gray-600 mt-2">Kelola video interaktif untuk pembelajaran</p>
            </div>

            <!-- Notifikasi ToastMagic -->
            <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

            <div
                class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg shadow-md p-6 mb-6 border border-blue-100">
                <h3 class="text-xl font-semibold mb-4 text-blue-800">Tambah Video Baru</h3>
                <form wire:submit.prevent="saveVideo" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Judul
                                Video</label>
                            <input type="text" wire:model="title"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                placeholder="Masukkan judul video">
                            @error('title')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Thumbnail
                                (Opsional)</label>
                            <input type="file" wire:model="thumbnailFile" accept="image/*"
                                class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg p-3 cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500">

                            @error('thumbnailFile')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror

                            @if ($thumbnailFile)
                                <div class="mt-3" wire:loading.remove wire:target="thumbnailFile">
                                    <img src="{{ $thumbnailFile->temporaryUrl() }}"
                                        class="w-full h-32 object-cover rounded-lg border border-gray-200"
                                        alt="Thumbnail Preview">
                                </div>
                            @endif

                            <div wire:loading wire:target="thumbnailFile"
                                class="mt-3 text-sm text-gray-500">
                                Uploading thumbnail...
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi Video -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi
                            (Opsional)</label>
                        <textarea wire:model="description" rows="3"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Masukkan deskripsi video..."></textarea>
                        @error('description')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Video File Input -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">File
                            Video</label>
                        <input type="file" wire:model="videoFile" accept="video/*"
                            class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg p-3 cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500">

                        @error('videoFile')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror

                        @if ($videoFile)
                            <div class="mt-3" wire:loading.remove wire:target="videoFile">
                                <video src="{{ $videoFile->temporaryUrl() }}"
                                    class="w-full h-48 object-contain rounded-lg border border-gray-200"
                                    controls></video>
                            </div>
                        @endif

                        <div wire:loading wire:target="videoFile"
                            class="mt-3 text-sm text-gray-500">
                            Uploading video...
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 shadow-md disabled:opacity-50 disabled:cursor-not-allowed"
                            wire:loading.attr="disabled"
                            wire:target="saveVideo, videoFile, thumbnailFile">
                            <span wire:loading.remove wire:target="saveVideo"
                                class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Simpan Video
                            </span>
                            <span wire:loading wire:target="saveVideo" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-800 capitalize">daftar video
                        interaktif</h3>
                    <span class="text-sm text-gray-500">{{ $videos->count() }} video</span>
                </div>

                @if (session()->has('message'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        {{ session('message') }}
                    </div>
                @endif
                <div class="flex justify-start">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($videos as $video)
                            <div class="flex justify-center items-center">
                                <div
                                    class="bg-white border border-l-4 border-b-4 border-gray-300 p-2 rounded-lg min-w-[15rem] shadow">
                                    <!-- container gambar -->
                                    <div class="flex justify-center">
                                        @if ($video->thumbnail_path)
                                            <img src="{{ Storage::url($video->thumbnail_path) }}"
                                                alt="{{ $video->title }}"
                                                class="bg-gray-200 w-full h-[12rem] rounded-lg border-0 object-cover">
                                        @else
                                            <div
                                                class="bg-gray-200 w-full h-[12rem] rounded-lg border-0 flex items-center justify-center">
                                                <svg class="w-12 h-12 text-blue-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- judul dan deskripsi -->
                                    <div class="mb-3 py-2">
                                        <h2 class="font-bold text-main text-lg capitalize">
                                            {{ $video->title }}</h2>
                                        @if ($video->description)
                                            <p class="font-normal text-xs text-gray-600 mt-1">
                                                {{ $video->description }}</p>
                                        @else
                                            <p class="font-normal text-xs text-gray-600 mt-1">Tidak
                                                ada
                                                deskripsi</p>
                                        @endif
                                    </div>

                                    <!-- tombol -->
                                    <a wire:navigate
                                        href="{{ route('guru.edit-pertanyaan-video-interaktif', ['video' => $video->id]) }}"
                                        class="mt-2 py-1 font-semibold text-sm w-full rounded-lg transition-all text-center duration-150 bg-yellow-400 hover:bg-yellow-500 active:scale-95 text-white capitalize block">
                                        edit
                                    </a>

                                    <button x-data
                                        x-on:click.prevent="if (confirm('Apakah kamu yakin ingin menghapus video ini? Tindakan ini tidak dapat dibatalkan.')) $wire.deleteVideo({{ $video->id }})"
                                        class="btn-hapus mt-2 py-1 font-semibold text-sm w-full rounded-lg transition-all duration-150 bg-red-500 hover:bg-red-600 active:scale-95 text-white capitalize">
                                        hapus
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada video
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">Upload video interaktif
                                    pertamamu
                                    untuk memulai.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    @endpush
</div>
