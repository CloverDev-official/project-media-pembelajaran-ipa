<div class="flex gap-5 relative">
    <!-- Tombol Notifikasi -->
    <div class="relative inline-block">
        <button id="btnNotif" class="text-2xl relative">
            <i class="bi bi-bell"></i>
        </button>
        <!-- Popup Notifikasi -->
        <div id="popupNotif"class="absolute top-12 right-[-2rem] md:right-0 bg-white shadow-lg rounded-xl w-80 md:w-96 p-0 opacity-0 scale-95 pointer-events-none transition-all duration-200 z-50">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-3 border-b border-gray-400">
                <h2 class="text-lg font-semibold">Notifikasi</h2>
                <button id="closeNotif" class="text-gray-500 hover:text-black hover:scale-105 active:scale-95">✕</button>
            </div>
            <!-- Tabs Filter -->
            <div class="flex gap-2 px-4 py-2 border-b border-gray-400 text-sm">
                <button data-filter="all" class="tabNotif px-3 py-1 rounded-full bg-gray-200 font-medium">Semua</button>
                <button data-filter="harini" class="tabNotif px-3 py-1 rounded-full hover:bg-gray-100">Hari ini</button>
                <button data-filter="kemarin" class="tabNotif px-3 py-1 rounded-full hover:bg-gray-100">Kemarin</button>
                <button data-filter="minggu" class="tabNotif px-3 py-1 rounded-full hover:bg-gray-100">Minggu ini</button>
            </div>
            <!-- List Notifikasi -->
            <div class="max-h-80 overflow-y-auto text-sm ">
                <!-- Hari ini -->
                <div class="notif-item cursor-pointer " data-group="harini">
                    <!-- siswa -->
                    <div class="px-4 py-3 flex items-center justify-between gap-3 hover:bg-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                <i class="bi bi-person text-lg"></i>
                            </div>
                            <p><b class="capitalize">ghaizan</b> telah menyelesaikan latihan Bab 1</p>
                        </div>
                        <span class="text-xs text-gray-500 whitespace-nowrap">1 mnt lalu</span>
                    </div>
                    <!-- siswa -->
                    <div class="px-4 py-3 flex items-center justify-between gap-3 hover:bg-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                <i class="bi bi-person text-lg"></i>
                            </div>
                            <p><b class="capitalize">hersa</b> telah menyelesaikan latihan Bab 1</p>
                        </div>
                        <span class="text-xs text-gray-500 whitespace-nowrap">1 mnt lalu</span>
                    </div>
                </div>
                <!-- Kemarin -->
                <div class="notif-item cursor-pointer " data-group="kemarin">
                    <!-- siswa -->
                    <div class="px-4 py-3 flex items-center justify-between gap-3 hover:bg-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                <i class="bi bi-person text-lg"></i>
                            </div>
                            <p><b class="capitalize"> dhika</b> telah menyelesaikan latihan Bab 3</p>
                        </div>
                        <span class="text-xs text-gray-500 whitespace-nowrap">Kemarin</span>
                    </div>
                    <!-- siswwa -->
                    <div class="px-4 py-3 flex items-center justify-between gap-3 hover:bg-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                <i class="bi bi-person text-lg"></i>
                            </div>
                            <p><b class="capitalize">nadhif</b> telah menyelesaikan latihan Bab 2</p>
                        </div>
                        <span class="text-xs text-gray-500 whitespace-nowrap">Kemarin</span>
                    </div>
                </div>
                <!-- Minggu ini -->
                <div class="notif-item cursor-pointer " data-group="minggu">
                    <!-- siswa -->
                    <div class="px-4 py-3 flex items-center justify-between gap-3 hover:bg-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                <i class="bi bi-person text-lg"></i>
                            </div>
                            <p><b class="capitalize">ari</b> telah menyelesaikan latihan Bab 3</p>
                        </div>
                        <span class="text-xs text-gray-500 whitespace-nowrap">3 hari lalu</span>
                    </div>
                    <!-- siswa -->
                    <div class="px-4 py-3 flex items-center justify-between gap-3 hover:bg-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                <i class="bi bi-person text-lg"></i>
                            </div>
                            <p><b class="capitalize">syahid</b> telah menyelesaikan latihan Bab 3</p>
                        </div>
                        <span class="text-xs text-gray-500 whitespace-nowrap">3 hari lalu</span>
                    </div>
                </div>
            </div>
        </div>
    </div>  

    <!-- btn profil -->
    <div class="relative">
        <img id="btnProfil" src="../img/beruang.jpg"
            class="w-8 h-8 rounded-full hover:brightness-75 transition-colors duration-150 cursor-pointer" alt="">

        <!-- Popup Profil -->
        <div id="popupProfil" class="absolute top-12 right-0 bg-white shadow-lg rounded-xl w-40 p-4 opacity-0 scale-95 pointer-events-none transition-all duration-200">
            <div class="flex flex-col text-lg">
                <button class="hover:bg-gray-100 py-2 px-2 rounded-lg text-start"><i class="bi bi-palette-fill"></i> Tema</button>
                <button class=" hover:bg-gray-100 py-2 px-2 text-red-500 rounded-lg text-start"><i class="bi bi-box-arrow-right"></i> Keluar</button>
            </div>
        </div>
        <!-- Modal Tema -->
        <div id="modalTema" class="fixed inset-0 bg-black/50  bg-opacity-40 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300 z-50">
            <div class="bg-white rounded-xl shadow-lg w-80 p-6">
                <h2 class="text-lg font-bold mb-4">Pilih Tema</h2>
                <div class="flex flex-col gap-3">
                <button id="btnTemaDefault" class="px-4 py-2 rounded-lg border flex items-center gap-2 hover:bg-green-100 text-green-600">
                    <span class="w-4 h-4 rounded-full bg-green-500"></span> Hijau
                </button>
                <button id="btnTemaPink" class="px-4 py-2 rounded-lg border flex items-center gap-2 hover:bg-pink-100 text-pink-600">
                    <span class="w-4 h-4 rounded-full bg-pink-500"></span> Pink
                </button>
                <button id="btnTemaBlue" class="px-4 py-2 rounded-lg border flex items-center gap-2 hover:bg-blue-100 text-blue-600">
                    <span class="w-4 h-4 rounded-full bg-blue-500"></span> Biru
                </button>
                </div>
                <div class="mt-5 flex justify-end">
                <button id="closeTema" class="px-4 py-2 text-gray-600 hover:text-black transition-all duration-150 hover:scale-105 active:scale-95">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>