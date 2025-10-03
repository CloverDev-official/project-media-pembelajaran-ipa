<!-- Popup Notifikasi -->
<div id="popupNotif"class="absolute top-12 right-[-0.5rem] md:right-0 bg-white shadow-lg rounded-xl w-80 md:w-96 p-0 opacity-0 scale-95 pointer-events-none transition-all duration-200 z-50">
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