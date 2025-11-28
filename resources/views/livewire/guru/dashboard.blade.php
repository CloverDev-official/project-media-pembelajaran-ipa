{{-- {{ $sidebarCollapsed ? 'md:ml-18' : 'md:ml-[16.6667%]' }} --}}
<section class="min-h-screen transition-all duration-300 ease-in-out ">
    <!-- container profil guru -->
    <div class="flex flex-col md:flex-row gap-5 mt-5">
        <div class="w-12/12 lg:w-8/12">
            <div class="bg-blue-500 p-4 py-6 rounded-md">
                <h1
                    class="text-start text-2xl md:text-3xl text-white text-shadow-2xs font-extrabold capitalize">
                    selamat datang, {{ $infoGuru->nama }}
                </h1>
                <p class="text-white font-medium">Selamat datang kembali di dashboard Anda. Mari
                    kelola kelas
                    dengan efektif hari
                    ini.</p>
            </div>
        </div>
        <!-- profil guru -->
        <div class="w-12/12 lg:w-3/12">
            <div class="flex flex-row gap-5">
                <!-- foto profil guru -->
                <img src="../img/beruang.jpg" alt="profil admin"
                    class="border rounded-2xl w-[10rem] md:w-[6rem]">

                <!-- data profil  guru -->
                <div class="flex flex-col gap-2 overflow-x-auto">
                    <div class="w-[8rem] md:w-full">
                        <h1 class="font-bold text-lg capitalize">{{ $infoGuru->nama }}
                        </h1>
                        <h1 class="font-normal text-sm text-gray-400 uppercase">
                            Email : {{ $infoGuru->email }}
                        </h1>
                        <h1 class="font-normal text-sm text-gray-400 uppercase">
                            smpn11 bjm
                        </h1>
                    </div>
                    <div
                        class="bg-blue-500 text-md text-white rounded-lg capitalize font-semibold text-center">
                        guru
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- container isi konten -->
    <div class="flex flex-col lg:flex-row gap-4 mt-5">
        <!-- grafik nilai rata rata kelas -->
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h1 class="font-bold capitalize mt-8">
                <iconify-icon icon="mdi:bar-chart"></iconify-icon>
                ringkasan performa kelas
            </h1>
            <p class="text-normal text-xs text-gray-400">
                Nilai rata-rata IPA per kelas
            </p>
            <div class="bg-white p-4">
                <!-- container diagran rata rata -->
                <div>
                    <livewire:components.chart />
                </div>

                <!-- container detail performa (contoh statis, bisa kamu dinamis-kan nanti) -->
                <div>
                    <h1 class="text-lg font-semibold capitalize mb-3">
                        detail performa
                    </h1>
                    <div class="grid grid-cols-1 gap-5">
                        <!-- card -->

                        @foreach ($peformaKelas as $performa)
                            <div class="border border-gray-400 bg-gray-50 p-2 px-4 rounded-lg">
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="flex justify-between">
                                        <div class="flex gap-3 items-center">
                                            <div
                                                class="border border-main-dark bg-blue-500 rounded lg p-2">
                                            </div>
                                            <h1 class="font-nolmal text-sm uppercase">
                                                {{ $performa['label'] }}</h1>
                                        </div>
                                        <h1 class="font-bold text-sm">{{ $performa['value'] }}</h1>
                                    </div>
                                    <div class="grid grid-cols-1 gap-1">
                                        <div class="w-full bg-gray-300 rounded-full h-2 mb-3">
                                            <div class="bg-blue-500 h-2 rounded-full"
                                                style="width: {{ min($performa['value'], 100) }}%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        <!-- kolom kanan: data murid + rekap nilai -->
        <div class="grid lg:grid-rows-2 gap-4 lg:w-full">
            <!-- wrapper table murid -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <div class="flex justify-between mb-10 mt-2">
                    <h1 class="font-bold text-3xl capitalize flex items-center gap-2">
                        <iconify-icon icon="mdi:account-student" class="text-5xl"></iconify-icon>
                        tabel murid
                    </h1>
                    <a wire:navigate href="data-murid">
                        <button
                            class="px-3 py-3 bg-green-200 rounded-xl text-green-700 font-medium text-sm transition-all duration-100 shadow-sm capitalize hover:scale-105 active:scale-95">
                            lihat semua
                        </button>
                    </a>
                </div>

                <div class="grid lg:grid-cols-2 gap-4">
                    @foreach ($kelasTerpilih as $kelas)
                        <div class="bg-gray-50 border border-gray-300 p-4 rounded-md">
                            <h1 class="my-4 font-semibold text-lg">
                                Kelas {{ strtoupper($kelas->nama_kelas) }}
                            </h1>
                            <div class="rounded-lg border border-black overflow-hidden shadow-lg">
                                <table class="table-auto w-full">
                                    <thead>
                                        <tr class="bg-yellow-300 text-center">
                                            <th
                                                class="border-r border-black px-4 py-2 font-medium capitalize">
                                                no
                                            </th>
                                            <th
                                                class="border-r border-black px-4 py-2 font-medium capitalize">
                                                nama murid
                                            </th>
                                            <th class="px-4 py-2 font-medium capitalize">
                                                kelas
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($kelas->murid as $murid)
                                            <tr class="bg-white">
                                                <td
                                                    class="border-t border-r border-black px-4 py-2">
                                                    {{ $murid->absen }}
                                                </td>
                                                <td
                                                    class="border-t border-r border-black px-4 py-2 capitalize">
                                                    {{ $murid->nama }}
                                                </td>
                                                <td
                                                    class="border-t border-black px-4 py-2 uppercase">
                                                    {{ $murid->kelas->nama_kelas }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- wrapper rekap nilai (1 kelas saja) -->
            <div class="hidden lg:block bg-white p-4 rounded-md shadow-md">
                <div class="flex justify-between mb-10 mt-2">
                    <h1 class="font-bold text-3xl capitalize flex items-center gap-2">
                        <iconify-icon icon="healthicons:i-exam-qualification"
                            class="text-4xl"></iconify-icon>
                        rekap nilai
                    </h1>
                    <div class="flex justify-between gap-5">
                        <a wire:navigate href="rekap-nilai">
                            <button
                                class="px-3 py-3 bg-green-200 rounded-xl text-green-700 font-medium text-sm transition-all duration-100 shadow-sm capitalize hover:scale-105 active:scale-95">
                                lihat semua
                            </button>
                        </a>
                    </div>
                </div>

                @if ($ringkasanNilai)
                    @php $kelas = $ringkasanNilai; @endphp

                    <div>
                        <div class="flex justify-between px-2 my-4">
                            <h1 class="font-semibold text-lg uppercase">
                                Kelas {{ $kelas->nama_kelas ?? $kelas->nama }}
                            </h1>
                        </div>

                        <div class="rounded-lg border border-black overflow-hidden shadow-lg">
                            <div class="overflow-x-auto">
                                <table class="table-auto lg:w-full min-w-max text-center">
                                    <thead>
                                        <tr class="bg-yellow-300">
                                            <th
                                                class="border-r border-black px-4 py-2 font-medium capitalize">
                                                no.
                                            </th>
                                            <th
                                                class="border-r border-black px-4 py-2 font-medium capitalize">
                                                nama siswa
                                            </th>

                                            {{-- Judul Latihan (dinamis) --}}
                                            @foreach ($daftarLatihan as $latihan)
                                                <th
                                                    class="border-r border-black px-4 py-2 font-normal capitalize">
                                                    {{ $latihan->bab->judul_bab }}
                                                </th>
                                            @endforeach

                                            {{-- Judul Ulangan (dinamis) --}}
                                            @foreach ($daftarUlangan as $ulangan)
                                                <th
                                                    class="border-r border-black px-4 py-2 font-normal capitalize">
                                                    {{ $ulangan->judul }}
                                                </th>
                                            @endforeach

                                            <th
                                                class="border-r border-black px-4 py-2 font-normal capitalize">
                                                ulangan
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
                                            <tr class="bg-white">
                                                <td
                                                    class="border-t border-r border-black px-4 py-2">
                                                    {{ $index + 1 }}
                                                </td>
                                                <td
                                                    class="border-t border-r border-black px-4 py-2 capitalize">
                                                    {{ $murid->nama }}
                                                </td>

                                                {{-- Nilai Latihan --}}
                                                @foreach ($daftarLatihan as $latihan)
                                                    @php
                                                        $nilaiLatihan = $murid->nilaiLatihan->firstWhere(
                                                            'latihan_id',
                                                            $latihan->id,
                                                        );
                                                        $nilaiLatihanAngka =
                                                            $nilaiLatihan->nilai ?? null;

                                                        if (!is_null($nilaiLatihanAngka)) {
                                                            $total += $nilaiLatihanAngka;
                                                            $jumlahMapel++;
                                                        }
                                                    @endphp
                                                    <td
                                                        class="border-t border-r border-black px-4 py-2">
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
                                                        $nilaiUlanganAngka =
                                                            $nilaiUlangan->nilai ?? null;

                                                        if (!is_null($nilaiUlanganAngka)) {
                                                            $total += $nilaiUlanganAngka;
                                                            $jumlahMapel++;
                                                        }
                                                    @endphp
                                                    <td
                                                        class="border-t border-r border-black px-4 py-2">
                                                        {{ $nilaiUlanganAngka ?? '-' }}
                                                    </td>
                                                @endforeach

                                                <td
                                                    class="border-t border-r border-black px-4 py-2">
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
                @else
                    <h1 class="text-gray-500 text-lg flex justify-center items-center">
                        Belum ada data kelas untuk rekap.
                    </h1>
                @endif
            </div>
        </div>
    </div>
</section>
