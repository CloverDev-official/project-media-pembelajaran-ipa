<main class="min-h-screen">
    <livewire:components.modal.modal-mulai-latihan lazy />

    <!-- HERO MOBILE -->
    <div class="md:hidden relative flex justify-center items-center hero m-5 mb-10 mt-28">
        <img src="../img/bg-isi-materi-mobile.png" class="w-full" alt="">
        <div class="absolute">
            <div class="flex flex-col gap-2">
                <h1 class="text-lg text-center text-white font-bold text-shadow-2xs">
                    {{ $bab->judul_bab }}
                </h1>
                <h1 class="text-sm text-center text-white font-medium text-shadow-2xs">
                    {{ $bab->deskripsi }}
                </h1>
            </div>
        </div>
    </div>

    <!-- HERO DEKSTOP -->
    <div class="hidden relative md:flex justify-center items-center hero m-10 mt-28">
        <img src="../img/bg-isi-materi.png" class="w-full" alt="">
        <div class="absolute left-20">
            <h1 class="text-6xl text-white font-bold text-shadow-2xs">
                {{ $bab->judul_bab }}
            </h1>
            <h1 class="mt-5 text-4xl  text-white font-medium text-shadow-2xs">
                {{ $bab->deskripsi }}
            </h1>
        </div>
    </div>

    <!-- CONTENT + LATIHAN -->
    <div>
        <div class="flex flex-col justify-center m-3 md:m-10 gap-10">

            <!-- KONTEN MATERI -->
            <div class="materi-bab" wire:ignore>
                {!! $bab->isiBab->isi_materi !!}
            </div>

            <!-- Video Interaktif -->
            @if($bab->isiBab && $bab->isiBab->interactiveVideos->count() > 0)
                <div class="mb-10">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Video Interaktif</h2>
                    <div class="space-y-6">
                        @foreach($bab->isiBab->interactiveVideos as $video)
                            <livewire:interactive-video-player :video-id="$video->id" :key="'video-'.$video->id" />
                        @endforeach
                    </div>
                </div>
            @endif <!-- Added missing endif -->

            <div id="latihan" class="mb-15">
                @if (!$mulai)
                    <div class="max-w-7xl mx-auto">

                        <!-- HEADER LATIHAN -->
                        <div
                            class="flex justify-center bg-blue-500 p-4 rounded-t-4xl text-white w-full">
                            <p class="font-bold text-lg sm:text-xl">
                                <i class="fa-solid fa-pen-to-square"></i> Latihan
                            </p>
                        </div>

                        <!-- LATIHAN BELUM MULAI -->
                        <div class="relative bg-white rounded-b-4xl shadow-md p-4 sm:p-6">
                            <div class="py-5 text-center" id="startSection">

                                @if (!$latihanAda)
                                    <p class="text-blue-600 font-bold text-lg">
                                        Maaf, latihan untuk bab ini belum tersedia.
                                    </p>
                                @else
                                    @if ($selesai)
                                        <button disabled
                                            class="w-auto md:w-[25rem] shadow-md px-7 py-4 rounded-full text-green-700 text-xl bg-green-200">
                                            Telah Selesai
                                        </button>
                                    @else
                                        <button wire:click="$dispatch('openMulaiLatihan')"
                                            id="startBtn"
                                            class="w-auto md:w-[25rem] px-7 py-4 md:px-3 md:py-5 rounded-full text-black text-xl bg-yellow-300 transition-all duration-150 hover:scale-105 active:scale-95">
                                            Mulai Latihan
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- LATIHAN SUDAH DIMULAI -->
                @if ($mulai)
                    <div class="max-w-7xl mx-auto">

                        <!-- HEADER -->
                        <div class="flex bg-blue-500 p-3 sm:p-4 rounded-t-lg text-white w-full">
                            <p class="font-bold text-lg sm:text-xl">
                                <i class="fa-solid fa-pen-to-square"></i>
                                Latihan
                            </p>
                        </div>

                        <!-- CARD UTAMA -->
                        <div class="relative bg-white rounded-xl shadow-md p-4 sm:p-6">

                            <!-- TIMER -->
                            <div id="timerSection"
                                class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-4">
                                <p id="timer" wire:ignore
                                    class="font-bold text-red-600 text-center sm:text-left">
                                    Waktu: <span
                                        id="time">{{ $waktuPengerjaanFormated }}</span>
                                </p>
                                <p id="scoreBoard"
                                    class="font-semibold text-green-600 text-center sm:text-right">
                                </p>
                            </div>

                            <!-- JIKA BELUM TAMPILKAN HASIL -->
                            @if (!$tampilkanHasilLatihan)
                                <div id="quizSection">

                                    <!-- SOAL -->
                                    <div id="questionContainer"
                                        class="mb-6 text-sm md:text-xl sm:text-base">
                                        <section class="question-card max-w-4xl mx-auto p-6">
                                            <h2 class="text-lg font-bold mb-4">
                                                Soal {{ $halamanSekarang }} dari {{ $jumlahSoal }}
                                            </h2>

                                            <p class="mb-4">
                                                {{ $soalSekarang['soal'] }}
                                            </p>

                                            @php
                                                $opsi = [
                                                    [
                                                        'key' => 'a',
                                                        'text' => $soalSekarang['a'],
                                                        'color' => 'bg-red-600 ring-red-400',
                                                    ],
                                                    [
                                                        'key' => 'b',
                                                        'text' => $soalSekarang['b'],
                                                        'color' => 'bg-green-600 ring-green-400',
                                                    ],
                                                    [
                                                        'key' => 'c',
                                                        'text' => $soalSekarang['c'],
                                                        'color' => 'bg-blue-600 ring-blue-400',
                                                    ],
                                                    [
                                                        'key' => 'd',
                                                        'text' => $soalSekarang['d'],
                                                        'color' => 'bg-yellow-600 ring-yellow-400',
                                                    ],
                                                ];
                                            @endphp

                                            <div
                                                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 md:gap-4">
                                                @foreach ($opsi as $item)
                                                    <label
                                                        class="flex justify-center cursor-pointer w-full">
                                                        <input type="radio"
                                                            wire:key="radio-{{ $soalSekarang['id'] }}-{{ $item['key'] }}-{{ $halamanSekarang }}"
                                                            name="soal{{ $soalSekarang['id'] }}"
                                                            value="{{ strtolower($item['key']) }}"
                                                            wire:model.live="jawaban.{{ $soalSekarang['id'] }}"
                                                            class="peer hidden">

                                                        <div
                                                            class="py-5 px-5 w-[15rem] md:h-[10rem] rounded-lg border-2 font-bold text-xl text-white hover:opacity-80 flex items-center justify-center transition {{ $item['color'] }} peer-checked:ring-4 peer-checked:opacity-100">
                                                            {{ $item['text'] }}
                                                        </div>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </section>
                                    </div>

                                    <!-- NAVIGASI -->
                                    <div class="flex flex-wrap gap-2 mt-10 mb-4 justify-center">
                                        @for ($i = 1; $i <= $jumlahSoal; $i++)
                                            <button
                                                class="w-10 h-10 flex items-center justify-center rounded-full font-bold cursor-pointer
                                                {{ $halamanSekarang == $i
                                                    ? 'ring-4 ring-blue-500 bg-gray-300 text-gray-700'
                                                    : (isset($jawaban[$daftarSoal[$i - 1]['id']])
                                                        ? 'bg-green-500 text-white'
                                                        : 'bg-gray-300 text-gray-700') }}"
                                                wire:click="goToPage({{ $i }})">
                                                {{ $i }}
                                            </button>
                                        @endfor
                                    </div>

                                    <!-- BUTTON NEXT PREV -->
                                    <div class="flex flex-col sm:flex-row justify-between gap-3">
                                        <button id="prevBtn"
                                            class="px-4 py-2 rounded-xl border bg-gray-600 border-b-4 border-gray-700 text-white shadow-sm hover:scale-110 active:scale-95">
                                            Sebelumnya
                                        </button>

                                        @if ($halamanSekarang == $jumlahSoal)
                                            <button wire:click="tampilkanHasil"
                                                class="px-4 py-2 rounded-xl border bg-green-600 border-b-4 border-green-700 text-white shadow-sm hover:scale-110 active:scale-95">
                                                Kirim Jawaban
                                            </button>
                                        @else
                                            <button
                                                wire:click="goToPage({{ $halamanSekarang + 1 }})"
                                                id="nextBtn"
                                                class="px-4 py-2 rounded-xl border bg-blue-600 border-b-4 border-blue-700 text-white shadow-sm hover:scale-110 active:scale-95">
                                                Selanjutnya
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <!-- TAMPILKAN HASIL -->
                                <div id="quizSection">
                                    <h2 class="text-xl font-bold mb-4">Hasil Latihan</h2>

                                    <div id="resultContainer" class="space-y-6">
                                        @foreach ($this->hasilJawaban as $hasil)
                                            @include('partials.hasil-jawaban-card')
                                        @endforeach
                                    </div>

                                    <p class="mt-4">Kamu menjawab benar
                                        <b id="finalScore">{{ $jumlahBenar }}</b>
                                        dari {{ $jumlahSoal }} soal.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- TIMER SCRIPT TETAP --}}
    @if ($mulai && !$tampilkanHasilLatihan)
        @script
            <script>
                setTimeout(() => initTimer(), 100);

                function initTimer() {
                    let timerInterval;

                    const el = document.getElementById("time");
                    if (!el) return;

                    const [m, s] = el.textContent.trim().split(":").map(Number);
                    let sisa = (m * 60) + s;

                    timerInterval = setInterval(() => {
                        if (sisa <= 0) {
                            clearInterval(timerInterval);
                            $wire.waktuHabis();
                            return;
                        }

                        sisa--;
                        el.textContent = formatTime(sisa);
                    }, 1000);
                }

                function formatTime(seconds) {
                    const m = String(Math.floor(seconds / 60)).padStart(2, "0");
                    const s = String(seconds % 60).padStart(2, "0");
                    return `${m}:${s}`;
                }
            </script>
        @endscript
    @endif
</main>
