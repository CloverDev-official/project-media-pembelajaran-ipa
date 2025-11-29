<div>
    <nav class="md:hidden flex bg-opacity-30 backdrop-blur-lg shadow-lg rounded-full  justify-between items-center  py-1 px-7  w-[20rem]">
        <!-- Logo -->
            <div class="flex gap-2 md:gap-4 items-center">
                <img src="../img/paw-paw.png" class="w-8 h-7 md:w-10 md:h-8"  alt="">
                <h1 class="md:text-2xl text-black text-shadow-2xs font-extrabold uppercase">ipawn</h1>
            </div>
    
        <!-- hamburger -->
        <button @click="open = ! open">
            <iconify-icon icon="stash:burger-classic" width="24" height="24" class="text-blue-500 p-1 hover:text-white text-shadow-2xs rounded-lg transition-all duration-150 hover:bg-blue-500 active:scale-95"></iconify-icon>
        </button>
    </nav>

    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black/10 bg-opacity-50 hidden z-50"></div>

    <!-- Sidebar -->
    <div x-show-="open"
        @click.outside="open = false"
        x-transition:enter="transition-transform duration-300 ease-in-out"
        x-transition:enter-start="transform translate-x-full"
        x-transition:enter-end="translate-x"
        x-transition:leave="transition-transform duration-300 ease-in-out"
        x-transition:leave-start="translate-x"
        x-transition:leave-end="transform translate-x-full"
        class="fixed top-0 right-0 h-full  w-64 rounded-tl-4xl bg-gradient-to-t from-[#489BF9] to-[#1565C0] text-white z-50 ">
        <div class="p-6">
            <a href="{{ route('profil') }}" wire:navigate>
                <div class="flex items-center gap-3 p-2 rounded-lg transition-all duration-100 hover:bg-blue-400 active:bg-blue-700 active:scale-95">
                    <!-- foto profil -->
                    <img src="../img/beruang.jpg" alt="" class="w-10 h-10 p-1 rounded-full bg-white shadow">
                    <!-- username dan status -->
                    <div class="flex flex-col">
                        <h1 class="font-bold text-yellow-300 text-shadow-2xs capitalize">admin</h1>
                        <h1 class="text-sm text-white text-shadow-2xs capitalize">murid</h1>
                    </div>
                </div>
            </a>
            <ul class="space-y-2 mt-8 capitalize">
                <!-- beranda -->
                <x-nav-link-mobile href="/"  :active="request()->routeIs('beranda')"><iconify-icon icon="material-symbols:dashboard-outline" class="text-xl"></iconify-icon> beranda</x-nav-link-mobile>
                <!-- materi -->
                <x-nav-link-mobile href="materi" :active="request()->routeIs('materi')"><iconify-icon icon="tdesign:book" class="text-xl"></iconify-icon> materi</x-nav-link-mobile>
                <!-- ulangan -->
                <x-nav-link-mobile href="gim" :active="request()->routeIs('gim')"><iconify-icon icon="healthicons:i-exam-qualification-outline" class="text-xl"></iconify-icon>gim</x-nav-link-mobile>
                <!-- games -->
                <x-nav-link-mobile href="daftar-ulangan" :active="request()->routeIs('daftar-ulangan')"><iconify-icon icon="ion:game-controller-outline" class="text-xl"></iconify-icon> ulangan</x-nav-link-mobile>
                <li>
                    <button wire:click="logout"
                        class="flex items-center gap-2 w-full  text-start font-bold text-white hover:bg-blue-400 py-2 px-4 rounded-full">
                        <i class="bi bi-box-arrow-right" class="text-xl"></i>
                        Logout
                    </button>
                </li>
            </ul>
        </div>
    </div>
</div>

