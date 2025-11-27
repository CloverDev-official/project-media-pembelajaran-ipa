<section class="min-h-screen">
    @foreach ($daftarKelas as $kelas)
        <!-- wrapper tabel rekap nilai siswa -->
        <div class="bg-white p-4 mt-5 rounded-md shadow-md">
            <div class="flex justify-between px-2 my-4">
                <h1 class="font-semibold text-lg uppercase">Kelas
                    {{ $kelas->nama_kelas ?? $kelas->nama }}</h1>
                <a wire:click.prevent="exportKelas({{ $kelas->id }})" href="#">
                    <button
                        class="flex items-center gap-1 px-3 py-3 bg-green-200 rounded-xl text-green-700 font-medium text-sm transition-all duration-100 shadow-sm capitalize hover:scale-105 active:scale-95">
                        <i class="fa-solid fa-file-excel"></i>
                        export excel
                    </button>
                </a>

            </div>

            <!-- container tabel rekap nilai siswa  -->
            <div class="rounded-lg border border-black overflow-hidden shadow-lg">
                <!-- wrapper scroll horizontal -->
                <div class="overflow-x-auto">
                    <!-- tabel rekap nilai -->
                    <table class="table-auto lg:w-full min-w-max text-center">
                        <thead>
                            <tr class="bg-yellow-300">
                                <th class="border-r border-black px-4 py-2 font-medium capitalize">
                                    no.
                                </th>
                                <th class="border-r border-black px-4 py-2 font-medium capitalize">
                                    nama siswa
                                </th>

                                {{-- Judul Latihan (dinamis) --}}
                                @foreach ($daftarLatihan as $latihan)
                                    <th
                                        class="border-r border-black px-4 py-2 font-medium capitalize">
                                        {{ $latihan->bab->judul_bab }} (latihan)
                                    </th>
                                @endforeach

                                {{-- Judul Ulangan (dinamis) --}}
                                @foreach ($daftarUlangan as $ulangan)
                                    <th
                                        class="border-r border-black px-4 py-2 font-normal capitalize">
                                        {{ $ulangan->judul }} (ulangan)
                                    </th>
                                @endforeach

                                <th class="border-r border-black px-4 py-2 font-normal capitalize">
                                    total nilai
                                </th>

                                <th class="px-4 py-2 font-normal capitalize">
                                    rata - rata
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($kelas->murid as $index => $murid)
                                @php
                                    $total = 0;
                                    $jumlahMapel = 0;
                                @endphp
                                <tr class="bg-white hover:bg-gray-200">
                                    <td class="border-t border-r border-black px-4 py-2">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="border-t border-r border-black px-4 py-2 capitalize">
                                        {{ $murid->nama }}
                                    </td>

                                    {{-- Nilai Latihan --}}
                                    @foreach ($daftarLatihan as $latihan)
                                        @php
                                            $nilaiLatihan = $murid->nilaiLatihan->firstWhere(
                                                'latihan_id',
                                                $latihan->id,
                                            );
                                            $nilaiLatihanAngka = $nilaiLatihan->nilai ?? null;

                                            if (!is_null($nilaiLatihanAngka)) {
                                                $total += $nilaiLatihanAngka;
                                                $jumlahMapel++;
                                            }
                                        @endphp
                                        <td class="border-t border-r border-black px-4 py-2">
                                            {{ $nilaiLatihanAngka ?? '-' }}
                                        </td>
                                    @endforeach

                                    {{-- Nilai Ulangan --}}
                                    @foreach ($daftarUlangan as $ulangan)
                                        @php
                                            $nilaiUlangan = $murid->nilaiUlangan->firstWhere(
                                                'ulangan_id',
                                                $ulangan->id,
                                            );
                                            $nilaiUlanganAngka = $nilaiUlangan->nilai ?? null;

                                            if (!is_null($nilaiUlanganAngka)) {
                                                $total += $nilaiUlanganAngka;
                                                $jumlahMapel++;
                                            }
                                        @endphp
                                        <td class="border-t border-black border-r px-4 py-2">
                                            {{ $nilaiUlanganAngka ?? '-' }}
                                        </td>
                                    @endforeach

                                    {{-- Total & rata-rata --}}
                                    <td class="border-t border-black border-r px-4 py-2">
                                        {{ $jumlahMapel ? $total : '-' }}
                                    </td>

                                    <td class="border-t border-black px-4 py-2">
                                        {{ $jumlahMapel ? round($total / $jumlahMapel) : '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</section>
