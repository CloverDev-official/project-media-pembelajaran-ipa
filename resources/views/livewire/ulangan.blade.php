<div class="bg-subtle min-h-screen">
    <!-- container -->
    @if (!$tampilkanHasil)
        <div class="pt-40 pb-40">
            <!-- judul -->
            <h1 class="text-center text-4xl text-blue-500 text-shadow-sm font-bold capitalize">
                {{ $ulangan->judul }}</h1>

            <!-- Timer dan Progress -->
            <div class="max-w-3xl mx-auto mt-5 p-4">
                <div class="flex justify-between mb-3">
                    <p id="timer" wire:ignore class="text-lg font-semibold text-blue-500">Waktu:
                        <span id="time">{{ $waktuPengerjaanFormated }}</span>
                    </p>
                    <p id="progressText" class="text-lg font-semibold text-gray-600">
                        {{ count($jawaban) }}/{{ $jumlahSoal }}
                        Soal Terjawab</p>
                </div>
                <div class="w-full bg-gray-300 h-3 rounded-lg overflow-hidden">
                    <div class="h-3 bg-blue-500 transition-all duration-300"
                        style="width: {{ (count($jawaban) / $jumlahSoal) * 100 }}%">
                    </div>
                </div>
            </div>

            <!-- Container Soal -->
            <div class="max-w-6xl mx-5 md:mx-auto mt-5 bg-white rounded-lg shadow-lg p-6">
                <div id="soalContainer">
                    <div class="bg-blue-500 text-white p-4 rounded-lg">
                        <p class="text-lg font-semibold">{{ $halamanSekarang }}.
                            {{ $soalSekarang['soal'] }}</p>
                    </div>

                    <div class="mt-8 flex flex-col-reverse lg:flex-row gap-10">

                        <!-- Pilihan Jawaban -->
                        <form wire:submit.prevent class="w-full lg:w-1/2">
                            <div class="space-y-5">

                                @foreach (['a', 'b', 'c', 'd'] as $huruf)
                                    <label
                                        class="flex items-start gap-4 cursor-pointer p-4 rounded-lg border hover:bg-gray-50 transition shadow-sm">
                                        <input type="radio"
                                            wire:key="radio-{{ $soalSekarang['id'] }}-{{ $huruf }}-{{ $halamanSekarang }}"
                                            name="soal{{ $soalSekarang['id'] }}"
                                            value="{{ strtoupper($huruf) }}"
                                            class="accent-main mt-1 w-4 h-4"
                                            wire:model.live="jawaban.{{ $soalSekarang['id'] }}" />

                                        <span class="text-lg leading-relaxed break-words w-full">
                                            {{ $soalSekarang[$huruf] }}
                                        </span>
                                    </label>
                                @endforeach

                            </div>
                        </form>

                        <!-- Gambar Soal -->
                        <div class="w-full lg:w-1/2 flex justify-center items-start">
                            @if ($soalSekarang['gambar'])
                                <img src="{{ asset('storage/' . $soalSekarang['gambar']) }}"
                                    class="rounded-lg shadow-md max-h-80 object-contain" />
                            @else
                                <div
                                    class="w-48 h-40 border-2 border-dashed border-gray-300 rounded-lg flex justify-center items-center text-gray-400">
                                    <span class="text-sm">Tidak ada gambar</span>
                                </div>
                            @endif
                        </div>

                    </div>

                </div>

                <!-- Pagination -->
                <div id="pagination" class="flex justify-center mt-6 gap-3">
                    <div class="flex gap-2">
                        @for ($i = 1; $i <= $jumlahSoal; $i++)
                            <button
                                class="px-3 py-1 rounded-lg text-white transition {{ $halamanSekarang == $i
                                    ? 'bg-blue-500'
                                    : (isset($jawaban[$daftarSoal[$i - 1]['id']])
                                        ? 'bg-green-300'
                                        : 'bg-gray-400') }}"
                                wire:click="goToPage({{ $i }})">
                                {{ $i }}
                            </button>
                        @endfor
                    </div>
                </div>

                <!-- Tombol Navigasi -->
                <div class="flex justify-end mt-6">
                    @if ($halamanSekarang !== $jumlahSoal)
                        <button wire:click="goToPage({{ $halamanSekarang + 1 }})" id="nextBtn"
                            class="bg-blue-500 text-white px-6 py-2 rounded-lg bg-hover-dark transition">Selanjutnya</button>
                    @else
                        <button wire:click="periksaSemuaJawaban" id="nextBtn"
                            class="bg-blue-500 text-white px-6 py-2 rounded-lg bg-hover-dark transition">Kirim
                            Jawaban</button>
                    @endif

                </div>
            </div>
    @endif

    <!-- Hasil Ulangan -->
    @if ($tampilkanHasil)
        <div class="pt-40 pb-40">
            <div id="hasilContainer"
                class="max-w-3xl mx-auto pt-10 bg-white p-6 rounded-lg shadow-lg">
                <div class="justify-between items-center mb-6 flex">
                    <h2 class="text-2xl font-bold mb-4 text-blue-500">Hasil Ulangan</h2>
                    <h2 class="text-2xl font-bold mb-4 text-blue-500">{{ $jumlahBenar }} /
                        {{ $jumlahSoal }}
                    </h2>
                </div>

                <div id="hasilList" class="space-y-3">
                    @foreach ($hasilJawaban as $index => $hasil)
                        <div
                            class="p-4 rounded-lg border min-h-[20vh] flex flex-col lg:flex-row justify-between items-start gap-6
                    {{ $hasil['benar'] ? 'bg-green-100 border-green-400' : 'bg-red-100 border-red-400' }}">

                            <div class="w-full lg:w-2/4 flex flex-col justify-center space-y-2">
                                <p class="font-semibold">{{ $index + 1 }}. {{ $hasil['soal'] }}
                                </p>
                                <p>Jawaban Kamu: <b>{{ $hasil['jawaban_user'] }}</b></p>
                                <p>Jawaban Benar: <b>{{ $hasil['jawaban_benar'] }}</b></p>
                                @if ($hasil['benar'])
                                    <p class="text-sm italic text-green-700">
                                        ✅ Jawaban kamu benar
                                    </p>
                                @else
                                    <p class="text-sm italic text-red-700">
                                        ❌ Jawaban kamu salah
                                    </p>
                                @endif
                            </div>

                            @if ($hasil['gambar'])
                                <div class="w-full lg:w-2/4 flex justify-center items-center">
                                    <img src="{{ asset('storage/' . $hasil['gambar']) }}"
                                        alt="Gambar Soal"
                                        class="rounded-lg shadow-md max-h-56 object-contain">
                                </div>
                            @else
                                <div class="w-full lg:w-2/4 flex justify-center items-center">
                                    <div
                                        class="w-40 h-32 border-2 border-dashed border-gray-300 rounded-lg flex justify-center items-center text-gray-400">
                                        <span class="text-sm">Tidak ada gambar</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    @endif

</div>

@script
    <script>
        let timerInterval = null;
        const timer = document.getElementById('timer');

        if (!timer) {
            if (timerInterval) clearInterval(timerInterval);
            return;
        }
        const el = document.getElementById('time');
        if (!el) return;

        if (timerInterval) clearInterval(timerInterval);

        const [m, s] = el.textContent.trim().split(':').map(Number);
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

        function formatTime(seconds) {
            const m = Math.floor(seconds / 60).toString().padStart(2, "0");
            const s = (seconds % 60).toString().padStart(2, "0");
            return `${m}:${s}`;
        }
    </script>
@endscript

</div>
