<!-- Popup Notifikasi -->
<div x-data="{ open: @entangle('showModalNotification').live }" x-show="open" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
    class="absolute top-12 right-[-0.5rem] md:right-0 bg-white shadow-lg rounded-xl w-90 md:w-96 p-0 scale-95 transition-all duration-200 z-50">
    <!-- Header -->
    <div class="flex items-center justify-between px-4 py-3 border-b border-gray-400">
        <h2 class="text-lg font-semibold">Notifikasi</h2>
    </div>
    <!-- Tabs Filter -->
    <div class="flex gap-2 px-4 py-2 border-b border-gray-400 text-sm">
        <button data-filter="all"
            class="tabNotif text-white text-shadow-2xs px-2  md:px-3 py-1 rounded-full bg-main font-medium">Semua</button>
        <button data-filter="harini"
            class="tabNotif  text-shadow-2xs px-2 md:px-3 py-1 rounded-full bg-hover-subtle">Hari
            ini</button>
        <button data-filter="kemarin"
            class="tabNotif  text-shadow-2xs px-2 md:px-3 py-1 rounded-full bg-hover-subtle">Kemarin</button>
        <button data-filter="minggu"
            class="tabNotif  text-shadow-2xs px-2 md:px-3 py-1 rounded-full bg-hover-subtle">Minggu
            ini</button>
    </div>
    <!-- List Notifikasi -->
    <div class="min-h-80 max-h-80 overflow-y-auto text-sm ">
        <!-- Hari ini -->
        <div class="notif-item cursor-pointer" data-group="harini">
            <h1 class="waktu  text-xs font-normal text-gray-700 capitalize px-4 pt-3">hari ini</h1>
            <!-- siswa -->
            <div class="px-4 py-3 flex items-center justify-between gap-3 bg-hover-subtle">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                        <i class="bi bi-person text-lg"></i>
                    </div>
                    <p><b class="capitalize">ghaizan</b> telah menyelesaikan latihan Bab 1</p>
                </div>
                <span class="text-xs text-gray-500 whitespace-nowrap">1 mnt lalu</span>
            </div>
            <!-- siswa -->
            <div class="px-4 py-3 flex items-center justify-between gap-3 bg-hover-subtle">
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
            <h1 class="waktu  text-xs font-normal text-gray-700 capitalize px-4 pt-3">kemarin</h1>
            <!-- siswa -->
            <div class="px-4 py-3 flex items-center justify-between gap-3 bg-hover-subtle">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                        <i class="bi bi-person text-lg"></i>
                    </div>
                    <p><b class="capitalize"> dhika</b> telah menyelesaikan latihan Bab 3</p>
                </div>
                <span class="text-xs text-gray-500 whitespace-nowrap">Kemarin</span>
            </div>
            <!-- siswwa -->
            <div class="px-4 py-3 flex items-center justify-between gap-3 bg-hover-subtle">
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
            <h1 class="waktu  text-xs font-normal text-gray-700 capitalize px-4 pt-3">minggu ini
            </h1>
            <!-- siswa -->
            <div class="px-4 py-3 flex items-center justify-between gap-3 bg-hover-subtle">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                        <i class="bi bi-person text-lg"></i>
                    </div>
                    <p><b class="capitalize">ari</b> telah menyelesaikan latihan Bab 3</p>
                </div>
                <span class="text-xs text-gray-500 whitespace-nowrap">3 hari lalu</span>
            </div>
            <!-- siswa -->
            <div class="px-4 py-3 flex items-center justify-between gap-3 bg-hover-subtle">
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
