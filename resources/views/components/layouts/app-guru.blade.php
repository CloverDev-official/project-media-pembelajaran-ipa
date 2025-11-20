<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <title>{{ $title ?? 'Page Title' }}</title>
    {!! ToastMagic::styles() !!}
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    @livewireStyles
</head>

<body x-data="{
    collapsed: @json(session('sidebarCollapsed', true))
}" x-init="window.addEventListener('sidebar-toggled', event => {
    collapsed = event.detail.collapsed;
})" data-theme="default" class="relative">
    <main class="min-h-screen bg-subtle flex transition-all duration-300"
        :class="collapsed ? 'md:ml-16' : 'md:ml-[16.6667%]'">

        <livewire:components.guru.sidebar />
        <div id="content" class="flex-3 transition-all duration-300">
            <div class="p-5">
                <livewire:components.guru.header />
                {{ $slot }}
            </div>
            <livewire:components.footer />
        </div>
        <livewire:components.guru.navbar-bottom />
    </main>
    @livewireScripts
    {!! ToastMagic::scripts() !!}
    @if (session('toastMagic'))
        <script>
            window.toastFlash = @json(session('toastMagic'));
        </script>
    @endif

</body>

</html>
