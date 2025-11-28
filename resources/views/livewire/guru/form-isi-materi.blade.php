<main class="min-h-screen mt-5">
    <livewire:components.guru.modal.modal-form-latihan lazy />
    <livewire:components.guru.modal.modal-konfirmasi-save-materi lazy />
    <!-- hero section -->
    <div class="h-[50vh] bg-blue-500 flex justify-between items-center">
        <div class="flex flex-col capitalize text-white m-5">
            <h1 class="text-5xl font-bold text-shadow-2xs">{{ $judulBab }}</h1>
        </div>
    </div>
    <form action="#" method="post" class="mt-5" wire:submit.prevent="save">
        <h1 class="font-bold capitalize mb-2">teks :</h1>
        <!-- Tombol Import Word -->
        <div>
            <input type="file" id="importWord" accept=".docx" hidden>

            <button wire:click="$dispatch('wordToHTML')" type="button"
                class="mt-5 mb-2 border-l-4 border-b-4 border-blue-600 px-4 py-2 bg-blue-500 hover:scale-110 active:scale-95 rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md capitalize">
                <i class="bi bi-file-earmark-word-fill"></i>
                Word
            </button>
        </div>

        <!-- teks -->
        <livewire:ckeditor5 wire:model.defer="teksBab" :editorId="$editorId" editableHeight="800"
            :content="$teksBab" />

        <div class="flex justify-center lg:mb-14 mt-14 lg:mt-12 z-40 ">
            <div class="z-40 w-[20rem] md:w-[50rem] mx-auto">
                <!-- Header -->
                <div
                    class="z-20 flex justify-center bg-blue-500 p-3 sm:p-4 rounded-t-2xl text-white w-full">
                    <p class="z-20 font-bold text-center text-lg sm:text-xl">
                        <i class="fa-solid fa-pen-to-square"></i> Latihan
                    </p>
                </div>
                <!-- Card -->
                <div class="relative bg-white rounded-b-xl shadow-md p-4 sm:p-6">
                    <div class="py-5 flex justify-center">
                        <button
                            wire:click="$dispatch('openModalKonfirmasiSaveMateri', { babId: '{{ $babId }}' })"
                            type="button"
                            class="flex gap-2 items-center justify-center w-auto md:w-xs px-2 py-3 rounded-xl text-white border border-main-dark border-l-4 border-b-4 bg-blue-500 shadow-sm text-xl transition-all duration-150 hover:scale-105 active:scale-95 active:shadow-inner">
                            <iconify-icon icon="bx:edit" class="text-2xl"></iconify-icon>
                            Latihan
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tombol Pilih Video Interaktif (Hanya satu) -->
        <button type="button" wire:click="openVideoModal"
            class="mt-5 mb-2 mr-4 border-l-4 border-b-4 border-red-600 px-4 py-2 bg-red-500 hover:scale-[01.1] active:scale-95 rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md capitalize">
            <i class="bi bi-file-earmark-play-fill"></i>
            Pilih Video Interaktif
        </button>

        <!-- Preview Video -->
        <div id="preview" class="mt-4 hidden relative w-full">
            <!-- Tombol Hapus -->
            <button type="button" id="removeVideo"
                class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center shadow hover:bg-red-600 z-10">
                &times;
            </button>
            <video controls class="w-full rounded-lg shadow z-0"></video>
            <div class="flex justify-center">
                <button type="button" id="openPopupBtn"
                    class="mt-5 mb-2 border-l-4 border-b-4 border-blue-600 px-4 py-2 bg-blue-500 hover:scale-[01.1] active:scale-95 rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md capitalize">tambah
                    pertanyaan</button>
            </div>
        </div>

        <!-- btn simpan -->
        <button onclick="toastMagic.info('Sedang menyimpan data, mohon tunggu sebentar…');"
            type="submit"
            class="mt-5 border-l-4 border-b-4 border-main-dark px-4 py-2 bg-blue-500 hover:scale-[01.1] active:scale-95  rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md capitalize">
            simpan
        </button>

        <!-- Modal Pilih Video Interaktif -->
        @if ($showVideoModal)
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg p-6 w-full max-w-2xl max-h-[80vh] overflow-y-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Pilih Video Interaktif</h3>
                        <button wire:click="closeVideoModal"
                            class="text-gray-500 hover:text-gray-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @forelse($allInteractiveVideos as $video)
                            <div class="border border-gray-200 rounded-lg p-4 flex items-start">
                                <input type="checkbox" id="video_{{ $video->id }}"
                                    wire:click="toggleVideo({{ $video->id }})"
                                    {{ in_array($video->id, $selectedVideos) ? 'checked' : '' }}
                                    class="mt-1 mr-3">
                                <label for="video_{{ $video->id }}" class="flex-1">
                                    <h4 class="font-medium">{{ $video->title }}</h4>
                                    @if ($video->description)
                                        <p class="text-sm text-gray-600 mt-1">
                                            {{ $video->description }}</p>
                                    @endif
                                </label>
                            </div>
                        @empty
                            <div class="col-span-2 text-center py-4">
                                <p class="text-gray-500">Belum ada video interaktif</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-4 flex justify-end">
                        <button wire:click="closeVideoModal"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        @endif

    </form>

</main>
