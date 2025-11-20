<main class="min-h-screen bg-subtle">
    <livewire:components.modal.modal-mulai-latihan lazy />
    <!-- Hero Section -->
    <div class="bg-main-dark relative hero">
        <div
            class="bg-main w-[50rem] h-[89vh] p-10 rounded-l-[50%] absolute top-0 right-0 z-0 inset-shadow-[0px_0px_6px_rgba(0,0,0,0.4)]">
        </div>
        <div class="flex justify-between items-center h-[89vh] relative z-10">
            <div class="mx-10 ">
                <h1 class="capitalize text-white font-bold text-shadow-sm text-6xl mb-2">
                    {{ $bab->judul_bab }}</h1>
            </div>
            <div class="hidden md:flex justify-center w-md">
                <img src="../img/maskot-ipa.png" alt="foto">
            </div>
        </div>
    </div>
    <!-- Content + Sidebar -->
    <div>
        <div class="flex flex-col justify-center m-3 ml-8 md:m-10  gap-10">
            <!-- Content -->
            <div class="materi-bab">
                {!! $bab->isiBab->isi_materi !!}
            </div>

            <div id="latihan" class="mb-15">
                @if (!$mulai)
                    <div class="max-w-7xl mx-auto">
                        <!-- Header -->
                        <div class="flex bg-main p-3 sm:p-4 rounded-t-lg text-white w-full">
                            <p class="font-bold text-lg sm:text-xl">
                                <i class="fa-solid fa-pen-to-square"></i> Latihan
                            </p>
                        </div>
                        <div class="relative bg-white rounded-xl shadow-md p-4 sm:p-6">
                            <div class="py-5 text-center" id="startSection">
                                <button wire:click="$dispatch('openMulaiLatihan')" id="startBtn"
                                    class="w-auto md:w-xs px-2 py-3 text-xl rounded-xl bg-main border-main-dark border border-l-4 border-b-4 text-white font-semibold text-shadow-2xs shadow-sm transition-all duration-150 hover:scale-[1.02] active:scale-95 active:shadow-inner">
                                    Mulai Latihan
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($mulai)
                    <div class="max-w-7xl mx-auto">
                        <!-- Header -->
                        <div class="flex bg-main p-3 sm:p-4 rounded-t-lg text-white w-full">
                            <p class="font-bold text-lg sm:text-xl">
                                <i class="fa-solid fa-pen-to-square"></i> Latihan
                            </p>
                        </div>

                        <!-- Card -->
                        <div class="relative bg-white rounded-xl shadow-md p-4 sm:p-6">
                            <div id="timerSection"
                                class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-4">
                                <p id="timer"
                                    class="font-bold text-red-600 text-center sm:text-left">Waktu:
                                    10:00</p>
                                <p id="scoreBoard"
                                    class="font-semibold text-green-600 text-center sm:text-right">
                                </p>
                            </div>

                            <div id="quizSection">
                                <div id="questionContainer"
                                    class="mb-6 text-sm md:text-xl sm:text-base"></div>
                                <div id="questionNav"
                                    class="flex flex-wrap gap-2 mt-10 mb-4 justify-center"></div>
                                <div class="flex flex-col sm:flex-row justify-between gap-3">
                                    <button id="prevBtn"
                                        class="px-4 py-2 rounded-xl border bg-linear-to-t from-gray-600 to-gray-500 border-b-4 border-gray-700 text-white font-semibold shadow-sm hover:scale-110 active:scale-95">
                                        Sebelumnya
                                    </button>
                                    <button id="nextBtn"
                                        class="px-4 py-2 rounded-xl border bg-linear-to-t from-blue-600 to-blue-500 border-b-4 border-blue-700 text-white font-semibold shadow-sm hover:scale-110 active:scale-95">
                                        Selanjutnya
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
