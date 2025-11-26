<header class="flex justify-center z-50" x-data="{ open: false }">
    <nav
        class="hidden md:flex bg-opacity-30 backdrop-blur-lg shadow-lg rounded-full justify-between items-center md:py-5 py-1 px-7 w-full md:w-[80rem]">
        <!-- Logo -->
        <div class="flex gap-2 md:gap-4 items-center">
            <img src="../img/paw-paw.png" class="w-8 h-7 md:w-10 md:h-8" alt="">
            <h1 class="md:text-2xl text-black text-shadow-2xs font-extrabold uppercase">ipawn</h1>
        </div>
        <!-- Menu Desktop -->
        <ul class="hidden md:flex gap-10 items-center capitalize">
            <!-- beranda -->
            <li>
                <x-nav-link href="/" :active="request()->routeIs('beranda')">Beranda</x-nav-link>
            </li>
            <!-- materi -->
            <li>
                <x-nav-link href="materi" :active="request()->routeIs('materi')">materi</x-nav-link>
            </li>
            <!-- gim -->
            <li>
                <x-nav-link href="gim" :active="request()->routeIs('gim')">gim</x-nav-link>
            </li>
            <!-- ulangan -->
            <li>
                <x-nav-link href="daftar-ulangan" :active="request()->routeIs('daftar-ulangan')">ulangan</x-nav-link>
            </li>
            <!-- User Dropdown -->
            <li class="relative">
                <button wire:click="$dispatch('toggleProfilPopup')">
                    <img src="{{ asset('img/beruang.jpg') }}" alt="User"
                        class="rounded-full w-[30px] hover:brightness-75 transition">
                </button>

                <livewire:components.modal.modal-profil-siswa />
            </li>
        </ul>
    </nav>

    <livewire:components.mobile.navbar-mobile />
</header>
