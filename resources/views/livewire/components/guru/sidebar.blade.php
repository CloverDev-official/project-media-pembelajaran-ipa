<aside id="sidebar" wire:navigate.ignore
    class="
        {{ $sidebarCollapsed ? 'sidebar-collapsed md:w-2/12' : 'md:w-1/6' }}
        fixed top-0 left-0 z-10 min-h-screen bg-blue-500 p-4 rounded-tr-3xl shadow-2xl
        transform transition-transform duration-300 ease-in-out hidden md:flex flex-col justify-between
    ">
    <!-- Bagian atas (button + menu) -->
    <div>
        <!-- isi sidebar -->
        <div class="flex justify-start items-center gap-6 mt-2 pl-2">
            <button wire:click="toggleSidebar" class=" text-white ">
                <i class="bi bi-list text-3xl"></i>
            </button>
        </div>

        <ul class="mt-3 flex flex-col gap-5 text-white text-xl font-semibold capitalize">
            <!-- dasboard -->
            <li class="transition-all rounded-lg relative">
                <x-guru.nav-link href="{{ route('guru.dashboard') }}" :active="$currentRoute === 'guru.dashboard'">
                    <iconify-icon icon="material-symbols:dashboard" class="text-2xl"></iconify-icon>
                    <span class="menu-text">dasboard</span>
                    <span class="tooltip">dasboard</span>
                </x-guru.nav-link>
            </li>
            <!-- data siswa -->
            <li class="transition-all rounded-lg relative">
                <x-guru.nav-link href="{{ route('guru.data-murid') }}" :active="$currentRoute === 'guru.data-murid'">
                    <iconify-icon icon="hugeicons:student" class="text-2xl"></iconify-icon>
                    <span class="menu-text">data murid</span>
                    <span class="tooltip">data murid</span>
                </x-guru.nav-link>
            </li>
            <!-- rekap nilai -->
            <li class="transition-all rounded-lg relative">
                <x-guru.nav-link href="{{ route('guru.rekap-nilai') }}" :active="$currentRoute === 'guru.rekap-nilai'">
                    <iconify-icon icon="healthicons:i-exam-qualification-outline"
                        class="text-2xl"></iconify-icon>
                    <span class="menu-text">rekap nilai</span>
                    <span class="tooltip">rekap nilai</span>
                </x-guru.nav-link>
            </li>
            <!-- materi -->
            <li class="transition-all rounded-lg relative">
                <x-guru.nav-link href="{{ route('guru.materi') }}" :active="$currentRoute === 'guru.materi'">
                    <iconify-icon icon="fluent:book-add-28-regular" class="text-2xl"></iconify-icon>
                    <span class="menu-text">materi</span>
                    <span class="tooltip">materi</span>
                </x-guru.nav-link>
            </li>
            <!-- ulangan -->
            <li class="transition-all rounded-lg relative">
                <x-guru.nav-link href="{{ route('guru.ulangan') }}" :active="$currentRoute === 'guru.ulangan'">
                    <iconify-icon icon="healthicons:i-exam-multiple-choice-outline"
                        class="text-2xl"></iconify-icon>
                    <span class="menu-text">ulangan</span>
                    <span class="tooltip">ulangan</span>
                </x-guru.nav-link>
            </li>
            <!-- interactive video -->
            <li class="transition-all rounded-lg relative">
                <x-guru.nav-link href="{{ route('guru.interactive-video') }}" :active="$currentRoute === 'guru.interactive-video'">
                    <iconify-icon icon="carbon:video" class="text-2xl"></iconify-icon>
                    <span class="menu-text">video interaktif</span>
                    <span class="tooltip">video interaktif</span>
                </x-guru.nav-link>
            </li>
            <!-- game -->
            <li class="transition-all rounded-lg relative">
                <x-guru.nav-link href="{{ route('guru.gim') }}" :active="$currentRoute === 'guru.gim'">
                    <iconify-icon icon="bx:joystick" class="text-2xl"></iconify-icon>
                    <span class="menu-text">gim</span>
                    <span class="tooltip">gim</span>
                </x-guru.nav-link>
            </li>
        </ul>
    </div>
</aside>
