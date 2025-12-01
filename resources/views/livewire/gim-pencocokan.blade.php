<section class="min-h-screen bg-blue-50 py-30 px-4 sm:px-6"> <!-- Perbaikan typo: py-30 -> py-20 -->
    <div class="max-w-5xl mx-auto">
        @if ($level)
            <div
                class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8 transition-all duration-300">
                <!-- Header Level -->
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-center">
                    <h1 class="text-3xl font-bold text-white mb-2">{{ $level->judul_level }}</h1>
                    <p class="text-blue-100 text-lg">{{ $level->deskripsi }}</p>
                </div>

                <!-- Status dan Skor -->
                @if ($selesai)
                    <div
                        class="p-6 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-100">
                        <div class="flex flex-col items-center">
                            <h2 class="text-2xl font-bold text-gray-800">Skor Akhir: <span
                                    class="text-3xl text-blue-600">{{ $skor }}</span> /
                                {{ count($level->pasangan) }}</h2>
                            @if ($skor == count($level->pasangan))
                                <div
                                    class="mt-4 flex items-center justify-center bg-green-100 text-green-800 px-6 py-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="font-bold text-lg">🏆 Selamat! Semua Benar!</span>
                                </div>
                            @else
                                <div
                                    class="mt-4 flex items-center justify-center bg-red-100 text-red-800 px-6 py-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="font-semibold text-lg">Coba lagi untuk lebih
                                        baik!</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Area Permainan -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Kolom Kiri (Item yang Bisa Diseret) -->
                        <div class="space-y-4">
                            <h3
                                class="text-xl font-bold text-center text-gray-700 mb-4 bg-blue-50 py-2 rounded-lg">
                                Seret dari Sini</h3>
                            <div id="kiri-container" class="space-y-3">
                                @foreach ($level->pasangan as $index => $item)
                                    @php
                                        $isUsed = in_array($item['kiri'], $jawabanMurid);
                                    @endphp
                                    <div wire:key="left-item-{{ $index }}"
                                        id="item-{{ $index }}"
                                        draggable="{{ !$selesai && !$isUsed ? 'true' : 'false' }}"
                                        ondragstart="drag(event, '{{ $item['kiri'] }}', '{{ $index }}')"
                                        class="p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border-2 border-blue-200 cursor-move transition-all duration-200 hover:shadow-md hover:border-blue-300 hover:from-blue-100 hover:to-indigo-100 active:scale-95 {{ !$selesai && !$isUsed ? '' : 'opacity-50 cursor-not-allowed' }}"
                                        style="{{ $isUsed && !$selesai ? 'display: none;' : '' }}">
                                        <div class="font-medium text-gray-800 text-center">
                                            {{ $item['kiri'] }}</div>
                                        @if ($selesai && isset($hasilAkhir[$item['kiri']]))
                                            <div class="mt-1 text-center">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $hasilAkhir[$item['kiri']] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $hasilAkhir[$item['kiri']] ? '✅ Benar' : '❌ Salah' }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Kolom Kanan (Area Drop) -->
                        <div class="space-y-4">
                            <h3
                                class="text-xl font-bold text-center text-gray-700 mb-4 bg-yellow-50 py-2 rounded-lg">
                                Letakkan di Sini</h3>
                            <div class="space-y-5">
                                @foreach ($pasanganAcak as $index => $item)
                                    <div
                                        class="p-4 bg-gradient-to-r from-yellow-50 to-amber-50 rounded-xl border-2 border-yellow-200">
                                        <div
                                            class="text-lg font-bold text-center text-gray-800 mb-3">
                                            {{ $item['kanan'] }}</div>
                                        <div id="drop-{{ $index }}"
                                            ondragover="allowDrop(event)"
                                            ondrop="drop(event, '{{ $item['kanan'] }}', '{{ $index }}')"
                                            class="w-full h-20 rounded-lg border-2 border-dashed border-yellow-300 bg-white flex items-center justify-center transition-all duration-200 hover:border-yellow-400">
                                            @if (isset($jawabanMurid[$item['kanan']]))
                                                <span
                                                    class="font-semibold text-gray-800 text-center px-4">{{ $jawabanMurid[$item['kanan']] }}</span>
                                            @else
                                                <span class="text-gray-400 text-center">Tarik dan
                                                    lepas item di sini</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                        @if (!$selesai)
                            <!-- Tombol Reset ditambahkan di sini -->
                            <button type="button" wire:click="resetSlot"
                                class="mt-5 mb-2 mr-4 flex items-center gap-1 px-5 py-3 bg-red-200 rounded-xl text-red-700 font-medium transition-all duration-100 shadow-sm hover:bg-red-300 capitalize hover:scale-105 active:scale-95">
                                <iconify-icon icon="line-md:backup-restore"
                                    class="text-2xl"></iconify-icon>
                                Reset Jawaban
                            </button>
                            <button type="button" wire:click="submit"
                                class="mt-5 mb-2 mr-4 flex items-center gap-1 px-5 py-3 bg-blue-200 rounded-xl text-blue-700 font-medium transition-all duration-100 shadow-sm hover:bg-blue-300 capitalize hover:scale-105 active:scale-95"><iconify-icon
                                    icon="line-md:check-all" class="text-2xl"></iconify-icon>
                                Periksa Jawaban
                            </button>
                        @else
                            <a href="{{ route('gim') }}"
                                class="mt-5 mb-2 mr-4 flex items-center gap-1 px-5 py-3 bg-gray-200 rounded-xl text-gray-700 font-medium transition-all duration-100 shadow-sm hover:bg-gray-300 capitalize hover:scale-105 active:scale-95 inline-block text-center">
                                Pilih Level Lain
                            </a>
                            <button type="button" wire:click="resetPermainan"
                                class="mt-5 mb-2 mr-4 flex items-center gap-1 px-5 py-3 bg-green-200 rounded-xl text-green-700 font-medium transition-all duration-100 shadow-sm hover:bg-green-300 capitalize hover:scale-105 active:scale-95">
                                Ulangi Level
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="text-center bg-white p-12 rounded-2xl shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-2xl font-bold text-gray-700 mt-4">Tidak Ada Level</h3>
                <p class="text-gray-500 mt-2">Silakan pilih sebuah level untuk memulai permainan.
                </p>
            </div>
        @endif
    </div>

    <script>
        function allowDrop(ev) {
            ev.preventDefault();
            ev.currentTarget.classList.add('border-blue-500', 'bg-blue-50');
        }

        function drag(ev, text, id) {
            ev.dataTransfer.setData("text/plain", text);
            ev.dataTransfer.setData("itemId", id); // Untuk menyembunyikan item asal
            // Efek visual saat drag
            ev.target.classList.add('opacity-50', 'scale-95');
        }

        function drop(ev, targetKey, targetIndex) {
            ev.preventDefault();
            const draggedText = ev.dataTransfer.getData("text/plain");
            const itemId = ev.dataTransfer.getData("itemId");

            ev.currentTarget.classList.remove('border-blue-500', 'bg-blue-50');

            // Panggil Livewire
            @this.updateJawaban(targetKey, draggedText);

            // Sembunyikan item yang diseret dari sisi kiri
            const itemElement = document.getElementById(`item-${itemId}`);
            if (itemElement) {
                itemElement.style.display = 'none';
            }
        }

        // Reset efek visual saat drag selesai
        document.addEventListener('dragend', function(e) {
            if (e.target.classList.contains('opacity-50')) {
                e.target.classList.remove('opacity-50', 'scale-95');
            }
        });
    </script>
</section>
