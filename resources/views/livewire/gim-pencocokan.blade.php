<section class="min-h-screen bg-gray-100 py-20">
    <div class="container mx-auto p-4 max-w-4xl mt-8">
        @if ($level)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h1 class="text-2xl font-bold text-center text-gray-800 mb-2">{{ $level->judul_level }}</h1>
                <p class="text-gray-600 text-center mb-6">{{ $level->deskripsi }}</p>

                @if ($selesai)
                    <div class="text-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-700">Skor: {{ $skor }} / {{ count($level->pasangan) }}</h2>
                        @if ($skor == count($level->pasangan))
                            <p class="text-green-600 font-bold">Selamat! Semua benar!</p>
                        @else
                            <p class="text-red-600">Coba lagi!</p>
                        @endif
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Kolom Kiri (Item yang Bisa Diseret) -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-center text-gray-700">Kolom Kiri</h3>
                        @foreach ($level->pasangan as $index => $item)
                            @php
                                // Check if this item is already used
                                $isUsed = in_array($item['kiri'], $jawabanMurid);
                            @endphp
                            <div
                                draggable="{{ !$selesai && !$isUsed ? 'true' : 'false' }}"
                                ondragstart="event.dataTransfer.setData('text/plain', '{{ $item['kiri'] }}'); event.target.style.opacity = '0.5';"
                                ondragend="event.target.style.opacity = '1';"
                                class="p-3 bg-blue-50 rounded-lg border border-gray-200 transition-all text-lg font-medium {{ !$selesai && !$isUsed ? 'cursor-move hover:bg-blue-100' : 'opacity-30 cursor-not-allowed' }}"
                                style="{{ $isUsed && !$selesai ? 'display: none;' : '' }}"
                            >
                                {{ $item['kiri'] }}
                                @if ($selesai && isset($hasilAkhir[$item['kiri']]))
                                    <span class="ml-2 text-sm font-bold {{ $hasilAkhir[$item['kiri']] ? 'text-green-600' : 'text-red-600' }}">
                                        ({{ $hasilAkhir[$item['kiri']] ? 'Benar' : 'Salah' }})
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Kolom Kanan (Area Drop) -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-center text-gray-700">Kolom Kanan</h3>
                        @foreach ($pasanganAcak as $index => $item)
                            <div class="p-4 bg-yellow-100 rounded-lg border border-gray-200 min-h-20 flex flex-col items-center justify-center space-y-2">
                                <!-- Label teks kanan -->
                                <div class="text-xl font-bold text-gray-800 text-center">
                                    {{ $item['kanan'] }}
                                </div>
                                <!-- SLOT DROP -->
                                <div
                                    ondragover="event.preventDefault(); event.currentTarget.classList.add('border-blue-500', 'bg-blue-100');"
                                    ondragleave="event.currentTarget.classList.remove('border-blue-500', 'bg-blue-100');"
                                    ondrop="
                                        event.preventDefault();
                                        const draggedText = event.dataTransfer.getData('text/plain');
                                        event.currentTarget.classList.remove('border-blue-500', 'bg-blue-100');
                                        @this.updateJawaban('{{ $item['kanan'] }}', draggedText);
                                    "
                                    class="w-full p-3 rounded-md border-2 border-dashed border-gray-300 text-center text-gray-500 transition-all min-h-[60px] flex items-center justify-center"
                                >
                                    @if(isset($jawabanMurid[$item['kanan']]))
                                        <span class="font-medium text-gray-800 block">{{ $jawabanMurid[$item['kanan']] }}</span>
                                    @else
                                        <span>Taruh di sini</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if (!$selesai)
                    <div class="text-center md:col-span-2">
                        <button type="button" wire:click="submit"
                            class="bg-blue-500 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-600 text-lg">
                            Periksa Jawaban
                        </button>
                    </div>
                @else
                    <div class="text-center md:col-span-2">
                        <button type="button" wire:click="resetPermainan"
                            class="bg-green-500 text-white px-6 py-2 rounded-lg font-medium hover:bg-green-600 mr-2 text-lg">
                            Ulangi Level
                        </button>
                        <a href="{{ route('gim') }}"
                            class="bg-gray-500 text-white px-6 py-2 rounded-lg font-medium hover:bg-gray-600 inline-block text-lg">
                            Pilih Level Lain
                        </a>
                    </div>
                @endif
            </div>
        @else
            <div class="text-center text-gray-500">
                <p>Tidak ada level gim yang aktif.</p>
            </div>
        @endif
    </div>
</section>