<div>
    <div class="mt-10">
        <div class="p-6 bg-white rounded-xl shadow-lg">
            <div class="mb-6">
                <h2 class="text-3xl font-bold text-gray-800 capitalize">Form Isi Materi</h2>
                <p class="text-gray-600 mt-2">Kelola materi untuk pembelajaran</p>
            </div>

            <!-- Notifikasi ToastMagic -->
            <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

            <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-blue-100">
                <form wire:submit.prevent="save" class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Bab</label>
                        <input type="text" value="{{ $judulBab }}" readonly
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Bab</label>
                        <textarea readonly rows="2"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100">{{ $deskripsiBab }}</textarea>
                    </div>

                    <!-- Teks Materi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Isi Materi</label>
                        <textarea wire:model="teksBab.main" rows="10"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Masukkan isi materi..."></textarea>
                        @error('teksBab.main')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Pemilihan Video Interaktif -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-sm font-medium text-gray-700">Video Interaktif</label>
                            <button type="button" wire:click="openVideoModal"
                                class="px-3 py-1 text-sm bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                Pilih Video
                            </button>
                        </div>
                        
                        @if(count($selectedVideos) > 0)
                            <div class="space-y-2">
                                @foreach($allInteractiveVideos->whereIn('id', $selectedVideos) as $video)
                                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                                        <span>{{ $video->title }}</span>
                                        <button type="button" wire:click="toggleVideo({{ $video->id }})"
                                            class="text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-sm">Tidak ada video yang dipilih</p>
                        @endif
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" wire:click="cancel"
                            class="px-6 py-3 flex items-center gap-1 bg-gray-300 focus:outline-none focus:ring-2 transition-all duration-100 hover:bg-gray-400 hover:scale-105 active:scale-95 rounded-xl shadow-sm disabled:cursor-not-allowed">
                            <iconify-icon icon="line-md:close" class="text-sm"></iconify-icon>
                            <span>Batal</span>
                        </button>
                        <button type="submit"
                            class="px-6 py-3 flex items-center gap-1 bg-yellow-300 focus:outline-none focus:ring-2 transition-all duration-100 hover:bg-yellow-400 hover:scale-105 active:scale-95 rounded-xl shadow-sm disabled:cursor-not-allowed"
                            wire:loading.attr="disabled"
                            wire:target="save">
                            <iconify-icon icon="line-md:plus" class="text-sm"></iconify-icon>
                            <span wire:loading.remove wire:target="save">
                                Simpan Materi
                            </span>
                            <span wire:loading wire:target="save" class="flex items-center">
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
        </div>
    </div>

    <!-- Modal Video Selection -->
    @if($showVideoModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" wire:click="closeVideoModal">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Pilih Video Interaktif</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-96 overflow-y-auto">
                        @foreach($allInteractiveVideos as $video)
                            <div class="border rounded-lg p-3 {{ in_array($video->id, $selectedVideos) ? 'border-blue-500 bg-blue-50' : 'border-gray-300' }}">
                                <div class="flex items-start">
                                    <input type="checkbox" 
                                        value="{{ $video->id }}" 
                                        wire:model="selectedVideos"
                                        class="mt-1 mr-3">
                                    <div class="flex-1">
                                        <h4 class="font-medium">{{ $video->title }}</h4>
                                        @if($video->description)
                                            <p class="text-sm text-gray-600">{{ Str::limit($video->description, 100) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="flex justify-end mt-4">
                        <button wire:click="closeVideoModal" 
                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 mr-2">
                            Selesai
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {
        // Handle confirmation dialog for cancel
        window.addEventListener('confirm-cancel', (event) => {
            if (confirm(event.detail.message)) {
                @this.forceCancel();
            }
        });
        
        // Warn before leaving if form has changed
        window.addEventListener('beforeunload', (event) => {
            @if($formChanged)
                event.preventDefault();
                event.returnValue = 'Perubahan yang belum disimpan akan hilang. Apakah Anda yakin ingin keluar?';
                return event.returnValue;
            @endif
        });
    });
</script>
@endpush