<!-- TAMPILKAN HASIL - Improved Version -->
<div id="quizSection">
    <!-- Header Hasil -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 mb-6 text-white">
        <h2 class="text-2xl md:text-3xl font-bold text-center mb-4">
            <i class="fa-solid fa-clipboard-check mr-2"></i>
            Hasil Latihan
        </h2>
        
        <!-- Score Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center">
                <p class="text-sm opacity-90 mb-1">Total Soal</p>
                <p class="text-3xl font-bold">{{ $jumlahSoal }}</p>
            </div>
            <div class="bg-green-500/30 backdrop-blur-sm rounded-lg p-4 text-center">
                <p class="text-sm opacity-90 mb-1">Jawaban Benar</p>
                <p class="text-3xl font-bold">{{ $jumlahBenar }}</p>
            </div>
            <div class="bg-red-500/30 backdrop-blur-sm rounded-lg p-4 text-center">
                <p class="text-sm opacity-90 mb-1">Jawaban Salah</p>
                <p class="text-3xl font-bold">{{ $jumlahSalah }}</p>
            </div>
        </div>

        <!-- Nilai -->
        <div class="mt-6 text-center">
            <p class="text-lg mb-2">Nilai Akhir</p>
            <div class="inline-block bg-white text-blue-600 rounded-full px-8 py-3">
                <span class="text-4xl font-bold">{{ $nilai }}</span>
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

    <div id="resultContainer" class="space-y-6">
        @foreach ($hasilJawaban as $index => $hasil)
            <div class="bg-white rounded-xl shadow-md overflow-hidden border-2 
                {{ $hasil['benar'] ? 'border-green-300' : 'border-red-300' }}">
                
                <!-- Header Soal -->
                <div class="px-6 py-4 flex items-center justify-between
                    {{ $hasil['benar'] ? 'bg-green-50' : 'bg-red-50' }}">
                    <h4 class="font-bold text-lg text-gray-800">
                        Soal {{ $index + 1 }}
                    </h4>
                    <div class="flex items-center gap-2">
                        @if($hasil['benar'])
                            <span class="bg-green-500 text-white px-4 py-2 rounded-full font-bold flex items-center gap-2">
                                <i class="fa-solid fa-check"></i>
                                Benar
                            </span>
                        @else
                            <span class="bg-red-500 text-white px-4 py-2 rounded-full font-bold flex items-center gap-2">
                                <i class="fa-solid fa-times"></i>
                                Salah
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Soal -->
                <div class="px-6 py-4 border-b border-gray-200">
                    <p class="text-gray-800 text-base md:text-lg leading-relaxed">
                        {{ $hasil['soal'] }}
                    </p>
                </div>

                <!-- Pilihan Jawaban -->
                <div class="px-6 py-4 space-y-3">
                    @php
                        $options = [
                            ['key' => 'a', 'text' => $hasil['a']],
                            ['key' => 'b', 'text' => $hasil['b']],
                            ['key' => 'c', 'text' => $hasil['c']],
                            ['key' => 'd', 'text' => $hasil['d']],
                        ];
                    @endphp

                    @foreach($options as $option)
                        @php
                            $isJawabanUser = $hasil['jawaban_user'] === $option['key'];
                            $isJawabanBenar = $hasil['jawaban_benar'] === $option['key'];
                            
                            // Determine styling
                            if ($isJawabanBenar) {
                                $bgClass = 'bg-green-100 border-green-400 border-2';
                                $textClass = 'text-green-800 font-semibold';
                                $icon = '<i class="fa-solid fa-check-circle text-green-600"></i>';
                            } elseif ($isJawabanUser && !$hasil['benar']) {
                                $bgClass = 'bg-red-100 border-red-400 border-2';
                                $textClass = 'text-red-800 font-semibold';
                                $icon = '<i class="fa-solid fa-times-circle text-red-600"></i>';
                            } else {
                                $bgClass = 'bg-gray-50 border-gray-200 border';
                                $textClass = 'text-gray-700';
                                $icon = '';
                            }
                        @endphp

                        <div class="flex items-center gap-3 p-4 rounded-lg {{ $bgClass }} transition-all">
                            <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full 
                                {{ $isJawabanBenar ? 'bg-green-500' : ($isJawabanUser ? 'bg-red-500' : 'bg-gray-300') }} 
                                text-white font-bold">
                                {{ strtoupper($option['key']) }}
                            </div>
                            
                            <p class="flex-grow {{ $textClass }}">
                                {{ $option['text'] }}
                            </p>

                            @if($isJawabanBenar || ($isJawabanUser && !$hasil['benar']))
                                <div class="flex-shrink-0 text-xl">
                                    {!! $icon !!}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Keterangan -->
                <div class="px-6 py-4 bg-gray-50">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 text-sm">
                        @if($hasil['jawaban_user'])
                            <p class="text-gray-700">
                                <span class="font-semibold">Jawaban Kamu:</span>
                                <span class="ml-2 px-3 py-1 rounded 
                                    {{ $hasil['benar'] ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                    {{ strtoupper($hasil['jawaban_user']) }}
                                </span>
                            </p>
                        @else
                            <p class="text-gray-500 italic">
                                <i class="fa-solid fa-exclamation-circle mr-1"></i>
                                Tidak dijawab
                            </p>
                        @endif

                        <p class="text-gray-700">
                            <span class="font-semibold">Jawaban Benar:</span>
                            <span class="ml-2 px-3 py-1 rounded bg-green-200 text-green-800">
                                {{ strtoupper($hasil['jawaban_benar']) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>