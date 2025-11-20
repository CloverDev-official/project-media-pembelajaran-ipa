<div class="md:hidden fixed bottom-0 left-0 right-0 bg-main shadow-md z-20">
    <ul
        class="flex justify-center items-center p-2 space-x-4 overflow-x-auto flex-nowrap scrollbar-hide">

        <!-- Dashboard -->
        <li>
            <x-guru.nav-link-bottom href="{{ route('guru.dashboard') }}" :active="request()->routeIs('guru.dashboard')"
                :label="'dashboard'">
                <iconify-icon icon="material-symbols:dashboard-outline"
                    class="text-2xl"></iconify-icon>
            </x-guru.nav-link-bottom>
        </li>
        <!-- data siswa -->
        <li>
            <x-guru.nav-link-bottom href="{{ route('guru.data-murid') }}" :active="request()->routeIs('guru.data-murid')"
                :label="'data murid'">
                <iconify-icon icon="hugeicons:student" class="text-2xl"></iconify-icon>
            </x-guru.nav-link-bottom>
            </a>
        </li>
        <!-- rekap nilai -->
        <li>
            <x-guru.nav-link-bottom href="{{ route('guru.rekap-nilai') }}" :active="request()->routeIs('guru.rekap-nilai')"
                :label="'rekap nilai'">
                <iconify-icon icon="healthicons:i-exam-qualification-outline"
                    class="text-2xl"></iconify-icon>
            </x-guru.nav-link-bottom>
        </li>
        <!-- tambah materi -->
        <li>
            <x-guru.nav-link-bottom href="{{ route('guru.materi') }}" :active="request()->routeIs('guru.materi')"
                :label="'materi'">
                <iconify-icon icon="fluent:book-add-28-regular" class="text-2xl"></iconify-icon>
            </x-guru.nav-link-bottom>
        </li>
        <!-- ulangan -->
        <li class="flex-shrink-0 px-3 py-1 rounded-lg">
            <x-guru.nav-link-bottom href="{{ route('guru.ulangan') }}" :active="request()->routeIs('guru.ulangan')"
                :label="'ulangan'">
                <iconify-icon icon="healthicons:i-exam-multiple-choice"
                    class="text-2xl"></iconify-icon>
            </x-guru.nav-link-bottom>
        </li>
        <!-- game -->
        <li>
            <x-guru.nav-link-bottom href="{{ route('guru.gim') }}" :active="request()->routeIs('guru.gim')"
                :label="'gim'">
                <iconify-icon icon="bx:joystick" class="text-2xl"></iconify-icon>
            </x-guru.nav-link-bottom>
        </li>
    </ul>
</div>
