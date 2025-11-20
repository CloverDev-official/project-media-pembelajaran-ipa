<section class="min-h-screen">
    @foreach ($daftarKelas as $kelas)
        <!-- wrapper tabel rekap nilai siswa -->
        <div class="bg-white p-4 mt-5 rounded-md shadow-md">
            <div class="flex justify-between px-2 my-4">
                <h1 class=" font-semibold text-lg uppercase">Kelas {{ $kelas->nama_kelas }}</h1>
                <a href="">
                    <button
                        class="border-l-4 border-b-4 border-green-700 px-4 py-2 bg-green-600 hover:scale-105 rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md capitalize text-sm active:scale-95">
                        <i class="fa-solid fa-file-excel"></i> excel
                    </button>
                </a>
            </div>
            <!-- container tabel rekap nilai siswa  -->
            <div class="rounded-lg border overflow-hidden shadow-lg">
                <!-- wrapper scroll horizontal -->
                <div class="overflow-x-auto">
                    <!-- tabel rekap nilai -->
                    <table class="table-auto lg:w-full min-w-max">
                        <thead>
                            <tr class="bg-main-light text-center">
                                <th class="border-r border-black px-4 py-2 font-normal capitalize">
                                    no.
                                </th>
                                <th class="border-r border-black px-4 py-2 font-normal capitalize">
                                    nama
                                    siswa</th>
                                <th class="border-r border-black px-4 py-2 font-normal capitalize">
                                    Judul latihan
                                </th>
                                <th class="border-r border-black px-4 py-2 font-normal capitalize">
                                    judul ulangan
                                </th>
                                {{-- <th class="border-r border-black px-4 py-2 font-normal capitalize">
                                    bab 1
                                </th>
                                <th class="border-r border-black px-4 py-2 font-normal capitalize">
                                    bab 2
                                </th>
                                <th class="border-r border-black px-4 py-2 font-normal capitalize">
                                    bab 3
                                </th>
                                <th class="border-r border-black px-4 py-2 font-normal capitalize">
                                    bab 4
                                </th>
                                <th class="border-r border-black px-4 py-2 font-normal capitalize">
                                    bab 5
                                </th>
                                <th class="border-r border-black px-4 py-2 font-normal capitalize">
                                    bab 6
                                </th>
                                <th class="border-r border-black px-4 py-2 font-normal capitalize">
                                    bab 7
                                </th> --}}
                                <th class="border-r border-black px-4 py-2 font-normal capitalize">
                                    ulangan</th>
                                <th class="px-4 py-2 font-normal capitalize">rata - rata</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <!-- data -->
                            @foreach ($kelas->murid as $murid)
                                <tr class="bg-white hover:bg-gray-200">
                                    <td class="border-t border-r px-4 py-2">{{ $murid->absen }}</td>
                                    <td class="border-t border-r px-4 py-2 capitalize">
                                        {{ $murid->nama }}
                                    </td>
                                    <td class="border-t border-r px-4 py-2">90</td>
                                    <td class="border-t border-r px-4 py-2">90</td>
                                    <td class="border-t border-r px-4 py-2">90</td>
                                    <td class="border-t border-r px-4 py-2">90</td>
                                    <td class="border-t border-r px-4 py-2">90</td>
                                    <td class="border-t border-r px-4 py-2">90</td>
                                    <td class="border-t border-r px-4 py-2">90</td>
                                    <td class="border-t border-r px-4 py-2">90</td>
                                    <td class="border-t px-4 py-2">90</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</section>
