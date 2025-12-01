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
            @if ($bab->isiBab && $bab->isiBab->interactiveVideos->count() > 0)
                <div class="mb-10">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Video Interaktif</h2>
                    <div class="space-y-6">
                        @foreach ($bab->isiBab->interactiveVideos as $video)
                            <livewire:interactive-video-player :video-id="$video->id"
                                :key="'video-' . $video->id" />
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
                                            class="px-4 py-2 rounded-xl  bg-gray-600  text-white shadow-sm transition-all duration-100  hover:scale-110 active:scale-95">
                                            Sebelumnya
                                        </button>

                                        @if ($halamanSekarang == $jumlahSoal)
                                            <button wire:click="tampilkanHasil"
                                                class="px-4 py-2 rounded-xl  bg-green-600  text-white shadow-sm transition-all duration-100  hover:scale-110 active:scale-95">
                                                Kirim Jawaban
                                            </button>
                                        @else
                                            <button
                                                wire:click="goToPage({{ $halamanSekarang + 1 }})"
                                                id="nextBtn"
                                                class="px-4 py-2 rounded-xl bg-blue-500 border-b-4  text-white shadow-sm transition-all duration-100 hover:scale-110 active:scale-95">
                                                Selanjutnya
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="p-6">
                                    <!-- JIKA BELUM SELESAI, TAMPILKAN FORM LATIHAN -->
                                    @if (!$tampilkanHasilLatihan)
                                        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                                            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                                                Latihan</h2>

                                            <!-- Form Latihan -->
                                            <form wire:submit.prevent="periksaSemuaJawabanBaru">
                                                @foreach ($soal as $index => $item)
                                                    <div
                                                        class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                                                        <div class="flex items-start gap-3 mb-4">
                                                            <span
                                                                class="bg-blue-500 text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold">
                                                                {{ $index + 1 }}
                                                            </span>
                                                            <div class="flex-1">
                                                                <p
                                                                    class="text-gray-800 text-base leading-relaxed">
                                                                    {{ $item->pertanyaan }}
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <!-- Pilihan Jawaban -->
                                                        <div class="space-y-2">
                                                            @php
                                                                $options = [
                                                                    [
                                                                        'key' => 'a',
                                                                        'text' => $item->pilihan_a,
                                                                    ],
                                                                    [
                                                                        'key' => 'b',
                                                                        'text' => $item->pilihan_b,
                                                                    ],
                                                                    [
                                                                        'key' => 'c',
                                                                        'text' => $item->pilihan_c,
                                                                    ],
                                                                    [
                                                                        'key' => 'd',
                                                                        'text' => $item->pilihan_d,
                                                                    ],
                                                                ];
                                                            @endphp

                                                            @foreach ($options as $option)
                                                                <label
                                                                    class="flex items-center p-3 rounded-lg cursor-pointer 
                                    {{ $jawaban[$item->id] === $option['key'] ? 'bg-blue-100 border-blue-400 border' : 'bg-white border border-gray-200 hover:bg-gray-50' }}">
                                                                    <input type="radio"
                                                                        name="jawaban[{{ $item->id }}]"
                                                                        value="{{ $option['key'] }}"
                                                                        wire:model.defer="jawaban.{{ $item->id }}"
                                                                        class="sr-only">
                                                                    <div
                                                                        class="flex-shrink-0 w-6 h-6 rounded-full 
                                        {{ $jawaban[$item->id] === $option['key'] ? 'bg-blue-500 border-2 border-white' : 'border-2 border-gray-300' }}">
                                                                    </div>
                                                                    <span
                                                                        class="ml-3 text-gray-700">{{ $option['text'] }}</span>
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <button type="submit"
                                                    class="mt-4 px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                                                    <i class="fa-solid fa-check mr-2"></i>
                                                    Periksa Jawaban
                                                </button>
                                            </form>
                                        </div>
                                    @endif

                                    <!-- JIKA SUDAH TAMPILKAN HASIL -->
                                    @if ($tampilkanHasilLatihan)
                                        <!-- Header Hasil -->
                                        <div
                                            class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 mb-6 text-white">
                                            <h2
                                                class="text-2xl md:text-3xl font-bold text-center mb-4">
                                                <i class="fa-solid fa-clipboard-check mr-2"></i>
                                                Hasil Latihan
                                            </h2>

                                            <!-- Score Summary -->
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                                                <div
                                                    class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center">
                                                    <p class="text-sm opacity-90 mb-1">Total Soal
                                                    </p>
                                                    <p class="text-3xl font-bold">
                                                        {{ $jumlahSoal }}</p>
                                                </div>
                                                <div
                                                    class="bg-green-500/30 backdrop-blur-sm rounded-lg p-4 text-center">
                                                    <p class="text-sm opacity-90 mb-1">Jawaban
                                                        Benar</p>
                                                    <p class="text-3xl font-bold">
                                                        {{ $jumlahBenar }}</p>
                                                </div>
                                                <div
                                                    class="bg-red-500/30 backdrop-blur-sm rounded-lg p-4 text-center">
                                                    <p class="text-sm opacity-90 mb-1">Jawaban
                                                        Salah</p>
                                                    <p class="text-3xl font-bold">
                                                        {{ $jumlahSalah }}</p>
                                                </div>
                                            </div>

                                            <!-- Nilai -->
                                            <div class="mt-6 text-center">
                                                <p class="text-lg mb-2">Nilai Akhir</p>
                                                <div
                                                    class="inline-block bg-white text-blue-600 rounded-full px-8 py-3">
                                                    <span
                                                        class="text-4xl font-bold">{{ $nilai }}</span>
                                                    <span class="text-2xl">/100</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pembahasan Soal -->
                                        <div class="mb-4">
                                            <h3 class="text-xl font-bold text-gray-800 mb-4">
                                                <i class="fa-solid fa-book-open mr-2"></i>
                                                Pembahasan Soal
                                            </h3>
                                        </div>

                                        <div class="space-y-6">
                                            @foreach ($this->hasilJawaban as $index => $hasil)
                                                <div class="bg-white rounded-xl shadow-md overflow-hidden border-2 
                    {{ $hasil['benar'] ? 'border-green-300' : 'border-red-300' }}"
                                                    wire:key="hasil-soal-{{ $index }}">

                                                    <!-- Header Soal -->
                                                    <div
                                                        class="px-6 py-4 flex items-center justify-between
                        {{ $hasil['benar'] ? 'bg-green-50' : 'bg-red-50' }}">
                                                        <h4
                                                            class="font-bold text-lg text-gray-800">
                                                            Soal {{ $index + 1 }}
                                                        </h4>
                                                        <div class="flex items-center gap-2">
                                                            @if ($hasil['benar'])
                                                                <span
                                                                    class="bg-green-500 text-white px-4 py-2 rounded-full font-bold flex items-center gap-2">
                                                                    <i
                                                                        class="fa-solid fa-check"></i>
                                                                    Benar
                                                                </span>
                                                            @else
                                                                <span
                                                                    class="bg-red-500 text-white px-4 py-2 rounded-full font-bold flex items-center gap-2">
                                                                    <i
                                                                        class="fa-solid fa-times"></i>
                                                                    Salah
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <!-- Soal -->
                                                    <div
                                                        class="px-6 py-4 border-b border-gray-200">
                                                        <p
                                                            class="text-gray-800 text-base md:text-lg leading-relaxed">
                                                            {{ $hasil['soal'] }}
                                                        </p>
                                                    </div>

                                                    <!-- Pilihan Jawaban -->
                                                    <div class="px-6 py-4 space-y-3">
                                                        @php
                                                            $options = [
                                                                [
                                                                    'key' => 'a',
                                                                    'text' => $hasil['a'],
                                                                ],
                                                                [
                                                                    'key' => 'b',
                                                                    'text' => $hasil['b'],
                                                                ],
                                                                [
                                                                    'key' => 'c',
                                                                    'text' => $hasil['c'],
                                                                ],
                                                                [
                                                                    'key' => 'd',
                                                                    'text' => $hasil['d'],
                                                                ],
                                                            ];
                                                        @endphp

                                                        @foreach ($options as $option)
                                                            @php
                                                                $isJawabanUser =
                                                                    $hasil['jawaban_user'] ===
                                                                    $option['key'];
                                                                $isJawabanBenar =
                                                                    $hasil['jawaban_benar'] ===
                                                                    $option['key'];

                                                                // Determine styling
                                                                if ($isJawabanBenar) {
                                                                    $bgClass =
                                                                        'bg-green-100 border-green-400 border-2';
                                                                    $textClass =
                                                                        'text-green-800 font-semibold';
                                                                    $icon =
                                                                        '<i class="fa-solid fa-check-circle text-green-600"></i>';
                                                                } elseif (
                                                                    $isJawabanUser &&
                                                                    !$hasil['benar']
                                                                ) {
                                                                    $bgClass =
                                                                        'bg-red-100 border-red-400 border-2';
                                                                    $textClass =
                                                                        'text-red-800 font-semibold';
                                                                    $icon =
                                                                        '<i class="fa-solid fa-times-circle text-red-600"></i>';
                                                                } else {
                                                                    $bgClass =
                                                                        'bg-gray-50 border-gray-200 border';
                                                                    $textClass = 'text-gray-700';
                                                                    $icon = '';
                                                                }
                                                            @endphp

                                                            <div
                                                                class="flex items-center gap-3 p-4 rounded-lg {{ $bgClass }} transition-all">
                                                                <div
                                                                    class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full 
                                    {{ $isJawabanBenar ? 'bg-green-500' : ($isJawabanUser ? 'bg-red-500' : 'bg-gray-300') }} 
                                    text-white font-bold">
                                                                    {{ strtoupper($option['key']) }}
                                                                </div>

                                                                <p
                                                                    class="flex-grow {{ $textClass }}">
                                                                    {{ $option['text'] }}
                                                                </p>

                                                                @if ($isJawabanBenar || ($isJawabanUser && !$hasil['benar']))
                                                                    <div
                                                                        class="flex-shrink-0 text-xl">
                                                                        {!! $icon !!}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <!-- Keterangan -->
                                                    <div class="px-6 py-4 bg-gray-50">
                                                        <div
                                                            class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 text-sm">
                                                            @if ($hasil['jawaban_user'])
                                                                <p class="text-gray-700">
                                                                    <span
                                                                        class="font-semibold">Jawaban
                                                                        Kamu:</span>
                                                                    <span
                                                                        class="ml-2 px-3 py-1 rounded 
                                        {{ $hasil['benar'] ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                                                        {{ strtoupper($hasil['jawaban_user']) }}
                                                                    </span>
                                                                </p>
                                                            @else
                                                                <p class="text-gray-500 italic">
                                                                    <i
                                                                        class="fa-solid fa-exclamation-circle mr-1"></i>
                                                                    Tidak dijawab
                                                                </p>
                                                            @endif

                                                            <p class="text-gray-700">
                                                                <span class="font-semibold">Jawaban
                                                                    Benar:</span>
                                                                <span
                                                                    class="ml-2 px-3 py-1 rounded bg-green-200 text-green-800">
                                                                    {{ strtoupper($hasil['jawaban_benar']) }}
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
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
