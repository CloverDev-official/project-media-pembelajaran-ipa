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
        <!-- Sub Bab -->
        <h1 class="font-bold capitalize">sub bab :</h1>
        <input type="text" wire:model.defer="subBab" id="subBab"
            class="bg-white shadow w-full border border-main rounded-md p-2 mt-2 mb-5 focus:outline-none focus:ring-1 ring-main"
            placeholder="contoh : 1.Pengertian Pertumbuhan dan Perkembangan">
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
        <button type="button" id="importVid"
            class="mt-5 mb-2 mr-4 border-l-4 border-b-4 border-red-600 px-4 py-2 bg-red-500 hover:scale-[01.1] active:scale-95 rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md capitalize">
            <i class="bi bi-file-earmark-play-fill"></i>
            vid interaktif
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

    </form>
</main>
