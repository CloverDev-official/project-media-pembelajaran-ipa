<header wire:navigate.ignore>
    {{-- {{ $sidebarCollapsed ? 'md:ml-18' : 'md:ml-[16.6667%]' }} --}}
    <nav class="flex justify-between gap-5 transition-all duration-300 ease-in-out">
        <!-- teks selamat datang -->
        <div class="flex flex-col text-start ">
            <h1 class="text-lg md:text-3xl font-bold capitalize">
                Selamat Datang {{ $namaGuru }}</h1>
            <h1 class="text-md md:text-lg font-normal text-gray-400">
                {{ $dateNow }}</h1>
        </div>
        <livewire:components.guru.navbar />
    </nav>
</header>
