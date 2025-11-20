<nav class="flex justify-between items-center p-5">
    <!-- Logo -->
    <h1 class="text-4xl text-blue-500 text-shadow-2xs font-extrabold uppercase">ipa<span
            class="text-yellow-400">verse</span></h1>
    <!-- Menu Desktop -->
    <ul class="hidden md:flex gap-10 items-center">
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

    <livewire:components.modal.modal-tema />
</nav>
