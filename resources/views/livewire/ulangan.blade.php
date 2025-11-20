<div class="bg-subtle min-h-screen" x-data="ulanganPage()" x-init="init()">
    <!-- container -->
    <div class=" mt-10 pb-40">
        <!-- judul -->
        <h1 class="text-center text-4xl text-main text-shadow-sm font-bold capitalize">ulangan BAB 1
        </h1>

        <!-- Timer dan Progress -->
        <div class="max-w-3xl mx-auto mt-5 p-4">
            <div class="flex justify-between mb-3">
                <p id="timer" class="text-lg font-semibold text-main">Waktu: <span
                        x-text="formattedTime"></span></p>
                <p id="progressText" class="text-lg font-semibold text-gray-600"
                    x-text="progressText"></p>
            </div>
            <div class="w-full bg-gray-300 h-3 rounded-lg overflow-hidden">
                <div id="progressBar" class="h-3 bg-green-500 transition-all duration-300"
                    :style="`width: ${progressBar}%`">
                </div>
            </div>
        </div>

        <!-- Container Soal -->
        <div class="max-w-6xl mx-5 md:mx-auto mt-5 bg-white rounded-lg shadow-lg p-6">
            @if ($this->currentSoal)
                <div>
                    <h2 class="text-xl font-semibold mb-4">Soal {{ $this->currentPage }} dari
                        {{ $this->totalSoal }}</h2>
                    <p class="mb-4">{{ $this->currentSoal['soal'] }}</p>

                    @if ($this->currentSoal['gambar'])
                        <img src="{{ asset('storage/' . $this->currentSoal['gambar']) }}"
                            alt="Gambar Soal" class="mb-4 max-h-64 object-contain">
                    @endif

                    <div class="space-y-2">
                        @foreach (['a', 'b', 'c', 'd'] as $opsi)
                            <label
                                class="flex items-center gap-2 border rounded-lg p-2 cursor-pointer">
                                <input type="radio" name="jawaban_{{ $this->currentSoal['id'] }}"
                                    wire:click="jawab({{ $this->currentSoal['id'] }}, '{{ $opsi }}')"
                                    @checked(($jawaban[$this->currentSoal['id']] ?? null) === $opsi)>
                                <span class="capitalize">{{ $opsi }}.
                                    {{ $this->currentSoal[$opsi] }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Pagination -->
            <div class="flex justify-between mt-6 items-center">
                <div class="flex gap-2">
                    <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg"
                        wire:click="goToPage({{ max(1, $this->currentPage - 1) }})"
                        @disabled($this->currentPage === 1)>
                        Sebelumnya
                    </button>
                    <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg"
                        wire:click="goToPage({{ min($this->totalSoal, $this->currentPage + 1) }})"
                        @disabled($this->currentPage === $this->totalSoal)>
                        Selanjutnya
                    </button>
                </div>

                <button type="button"
                    class="px-6 py-2 bg-main text-white rounded-lg bg-hover-dark transition"
                    wire:click="submit">
                    Kirim Jawaban
                </button>
            </div>
        </div>

        <!-- Hasil Ulangan -->
        @if (!is_null($score))
            <div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4 text-main">Hasil Ulangan</h2>
                <p class="mb-2">Benar: {{ $benar }}</p>
                <p class="mb-2">Salah: {{ $salah }}</p>
                <p class="mb-2 font-semibold">Nilai: {{ $score }}</p>
            </div>
        @endif
    </div>

    <script>
        function ulanganPage() {
            return {
                timeLeft: @js($timeLeft ?? 0),
                formattedTime: '00:00',
                progressText: '0/{{ $totalSoal }} Soal Terjawab',
                progressBar: 0,
                intervalId: null,
                init() {
                    this.updateFormattedTime();

                    // hitung progres awal dari jawaban yang sudah ada
                    this.$watch('$wire.jawaban', (value) => {
                        const terjawab = Object.keys(value || {}).length;
                        const total = {{ $totalSoal }} || 1;
                        this.progressText = `${terjawab}/${total} Soal Terjawab`;
                        this.progressBar = (terjawab / total) * 100;
                    });

                    this.intervalId = setInterval(() => {
                        if (this.timeLeft <= 0) {
                            clearInterval(this.intervalId);
                            this.formattedTime = '00:00';
                            // paksa cek ke server dan submit
                            this.$wire.forceSubmitByTimer();
                            return;
                        }

                        this.timeLeft--;
                        this.updateFormattedTime();
                    }, 1000);
                },
                updateFormattedTime() {
                    const minutes = String(Math.floor(this.timeLeft / 60)).padStart(2, '0');
                    const seconds = String(this.timeLeft % 60).padStart(2, '0');
                    this.formattedTime = `${minutes}:${seconds}`;
                },
            };
        }
    </script>
</div>
