{{-- {{ $sidebarCollapsed ? 'md:ml-18' : 'md:ml-[16.6667%]' }} --}}
<section class="min-h-screen transition-all duration-300 ease-in-out ">
    <!-- container profil guru -->
    <div class="flex flex-col md:flex-row gap-5 mt-5">
        <div class="w-12/12 lg:w-8/12">
            <div class="bg-main p-4 py-6 rounded-md">
                <h1 class="text-center text-4xl text-white text-shadow-2xs font-extrabold uppercase">
                    dasboard guru</h1>
            </div>
        </div>
        <!-- profil guru -->
        <div class="w-12/12 lg:w-3/12">
            <div class="flex flex-row gap-5">
                <!-- foto profil guru -->
                <img src="../img/beruang.jpg" alt="profil admin"
                    class=" border rounded-2xl w-[10rem] md:w-[6rem]">

                <!-- data profil  guru -->
                <div class=" flex flex-col gap-2">
                    <div>
                        <h1 class="font-bold text-lg capitalize">{{ $infoGuru->nama }}</h1>
                        <h1 class="font-normal text-sm text-gray-400 uppercase">Email
                            : {{ $infoGuru->email }}</h1>
                        <h1 class="font-normal text-sm text-gray-400 uppercase">
                            smpn11 bjm</h1>
                    </div>
                    <div
                        class="bg-main text-md text-white rounded-lg capitalize font-semibold text-center">
                        guru</div>
                </div>
            </div>
        </div>
    </div>
    <!-- container isi konten -->
    <div class="flex flex-col lg:flex-row gap-4 mt-5">
        <!-- grafik nilai rata rata kelas -->
        <div class="bg-white p-4 rounded-lg shadow-md ">
            <h1 class="font-bold capitalize mt-8 "><iconify-icon
                    icon="mdi:bar-chart"></iconify-icon>ringkasan performa kelas
            </h1>
            <p class="text-normal text-xs text-gray-400">Nilai rata-rata IPA per
                kelas</p>
            <div class="bg-white p-4">
                <!-- container diagran rata rata -->
                <div class="mb-5">
                    <!-- diagram batang untuk rata rata nilai murid -->
                    <canvas id="nilaiChart" class="w-50 h-100"></canvas>
                </div>
                <!-- container detail performa -->
                <div class="mt-5">
                    <h1 class="text-lg font-semibold capitalize mb-3">detail
                        performa</h1>
                    <!-- container card rata-rata -->
                    <div class="grid grid-cols-1 gap-5">
                        <!-- card -->
                        <div class="border border-gray-400 bg-gray-50 p-2 px-4 rounded-lg">
                            <div class="grid grid-cols-1 gap-4">
                                <!-- header card -->
                                <div class="flex justify-between">
                                    <div class="flex gap-3 items-center">
                                        <div class="border border-main-dark bg-main rounded lg p-2">
                                        </div>
                                        <h1 class="font-nolmal text-sm uppercase">9a
                                        </h1>
                                    </div>
                                    <h1 class="font-bold text-sm">79.6</h1>
                                </div>
                                <!-- body card -->
                                <div class="grid grid-cols-1 gap-1">
                                    <!-- container Progress bar -->
                                    <div class="w-full bg-gray-300 rounded-full h-2">
                                        <!-- Progress Bar -->
                                        <div class="bg-main h-2 rounded-full text-center text-xs font-bold text-white"
                                            style="width: 75%;"></div>
                                    </div>
                                    <p class="ml-1 text-xs text-gray-600 font-normal capitalize">
                                        persentase : 75%</p>
                                </div>
                            </div>
                        </div>
                        <!-- card -->
                        <div class="border border-gray-400 bg-gray-50 p-2 px-4 rounded-lg">
                            <div class="grid grid-cols-1 gap-4">
                                <!-- header card -->
                                <div class="flex justify-between">
                                    <div class="flex gap-3 items-center">
                                        <div class="border border-main-dark bg-main rounded lg p-2">
                                        </div>
                                        <h1 class="font-nolmal text-sm uppercase">9b
                                        </h1>
                                    </div>
                                    <h1 class="font-bold text-sm">88.8</h1>
                                </div>
                                <!-- body card -->
                                <div class="grid grid-cols-1 gap-1">
                                    <!-- container Progress bar -->
                                    <div class="w-full bg-gray-300 rounded-full h-2">
                                        <!-- Progress Bar -->
                                        <div class="bg-main h-2 rounded-full text-center text-xs font-bold text-white"
                                            style="width: 88.8%;"></div>
                                    </div>
                                    <p class="ml-1 text-xs text-gray-600 font-normal capitalize">
                                        persentase : 88%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- data murid -->
        <div class="grid lg:grid-rows-2 gap-4">
            <!-- wrapper table murid -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <!-- header tabel murid -->
                <div class="flex justify-between mb-10 mt-2">
                    <!-- judul -->
                    <h1 class="font-bold text-3xl capitalize flex items-center gap-2">
                        <iconify-icon icon="mdi:account-student"
                            class="text-5xl"></iconify-icon>tabel murid
                    </h1>
                    <!-- button -->
                    <a wire:navigate href="data-murid">
                        <button
                            class="border-l-4 border-b-4 border-main-dark  px-4 py-2 bg-main rounded-lg text-white text-shadow-md font-semibold text-sm transition-all duration-100 shadow-md capitalize hover:scale-105 active:scale-95">
                            lihat semua
                        </button>
                    </a>
                </div>
                <!-- container tabel murid -->
                <div class="grid  lg:grid-cols-2  gap-4">
                    @foreach ($kelasTerpilih as $kelas)
                        <div class="bg-gray-100 p-4 rounded-md">
                            <h1 class="my-4 font-semibold text-lg">Kelas
                                {{ strtoupper($kelas->nama_kelas) }}
                            </h1>
                            <div class="rounded-lg border overflow-hidden shadow-lg">
                                <table class="table-auto  w-full">
                                    <!-- table head -->
                                    <thead>
                                        <tr class="bg-main-light text-center">
                                            <th class="border-r border-black px-4 py-2 capitalize">
                                                no</th>
                                            <th class="border-r border-black px-4 py-2 capitalize">
                                                nama murid</th>
                                            <th class=" px-4 py-2 capitalize">kelas</th>
                                        </tr>
                                    </thead>
                                    <!-- table body -->
                                    <tbody class="text-center">
                                        @foreach ($kelas->murid as $murid)
                                            <tr class="bg-white hover:bg-gray-200">
                                                <td class="border-t border-r px-4 py-2">
                                                    {{ $murid->absen }}
                                                </td>
                                                <td class="border-t border-r px-4 py-2 capitalize">
                                                    {{ $murid->nama }}
                                                </td>
                                                <td class="border-t  px-4 py-2 uppercase">
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
            <!-- wrapper rekap nilai -->
            <div class="hidden lg:block  bg-white p-4 rounded-md shadow-md">
                <div class="flex justify-between mb-10 mt-2">
                    <h1 class="font-bold text-3xl capitalize flex items-center gap-2">
                        <iconify-icon icon="healthicons:i-exam-qualification"
                            class="text-4xl"></iconify-icon>
                        rekap nilai
                    </h1>
                    <div class="flex justify-between gap-5">
                        <a wire:navigate href="rekap-nilai">
                            <button
                                class="border-l-4 border-b-4 border-main-dark  px-4 py-2 bg-main rounded-lg text-white text-shadow-md font-semibold text-sm transition-all duration-100 shadow-md capitalize hover:scale-105 active:scale-95">
                                lihat semua
                            </button>
                        </a>
                    </div>
                </div>

                @foreach ($ringkasanNilai as $rekapNilai)
                    <h1 class="my-4 font-semibold text-lg">Kelas
                        {{ strtoupper($rekapNilai->nama_kelas) }}</h1>
                    <div class=" rounded-lg border overflow-hidden shadow-lg">
                        <!-- wrapper scroll horizontal -->
                        <div class="overflow-x-auto">
                            <table class="table-fixed lg:w-full">
                                <thead>
                                    <tr class="bg-main-light text-center">
                                        <th
                                            class="border-r border-black px-4 py-2 font-normal  capitalize">
                                            no.
                                        </th>
                                        <th
                                            class="border-r border-black px-4 py-2 font-normal  capitalize">
                                            nama murid
                                        </th>
                                        <th
                                            class="border-r border-black px-4 py-2 font-normal  capitalize">
                                            ulangan
                                        </th>
                                        <th class="px-4 py-2 font-normal  capitalize">
                                            rata - rata
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($rekapNilai->murid as $murid)
                                        <tr class="bg-white hover:bg-gray-200">
                                            <td class="border-t border-r px-4 py-2">
                                                {{ $murid->absen }}
                                            </td>
                                            <td class="border-t border-r px-4 py-2 capitalize">
                                                {{ $murid->nama }}
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
    </div>
</section>
